<?php require_once 'includes/header.inc.php'; ?>


<?php
// Delete Post
$deletePostId = $_GET["postid"];

if (isset($deletePostId)) {
    $q = "DELETE FROM `posts` WHERE `id` = '$deletePostId'";
    $result = mysqli_query($connection, $q);
    if ($result) {
        $_SESSION['DELETE_POST_ID'] = $deletePostId;
        redirectTo("index.php");
    } else {
        $errors ="Some thing went wrong.:(";
    }
} else {
    redirectTo("index.php");
}
?>


<?php require_once 'includes/footer.inc.php';
