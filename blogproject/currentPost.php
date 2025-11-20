<<<<<<< HEAD
<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/loginHandler.php';

$currentPage = basename($_SERVER['PHP_SELF']);

$post = new posts($dbh);
$postContent = $post->getPosts();
$recipes = $post->getRecipe();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $post->addComment();
}

$slug = $_GET['post'] ?? '';
$commentArr = $post->getComment($slug);

if (isset($_GET['action']) && $_GET['action'] === 'delete_comment' && isset($_GET['id'])) {
    $commentId = (int)$_GET['id'];
    $userId = $_SESSION['user']['id'] ?? 0;
    $reason = $_POST['reason'] ?? null;

    $postsClass = new posts($dbh);
    if ($postsClass->deleteComment($commentId, $userId, $reason)) {
        header("Location: /rea-1/PHP/26-eindopdracht-php/mijn-blog/" . urlencode($_GET['post']));

        exit;
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vote'], $_POST['comment_id'])) {
    $vote = $_POST['vote'];
    $commentId = (int)$_POST['comment_id'];

    $postClass = new posts($dbh);
    $success = $postClass->voteComment($commentId, $vote);

    if (!$success) {
        $_SESSION['error'] = "Je hebt al gestemd op deze reactie.";
    }

    $slug = $_GET['post'] ?? '';
    header("Location: /rea-1/PHP/26-eindopdracht-php/mijn-blog/" . urlencode($slug) . "#comments");
    exit;
}

// echo '<pre>';
// var_dump($_SESSION);
// echo '</pre>';

$user = new User($dbh);
$lastVisitMessage = $user->lastVisit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/rea-1/PHP/26-eindopdracht-php/mijn-blog/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/default.css"> 
    <link rel="stylesheet" href="css/currentpost.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Document</title>
</head>
<body>

    <div class="container postpage">
<?php
view(PARTS . '/loginPopup.php', [
    'errorMsg' => $errorMsg ?? null
]);
view(PARTS . '/header.php', ['login' => $login]);
view(PARTS . '/main.php', [
    'currentPage' => $currentPage,
    'postContent' => $postContent
]);
view(PARTS . '/recipe.php', [
    'recipes'     => $recipes,
    'key'         => $slug,
    'postContent' => $postContent
]);
view(PARTS . '/comments.php', ['commentArr' => $commentArr]);
view(PARTS . '/footer.php', ['lastVisitMessage' => $lastVisitMessage]);
?>
</body>
</html>
=======
<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/loginHandler.php';

$currentPage = basename($_SERVER['PHP_SELF']);

$post = new posts($dbh);
$postContent = $post->getPosts();
$recipes = $post->getRecipe();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $post->addComment();
}

$slug = $_GET['post'] ?? '';
$commentArr = $post->getComment($slug);

if (isset($_GET['action']) && $_GET['action'] === 'delete_comment' && isset($_GET['id'])) {
    $commentId = (int)$_GET['id'];
    $userId = $_SESSION['user']['id'] ?? 0;
    $reason = $_POST['reason'] ?? null;

    $postsClass = new posts($dbh);
    if ($postsClass->deleteComment($commentId, $userId, $reason)) {
        header("Location: /rea-1/PHP/26-eindopdracht-php/mijn-blog/" . urlencode($_GET['post']));

        exit;
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vote'], $_POST['comment_id'])) {
    $vote = $_POST['vote'];
    $commentId = (int)$_POST['comment_id'];

    $postClass = new posts($dbh);
    $success = $postClass->voteComment($commentId, $vote);

    if (!$success) {
        $_SESSION['error'] = "Je hebt al gestemd op deze reactie.";
    }

    $slug = $_GET['post'] ?? '';
    header("Location: /rea-1/PHP/26-eindopdracht-php/mijn-blog/" . urlencode($slug) . "#comments");
    exit;
}

// echo '<pre>';
// var_dump($_SESSION);
// echo '</pre>';

$user = new User($dbh);
$lastVisitMessage = $user->lastVisit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/rea-1/PHP/26-eindopdracht-php/mijn-blog/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/default.css"> 
    <link rel="stylesheet" href="css/currentpost.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Document</title>
</head>
<body>

    <div class="container postpage">
<?php
view(PARTS . '/loginPopup.php', [
    'errorMsg' => $errorMsg ?? null
]);
view(PARTS . '/header.php', ['login' => $login]);
view(PARTS . '/main.php', [
    'currentPage' => $currentPage,
    'postContent' => $postContent
]);
view(PARTS . '/recipe.php', [
    'recipes'     => $recipes,
    'key'         => $slug,
    'postContent' => $postContent
]);
view(PARTS . '/comments.php', ['commentArr' => $commentArr]);
view(PARTS . '/footer.php', ['lastVisitMessage' => $lastVisitMessage]);
?>
</body>
</html>
>>>>>>> 38ab6e3b03704417fcdbae3e967854145f00a340
