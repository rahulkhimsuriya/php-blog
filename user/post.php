<?php
// Page Title
$PAGE_TITLE = "POST";
require_once 'includes/header.inc.php';
?>

<?php
$errors = '';
$postId = $_GET['postid'] ?? '';

if (isset($postId) && !empty($postId)) {
  $post = findWhere('posts', 'id', $postId, 1, $_SESSION['USER_ID']);

  if ($post == '' || empty($post)) {
    $errors = "Post is private. you cannot access this page";
  }
} else {
  $errors = "Post not found.";
}
?>

<div class="container mt-5">

  <?php if (isset($_SESSION["POST_UPDATE_ID"]) && $_SESSION["POST_UPDATE_ID"] != '') : ?>

    <div class="row">
      <div class="col-md-8 offset-md-2">
        <?= showAlert("Your post is updated successfully.", "success") ?>
        <?php $_SESSION["POST_UPDATE_ID"] = ''; ?>
      </div>
    </div>

  <?php endif; ?>

  <div class="row">


    <?php if ($errors != '') : ?>

      <div class="col-md-10 offset-md-1 mt-5 text-center">
        <div class="jumbotron">
          <h1 class="display-3 text-danger">Private Post</h1>
          <p class="lead">you can not access this post. this post is someone's private post.</p>
          <hr class="my-4">
          <p class="lead">
            <?php
              $link = str_replace("post.php", "index.php", $_SERVER["PHP_SELF"]);
              ?>
            <a class="btn btn-primary btn-lg" href="<?= $link ?>" role="button">BACK TO MAIN PAGE</a>
          </p>
        </div>
      </div>

    <?php else : ?>

      <div class="col-md-8 offset-md-2 col-sm-10 offset-sm-1">

        <div class="jumbotron">
          <h1 class="display-3"><?= $post['title'] ?>
          </h1>
          <p class="lead"><?= $post['body'] ?>
          </p>
          <hr class="my-4">
          <p class="lead text-justify">
            <?php $link = str_replace("post.php", "index.php", $_SERVER["PHP_SELF"]); ?>
            <a class="btn btn-primary btn-lg" href="<?= $link ?>" role="button">BACK</a>

            <?php if ($_SESSION["USER_ID"] == $post["user_id"]) : ?>

              <?php $link = str_replace("post.php", "editPost.php?postid=" . $post['id'], $_SERVER["PHP_SELF"]); ?>
              <a class="btn btn-warning btn-lg" href="<?= $link ?>" role="button">EDIT</a>
              <button type="button" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#exampleModal">
                DELETE
              </button>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Are you sure ? you want to delete this Post.
                    </div>
                    <div class="modal-footer">

                      <?php $link = str_replace("post.php", "deletePost.php?postid=" . $post['id'], $_SERVER["PHP_SELF"]) ?>

                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <a type="submit" name="deletePost" href="<?= $link ?>" class="btn btn-primary">Yes</a>
                    </div>
                  </div>
                </div>
              </div>

            <?php endif; ?>

          </p>
        </div>
      </div>

    <?php endif; ?>

  </div>
</div>


<?php
require_once 'includes/footer.inc.php';
