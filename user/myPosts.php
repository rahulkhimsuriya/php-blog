<?php
$PAGE_TITLE = "MY ALL POSTS";
require_once 'includes/header.inc.php';
?>

<?php
$user_id = $_SESSION["USER_ID"];
$errors = [];

$q = "SELECT * FROM `posts` WHERE `user_id` = '$user_id'";
$result = mysqli_query($connection, $q);

?>


<div class="container">

  <?php
  // Insert Post Alert
  if (isset($_SESSION["POST_CREATE_ID"]) && $_SESSION["POST_CREATE_ID"] != '') : ?>
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <?= showAlert("New Post Created", "success") ?>
        <?php
          // reset inseted post id to NULL
          $_SESSION['POST_CREATE_ID'] = '';
          ?>
      </div>
    </div>
  <?php endif; ?>

  <div class="row mt-4">

    <div class="col-md-6 offset-md-3 col-sm-12">

      <div class="page-header">
        <h1 id="navbars">Posts</h1>
      </div>

      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Post id</th>
            <th scope="col">Post Title</th>
            <th scope="col">Public/Private</th>
          </tr>
        </thead>
        <tbody>

          <?php if (mysqli_num_rows($result) > 0) :  ?>
            <!-- // output data of each row -->
            <?php while ($post = mysqli_fetch_assoc($result)) : ?>
              <tr>
                <th scope="row"><?= $post["id"] ?></th>
                <?php
                    $link = str_replace("myPosts.php", "post.php", $_SERVER["PHP_SELF"]);
                    $link .= "?postid=" . $post["id"];
                    ?>
                <td><a href="<?= $link ?>"><?= $post["title"] ?></a></td>
                <td><?php if ($post["visible"] == 0) : ?>
                    <span class="badge badge-primary">Private</span>
                  <?php else : ?>
                    <span class="badge badge-success">Public</span>
                  <?php endif; ?></td>
              </tr>
          <?php
            endwhile;
          endif; ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

<?php require_once 'includes/footer.inc.php';
