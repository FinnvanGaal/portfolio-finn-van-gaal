<<<<<<< HEAD
<?php

require_once __DIR__ . '/../includes/mailer.php';

class posts
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    public function getPosts(string $sort = 'newest', $limit = 23, ?string $searchQuery = null): array
    {
        switch ($sort) {
            case 'oldest':
                $orderBy = 'posts.created_at ASC';
                break;
            case 'author-asc':
                $orderBy = 'users.username ASC';
                break;
            case 'author-desc':
                $orderBy = 'users.username DESC';
                break;
            case 'newest':
            default:
                $orderBy = 'posts.created_at DESC';
                break;
        }

        $sql = "SELECT 
                posts.title, 
                posts.content, 
                posts.image,
                posts.slug,
                posts.created_at,
                users.username,
                users.email
            FROM users
            INNER JOIN posts ON users.id = posts.user_id";

        $bindValues = [];
        $bindTypes  = '';

        if (!empty($searchQuery)) {
            $sql .= " 
                WHERE posts.title LIKE ? 
                OR posts.content LIKE ? 
                OR users.username LIKE ?";
            $like = "%{$searchQuery}%";
            $bindValues = [$like, $like, $like];
            $bindTypes  = 'sss';
        }


        $sql .= " ORDER BY {$orderBy}";


        if ($limit !== null && $limit !== 'all') {
            $sql .= " LIMIT ?";
            $bindTypes   .= 'i';
            $bindValues[] = (int)$limit;
        }

        $stmt = $this->dbh->prepare($sql);
        if (!empty($bindValues)) {
            $stmt->bind_param($bindTypes, ...$bindValues);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        $posts = [];
        while ($row = $result->fetch_assoc()) {
            $posts[$row['slug']] = $row;
        }

        return $posts;
    }



    public function getRecipe()
    {
        $sql = "SELECT 
            recipes.serves, 
            recipes.total_minutes,
            recipes.ingredients,
            recipes.steps,
            posts.title,
            posts.slug,
            posts.content,
            posts.id
            FROM recipes
            INNER JOIN posts 
            ON recipes.post_id = posts.id ";

        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $recipes = [];
        while ($row = $result->fetch_assoc()) {
            $recipes[$row['slug']] = $row;
        }
        return $recipes;
    }

    public function addComment()
    {
        $slug = $_GET['post'] ?? '';

        $stmt = $this->dbh->prepare("SELECT id FROM posts WHERE slug = ? LIMIT 1");
        $stmt->bind_param('s', $slug);
        $stmt->execute();
        $postArr = $stmt->get_result()->fetch_assoc();

        if (!$postArr) {
            header("Location: /rea-1/PHP/26-eindopdracht-php/mijn-blog/" . urlencode($slug) . "#comments");
            exit;

            exit;
        }

        $postId  = (int)$postArr['id'];
        $comment = $_POST['comment'] ?? '';

        // 🚫 Blacklist check
        if ($badWord = findBlacklistedWord($comment)) {
            $_SESSION['error'] = "Je reactie bevat een verboden woord: '{$badWord}'.";
            header("Location: /rea-1/PHP/26-eindopdracht-php/mijn-blog/" . urlencode($slug));
            exit;
        }



        if (isset($_SESSION['user']['id'])) {
            $userId   = $_SESSION['user']['id'];
            $username = $_SESSION['user']['username'];

            $query = "INSERT INTO comments (post_id, user_id, name, comment, created_at) VALUES (?, ?, ?, ?, NOW())";
            $stmt  = $this->dbh->prepare($query);
            $stmt->bind_param('iiss', $postId, $userId, $username, $comment);
        } else {
            $guestId   = $_SESSION['guest_id'] ?? null;
            $guestName = $_SESSION['guest_username'] ?? 'Gast';

            $query = "INSERT INTO comments (post_id, guest_id, name, comment, created_at) VALUES (?, ?, ?, ?, NOW())";
            $stmt  = $this->dbh->prepare($query);
            $stmt->bind_param('iiss', $postId, $guestId, $guestName, $comment);
        }

        $stmt->execute();

        $authorQuery = "SELECT users.email AS author_email, users.username AS author_username, posts.title AS post_title
                    FROM posts 
                    INNER JOIN users ON users.id = posts.user_id
                    WHERE posts.id = ?
                    LIMIT 1";
        $authorStmt = $this->dbh->prepare($authorQuery);
        $authorStmt->bind_param('i', $postId);
        $authorStmt->execute();
        $authorData = $authorStmt->get_result()->fetch_assoc();

        if ($authorData && !empty($authorData['author_email'])) {
            require_once __DIR__ . '/../includes/mailer.php';

            $commenter = isset($_SESSION['user']['username'])
                ? $_SESSION['user']['username']
                : ($_SESSION['guest_username'] ?? 'Gast');

            try {
                notify_post_author($authorData, $slug, $commenter, $comment);
            } catch (\Throwable $e) {
                error_log('Mail verzenden mislukt: ' . $e->getMessage());
            }
        }

        header("Location: /rea-1/PHP/26-eindopdracht-php/mijn-blog/" . urlencode($slug));
        exit;
    }



    public function getComment($slug)
    {
        $sql = "SELECT 
            comments.id,
            comments.name,
            comments.comment,
            comments.is_deleted,
            comments.deleted_reason,
            comments.created_at,
            comments.likes,         
            comments.dislikes,    
            posts.slug,
            posts.user_id
        FROM comments
        INNER JOIN posts ON comments.post_id = posts.id
        WHERE posts.slug = ?
        ORDER BY comments.created_at DESC";


        $stmt = $this->dbh->prepare($sql);
        $stmt->bind_param('s', $slug);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteComment($commentId, $userId, $reason = null)
    {
        $sql = "SELECT comments.id 
            FROM comments
            INNER JOIN posts ON comments.post_id = posts.id
            WHERE comments.id = ? AND posts.user_id = ?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bind_param('ii', $commentId, $userId);
        $stmt->execute();

        if ($stmt->get_result()->num_rows === 0) {
            return false;
        }

        $stmt = $this->dbh->prepare("UPDATE comments SET is_deleted = 1, deleted_reason = ? WHERE id = ?");
        $stmt->bind_param('si', $reason, $commentId);
        return $stmt->execute();
    }



    public function voteComment(int $commentId, string $vote): bool
    {
        if (!in_array($vote, ['like', 'dislike'], true)) {
            return false;
        }

        $userId = $_SESSION['user']['id'] ?? null;
        $guestId = $_SESSION['guest_id'] ?? null;

        if ($userId === null && $guestId === null) {
            return false;
        }

        if ($userId !== null) {
            $sql = "SELECT id, vote FROM comment_votes WHERE comment_id = ? AND user_id = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bind_param('ii', $commentId, $userId);
        } else {
            $sql = "SELECT id, vote FROM comment_votes WHERE comment_id = ? AND guest_id = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bind_param('ii', $commentId, $guestId);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $existingVote = $result->fetch_assoc();

        if ($existingVote) {
            if ($existingVote['vote'] === $vote) {
                return false;
            }

            if ($vote === 'like') {
                $update = "UPDATE comments SET likes = likes + 1, dislikes = dislikes - 1 WHERE id = ?";
            } else {
                $update = "UPDATE comments SET dislikes = dislikes + 1, likes = likes - 1 WHERE id = ?";
            }

            $stmt = $this->dbh->prepare($update);
            $stmt->bind_param('i', $commentId);
            $stmt->execute();

            $updateVote = "UPDATE comment_votes SET vote = ? WHERE id = ?";
            $stmt = $this->dbh->prepare($updateVote);
            $stmt->bind_param('si', $vote, $existingVote['id']);
            $stmt->execute();

            return true;
        }

        $insert = "INSERT INTO comment_votes (comment_id, user_id, guest_id, vote) VALUES (?, ?, ?, ?)";
        $stmt = $this->dbh->prepare($insert);
        $stmt->bind_param('iiis', $commentId, $userId, $guestId, $vote);
        $success = $stmt->execute();

        if (!$success) {
            return false;
        }

        $update = $vote === 'like'
            ? "UPDATE comments SET likes = likes + 1 WHERE id = ?"
            : "UPDATE comments SET dislikes = dislikes + 1 WHERE id = ?";

        $stmt = $this->dbh->prepare($update);
        $stmt->bind_param('i', $commentId);
        $stmt->execute();

        return true;
    }




    public function getPostsByUser(string $username): array
    {
        $sql = "SELECT posts.*, users.username 
            FROM posts 
            INNER JOIN users ON users.id = posts.user_id
            WHERE users.username = ?
            ORDER BY posts.created_at DESC";

        $stmt = $this->dbh->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostBySlug($slug)
    {
        $sql = "SELECT posts.*, recipes.serves, recipes.total_minutes, recipes.ingredients, recipes.steps
            FROM posts
            INNER JOIN recipes ON posts.id = recipes.post_id
            WHERE posts.slug = ?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bind_param('s', $slug);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }


    public function createPost($title, $content, $image, $serves, $totalMinutes, $ingredients, $steps)
    {
        // 🚫 Blacklist check
        $checkText = $title . ' ' . $content . ' ' . $ingredients . ' ' . $steps;
        if ($badWord = findBlacklistedWord($checkText)) {
            $_SESSION['error'] = "Je post bevat een ongepast woord: '{$badWord}'.";
            return false;
        }

        $slug = str_replace(' ', '-', strtolower($title));
        $user_id = $_SESSION['user']['id'];

        // POST Insert
        $stmt = $this->dbh->prepare(
            "INSERT INTO posts (title, slug, content, image, user_id) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param('ssssi', $title, $slug, $content, $image, $user_id);

        if (!$stmt->execute()) {
            return false;
        }

        $postId = $this->dbh->insert_id;

        // RECIPE Insert
        $stmt = $this->dbh->prepare(
            "INSERT INTO recipes (post_id, serves, total_minutes, ingredients, steps) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param('iiiss', $postId, $serves, $totalMinutes, $ingredients, $steps);
        return $stmt->execute();
    }


    public function updatePost($postId, $title, $content, $image, $serves, $totalMinutes, $ingredients, $steps)
    {
        $checkText = $title . ' ' . $content . ' ' . $ingredients . ' ' . $steps;
        if ($badWord = findBlacklistedWord($checkText)) {
            $_SESSION['error'] = "Je post bevat een ongepast woord: '{$badWord}'.";
            return false;
        }

        $slug = str_replace(' ', '-', strtolower($title));
        $userId = $_SESSION['user']['id'];

        // POSTS Update
        $stmt = $this->dbh->prepare(
            "UPDATE posts 
            SET title = ?, slug = ?, content = ?, image = ?, user_id = ?
            WHERE id = ?"
        );
        $stmt->bind_param('ssssii', $title, $slug, $content, $image, $userId, $postId);

        if (!$stmt->execute()) {
            return false;
        }

        // RECIPES Update
        $stmt = $this->dbh->prepare(
            "UPDATE recipes 
            SET serves = ?, total_minutes = ?, ingredients = ?, steps = ?
            WHERE post_id = ?"
        );
        $stmt->bind_param('iissi', $serves, $totalMinutes, $ingredients, $steps, $postId);
        $success = $stmt->execute();

        return $success;
    }

    public function deletePost($postId)
    {
        $stmt = $this->dbh->prepare("DELETE FROM recipes WHERE post_id = ?");
        $stmt->bind_param('i', $postId);
        $stmt->execute();

        $stmt = $this->dbh->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->bind_param('i', $postId);
        $success = $stmt->execute();

        return $success;
    }


}
=======
<?php

require_once __DIR__ . '/../includes/mailer.php';

class posts
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    public function getPosts(string $sort = 'newest', $limit = 23, ?string $searchQuery = null): array
    {
        switch ($sort) {
            case 'oldest':
                $orderBy = 'posts.created_at ASC';
                break;
            case 'author-asc':
                $orderBy = 'users.username ASC';
                break;
            case 'author-desc':
                $orderBy = 'users.username DESC';
                break;
            case 'newest':
            default:
                $orderBy = 'posts.created_at DESC';
                break;
        }

        $sql = "SELECT 
                posts.title, 
                posts.content, 
                posts.image,
                posts.slug,
                posts.created_at,
                users.username,
                users.email
            FROM users
            INNER JOIN posts ON users.id = posts.user_id";

        $bindValues = [];
        $bindTypes  = '';

        if (!empty($searchQuery)) {
            $sql .= " 
                WHERE posts.title LIKE ? 
                OR posts.content LIKE ? 
                OR users.username LIKE ?";
            $like = "%{$searchQuery}%";
            $bindValues = [$like, $like, $like];
            $bindTypes  = 'sss';
        }


        $sql .= " ORDER BY {$orderBy}";


        if ($limit !== null && $limit !== 'all') {
            $sql .= " LIMIT ?";
            $bindTypes   .= 'i';
            $bindValues[] = (int)$limit;
        }

        $stmt = $this->dbh->prepare($sql);
        if (!empty($bindValues)) {
            $stmt->bind_param($bindTypes, ...$bindValues);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        $posts = [];
        while ($row = $result->fetch_assoc()) {
            $posts[$row['slug']] = $row;
        }

        return $posts;
    }



    public function getRecipe()
    {
        $sql = "SELECT 
            recipes.serves, 
            recipes.total_minutes,
            recipes.ingredients,
            recipes.steps,
            posts.title,
            posts.slug,
            posts.content,
            posts.id
            FROM recipes
            INNER JOIN posts 
            ON recipes.post_id = posts.id ";

        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $recipes = [];
        while ($row = $result->fetch_assoc()) {
            $recipes[$row['slug']] = $row;
        }
        return $recipes;
    }

    public function addComment()
    {
        $slug = $_GET['post'] ?? '';

        $stmt = $this->dbh->prepare("SELECT id FROM posts WHERE slug = ? LIMIT 1");
        $stmt->bind_param('s', $slug);
        $stmt->execute();
        $postArr = $stmt->get_result()->fetch_assoc();

        if (!$postArr) {
            header("Location: /rea-1/PHP/26-eindopdracht-php/mijn-blog/" . urlencode($slug) . "#comments");
            exit;

            exit;
        }

        $postId  = (int)$postArr['id'];
        $comment = $_POST['comment'] ?? '';

        // 🚫 Blacklist check
        if ($badWord = findBlacklistedWord($comment)) {
            $_SESSION['error'] = "Je reactie bevat een verboden woord: '{$badWord}'.";
            header("Location: /rea-1/PHP/26-eindopdracht-php/mijn-blog/" . urlencode($slug));
            exit;
        }



        if (isset($_SESSION['user']['id'])) {
            $userId   = $_SESSION['user']['id'];
            $username = $_SESSION['user']['username'];

            $query = "INSERT INTO comments (post_id, user_id, name, comment, created_at) VALUES (?, ?, ?, ?, NOW())";
            $stmt  = $this->dbh->prepare($query);
            $stmt->bind_param('iiss', $postId, $userId, $username, $comment);
        } else {
            $guestId   = $_SESSION['guest_id'] ?? null;
            $guestName = $_SESSION['guest_username'] ?? 'Gast';

            $query = "INSERT INTO comments (post_id, guest_id, name, comment, created_at) VALUES (?, ?, ?, ?, NOW())";
            $stmt  = $this->dbh->prepare($query);
            $stmt->bind_param('iiss', $postId, $guestId, $guestName, $comment);
        }

        $stmt->execute();

        $authorQuery = "SELECT users.email AS author_email, users.username AS author_username, posts.title AS post_title
                    FROM posts 
                    INNER JOIN users ON users.id = posts.user_id
                    WHERE posts.id = ?
                    LIMIT 1";
        $authorStmt = $this->dbh->prepare($authorQuery);
        $authorStmt->bind_param('i', $postId);
        $authorStmt->execute();
        $authorData = $authorStmt->get_result()->fetch_assoc();

        if ($authorData && !empty($authorData['author_email'])) {
            require_once __DIR__ . '/../includes/mailer.php';

            $commenter = isset($_SESSION['user']['username'])
                ? $_SESSION['user']['username']
                : ($_SESSION['guest_username'] ?? 'Gast');

            try {
                notify_post_author($authorData, $slug, $commenter, $comment);
            } catch (\Throwable $e) {
                error_log('Mail verzenden mislukt: ' . $e->getMessage());
            }
        }

        header("Location: /rea-1/PHP/26-eindopdracht-php/mijn-blog/" . urlencode($slug));
        exit;
    }



    public function getComment($slug)
    {
        $sql = "SELECT 
            comments.id,
            comments.name,
            comments.comment,
            comments.is_deleted,
            comments.deleted_reason,
            comments.created_at,
            comments.likes,         
            comments.dislikes,    
            posts.slug,
            posts.user_id
        FROM comments
        INNER JOIN posts ON comments.post_id = posts.id
        WHERE posts.slug = ?
        ORDER BY comments.created_at DESC";


        $stmt = $this->dbh->prepare($sql);
        $stmt->bind_param('s', $slug);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteComment($commentId, $userId, $reason = null)
    {
        $sql = "SELECT comments.id 
            FROM comments
            INNER JOIN posts ON comments.post_id = posts.id
            WHERE comments.id = ? AND posts.user_id = ?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bind_param('ii', $commentId, $userId);
        $stmt->execute();

        if ($stmt->get_result()->num_rows === 0) {
            return false;
        }

        $stmt = $this->dbh->prepare("UPDATE comments SET is_deleted = 1, deleted_reason = ? WHERE id = ?");
        $stmt->bind_param('si', $reason, $commentId);
        return $stmt->execute();
    }



    public function voteComment(int $commentId, string $vote): bool
    {
        if (!in_array($vote, ['like', 'dislike'], true)) {
            return false;
        }

        $userId = $_SESSION['user']['id'] ?? null;
        $guestId = $_SESSION['guest_id'] ?? null;

        if ($userId === null && $guestId === null) {
            return false;
        }

        if ($userId !== null) {
            $sql = "SELECT id, vote FROM comment_votes WHERE comment_id = ? AND user_id = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bind_param('ii', $commentId, $userId);
        } else {
            $sql = "SELECT id, vote FROM comment_votes WHERE comment_id = ? AND guest_id = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bind_param('ii', $commentId, $guestId);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $existingVote = $result->fetch_assoc();

        if ($existingVote) {
            if ($existingVote['vote'] === $vote) {
                return false;
            }

            if ($vote === 'like') {
                $update = "UPDATE comments SET likes = likes + 1, dislikes = dislikes - 1 WHERE id = ?";
            } else {
                $update = "UPDATE comments SET dislikes = dislikes + 1, likes = likes - 1 WHERE id = ?";
            }

            $stmt = $this->dbh->prepare($update);
            $stmt->bind_param('i', $commentId);
            $stmt->execute();

            $updateVote = "UPDATE comment_votes SET vote = ? WHERE id = ?";
            $stmt = $this->dbh->prepare($updateVote);
            $stmt->bind_param('si', $vote, $existingVote['id']);
            $stmt->execute();

            return true;
        }

        $insert = "INSERT INTO comment_votes (comment_id, user_id, guest_id, vote) VALUES (?, ?, ?, ?)";
        $stmt = $this->dbh->prepare($insert);
        $stmt->bind_param('iiis', $commentId, $userId, $guestId, $vote);
        $success = $stmt->execute();

        if (!$success) {
            return false;
        }

        $update = $vote === 'like'
            ? "UPDATE comments SET likes = likes + 1 WHERE id = ?"
            : "UPDATE comments SET dislikes = dislikes + 1 WHERE id = ?";

        $stmt = $this->dbh->prepare($update);
        $stmt->bind_param('i', $commentId);
        $stmt->execute();

        return true;
    }




    public function getPostsByUser(string $username): array
    {
        $sql = "SELECT posts.*, users.username 
            FROM posts 
            INNER JOIN users ON users.id = posts.user_id
            WHERE users.username = ?
            ORDER BY posts.created_at DESC";

        $stmt = $this->dbh->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostBySlug($slug)
    {
        $sql = "SELECT posts.*, recipes.serves, recipes.total_minutes, recipes.ingredients, recipes.steps
            FROM posts
            INNER JOIN recipes ON posts.id = recipes.post_id
            WHERE posts.slug = ?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bind_param('s', $slug);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }


    public function createPost($title, $content, $image, $serves, $totalMinutes, $ingredients, $steps)
    {
        // 🚫 Blacklist check
        $checkText = $title . ' ' . $content . ' ' . $ingredients . ' ' . $steps;
        if ($badWord = findBlacklistedWord($checkText)) {
            $_SESSION['error'] = "Je post bevat een ongepast woord: '{$badWord}'.";
            return false;
        }

        $slug = str_replace(' ', '-', strtolower($title));
        $user_id = $_SESSION['user']['id'];

        // POST Insert
        $stmt = $this->dbh->prepare(
            "INSERT INTO posts (title, slug, content, image, user_id) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param('ssssi', $title, $slug, $content, $image, $user_id);

        if (!$stmt->execute()) {
            return false;
        }

        $postId = $this->dbh->insert_id;

        // RECIPE Insert
        $stmt = $this->dbh->prepare(
            "INSERT INTO recipes (post_id, serves, total_minutes, ingredients, steps) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param('iiiss', $postId, $serves, $totalMinutes, $ingredients, $steps);
        return $stmt->execute();
    }


    public function updatePost($postId, $title, $content, $image, $serves, $totalMinutes, $ingredients, $steps)
    {
        $checkText = $title . ' ' . $content . ' ' . $ingredients . ' ' . $steps;
        if ($badWord = findBlacklistedWord($checkText)) {
            $_SESSION['error'] = "Je post bevat een ongepast woord: '{$badWord}'.";
            return false;
        }

        $slug = str_replace(' ', '-', strtolower($title));
        $userId = $_SESSION['user']['id'];

        // POSTS Update
        $stmt = $this->dbh->prepare(
            "UPDATE posts 
            SET title = ?, slug = ?, content = ?, image = ?, user_id = ?
            WHERE id = ?"
        );
        $stmt->bind_param('ssssii', $title, $slug, $content, $image, $userId, $postId);

        if (!$stmt->execute()) {
            return false;
        }

        // RECIPES Update
        $stmt = $this->dbh->prepare(
            "UPDATE recipes 
            SET serves = ?, total_minutes = ?, ingredients = ?, steps = ?
            WHERE post_id = ?"
        );
        $stmt->bind_param('iissi', $serves, $totalMinutes, $ingredients, $steps, $postId);
        $success = $stmt->execute();

        return $success;
    }

    public function deletePost($postId)
    {
        $stmt = $this->dbh->prepare("DELETE FROM recipes WHERE post_id = ?");
        $stmt->bind_param('i', $postId);
        $stmt->execute();

        $stmt = $this->dbh->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->bind_param('i', $postId);
        $success = $stmt->execute();

        return $success;
    }


}
>>>>>>> 38ab6e3b03704417fcdbae3e967854145f00a340
