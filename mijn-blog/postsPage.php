<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/loginHandler.php';
$currentPage = basename($_SERVER['PHP_SELF']);

$post = new posts($dbh);

$sort   = $_POST['sort'] ?? 'newest';
$limit  = $_POST['limit'] ?? 8;
$search = trim($_POST['q'] ?? '');

$postContent = $post->getPosts($sort, $limit, $search);
// echo '<pre>';
// var_dump($postContent);
// echo '</pre>';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $post->addComment();
}

$slug = $_GET['post'] ?? '';
$commentArr = $post->getComment($slug);

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
    <link rel="stylesheet" href="css/post.css"> 
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
        'postContent' => $postContent,
        'currentPage' => $currentPage
                ]);
view(PARTS . '/footer.php', ['lastVisitMessage' => $lastVisitMessage]);
?>
    </div>
</body>
</html>