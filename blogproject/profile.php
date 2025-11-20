<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/loginHandler.php';

$user = new User($dbh);

if (!$user->isLoggedIn()) {
    header('Location: /rea-1/PHP/26-eindopdracht-php/mijn-blog/home');


    exit;
}
$currentTab = $_GET['tab'] ?? 'posts';
$currentPage = basename($_SERVER['PHP_SELF']);
$username = $_SESSION['user']['username'] ?? '';
$post = new posts($dbh);
$userPosts = $post->getPostsByUser($username);

$errorMsg = '';

if (isset($_POST['create_post'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $serves = $_POST['serves'];
    $totalMinutes = $_POST['total_minutes'];

    $ingredientsArray = explode(PHP_EOL, $_POST['ingredients']);
    $stepsArray = explode(PHP_EOL, $_POST['steps']);

    $ingredientsJson = json_encode($ingredientsArray);
    $stepsJson = json_encode($stepsArray);

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $originalName = $_FILES['image']['name'];
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        $newFileName = uniqid('img_', true) . '.' . $extension;

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($extension, $allowedTypes)) {
            $errorMsg = "Alleen afbeeldingsbestanden zijn toegestaan (jpg, png, gif, webp)";
        } else {
            $destination = __DIR__ . '/images/' . $newFileName;

            if (move_uploaded_file($imageTmpPath, $destination)) {
                $postsClass = new posts($dbh);
                $success = $postsClass->createPost(
                    $title,
                    $content,
                    $newFileName,
                    $serves,
                    $totalMinutes,
                    $ingredientsJson,
                    $stepsJson
                );

                if ($success) {
                    header("Location: /rea-1/PHP/26-eindopdracht-php/mijn-blog/profile/posts");
                    exit;
                } else {
                    $errorMsg = "Post opslaan mislukt.";
                }
            } else {
                $errorMsg = "Afbeelding kon niet verplaatst worden.";
            }
        }
    } else {
        $errorMsg = "Geen afbeelding geselecteerd of fout bij uploaden.";
    }
}

$editTitle = $editContent = $editIngredients = $editSteps = '';
$editServes = $editMinutes = 1;
$slug = '';

if ($currentTab === 'edit' && isset($_GET['slug'])) {
    $slug = $_GET['slug'];
    $postClass = new posts($dbh);
    $editPost = $postClass->getPostBySlug($slug);

    if ($editPost) {
        $editTitle = $editPost['title'];
        $editContent = $editPost['content'];
        $editServes = $editPost['serves'];
        $editMinutes = $editPost['total_minutes'];
        $editIngredients = implode(PHP_EOL, json_decode($editPost['ingredients'], true) ?? []);
        $editSteps = implode(PHP_EOL, json_decode($editPost['steps'], true) ?? []);
    }
    if (isset($_POST['update_post'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $serves = $_POST['serves'];
        $totalMinutes = $_POST['total_minutes'];
        $ingredientsJson = json_encode(explode(PHP_EOL, $_POST['ingredients']));
        $stepsJson = json_encode(explode(PHP_EOL, $_POST['steps']));
        $image = $editPost['image'];


        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageTmpPath = $_FILES['image']['tmp_name'];
            $originalName = $_FILES['image']['name'];
            $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
            $newFileName = uniqid('img_', true) . '.' . $extension;
            $destination = __DIR__ . '/images/' . $newFileName;

            if (move_uploaded_file($imageTmpPath, $destination)) {
                $image = $newFileName;
            }
        }

        $success = $post->updatePost(
            $editPost['id'],
            $title,
            $content,
            $image,
            $serves,
            $totalMinutes,
            $ingredientsJson,
            $stepsJson
        );

        if ($success) {
            header("Location: /rea-1/PHP/26-eindopdracht-php/mijn-blog/profile/posts");

            exit;
        } else {
            $errorMsg = "Bewerken mislukt.";
        }
    }
}
if (isset($_POST['delete_post']) && $_POST['delete_post'] === 'true' && !empty($_POST['slug'])) {
    $slug = $_POST['slug'];
    $postClass = new posts($dbh);
    $deletePost = $postClass->getPostBySlug($slug);

    if ($deletePost) {
        $success = $postClass->deletePost($deletePost['id']);
        if ($success) {
            header("Location: /rea-1/PHP/26-eindopdracht-php/mijn-blog/profile/posts");
            exit;
        } else {
            $errorMsg = "Verwijderen mislukt.";
        }
    }
}


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
    <link rel="stylesheet" href="css/profile.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.tiny.cloud/1/0rmffc9py78i5222ybsvd0w2zcbfeynfao88vx2fd6c24631/tinymce/8/tinymce.min.js" referrerpolicy="origin"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  tinymce.init({
    selector: 'textarea.wysiwyg',
    menubar: false,
    toolbar: 'undo redo | bold italic underline | bullist numlist | link image | code',
    plugins: 'lists link image code',
    height: 320,
    setup: function (editor) {
      // Sync inhoud terug naar <textarea> zodra er iets verandert
      editor.on('change', function () {
        editor.save();
      });
    }
  });
});
</script>

    <title>Document</title>         
</head>
<body>

    <div class="container postpage">
<?php
view(PARTS . '/header.php', ['login' => $login]);
view(PARTS . '/profileSidebar.php', [
    'currentTab' => $currentTab
]);
view(PARTS . '/profileTabs.php', [
    'errorMsg' => $errorMsg,
    'currentTab' => $currentTab,
    'currentPage' => $currentPage,
    'userPosts' => $userPosts,
    'slug' => $slug,
    'editTitle' => $editTitle,
    'editContent' => $editContent,
    'editServes' => $editServes,
    'editMinutes' => $editMinutes,
    'editIngredients' => $editIngredients,
    'editSteps' => $editSteps,
]);

view(PARTS . '/footer.php', ['lastVisitMessage' => $lastVisitMessage]);
?>
    </div>
</body>
</html>
