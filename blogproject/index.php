<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/loginHandler.php';
$currentPage = basename($_SERVER['PHP_SELF']);

$post = new posts($dbh);
$filter = null;
$limitPost = $post->getPosts('newest', 3);
$postContent = $post->getPosts('newest', 'all');
$recentPosts = $post->getPosts('newest', 7);


$user = new User($dbh);
$lastVisitMessage = $user->lastVisit();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="/rea-1/PHP/26-eindopdracht-php/mijn-blog/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/default.css"> 
    <link rel="stylesheet" href="css/index.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Document</title>
</head>
<body>
    <div class="container indexpage">

<?php
view(PARTS . '/loginPopup.php', [
    'errorMsg' => $errorMsg ?? null
]);
view(PARTS . '/header.php', ['login' => $login]);
view(PARTS . '/main.php', [
'currentPage' => $currentPage,
'limitPost'   => $limitPost,
'postContent' => $postContent,
]);
view(PARTS . '/aside.php', ['recentPosts' => $recentPosts]);
view(PARTS . '/footer.php', ['lastVisitMessage' => $lastVisitMessage]);
?>
</body>
</html>