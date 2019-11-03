<?php
$PAGE_TITLE = "CREATE NEW POST";
require_once 'includes/header.inc.php'; ?>

<?php
$user_id = $_SESSION["USER_ID"];
$postTitle = $postBody = $postVisible = '';
$errors = [];

if (isset($_POST["createPost"])) {
    $postTitle = htmlspecialchars($_POST['postTitle']);
    $postBody = htmlspecialchars($_POST['postBody']);
    $postVisible = $_POST['postVisible'];

    if (!isset($postTitle) || $postTitle == '' || !isset($postBody) || $postBody == '' ||
    !isset($postVisible) || $postVisible == '') {
        array_push($errors, "All fields are required.");
    } else {
        $q = "INSERT INTO `posts` (`id`,`user_id`, `title`, `body`, `visible`, `updated_at`, `created_at`) VALUES (NULL, '$user_id', '$postTitle', '$postBody', '$postVisible', Now(),Now())";

        $result = mysqli_query($connection, $q);
        if ($result) {
            // set a inserted post's id in session
            $_SESSION["POST_CREATE_ID"] = mysqli_insert_id($connection);
            redirectTo("myPosts.php");
        } else {
            array_push($errors, "Post is not created. some issue here.");
        }
    }
}

?>



<div class="container">
  <div class="row">
    <div class="col-md-8 offset-md-2 col-sm-10 offset-sm-1 mt-3">

      <!-- Alets -->
      <?php if (sizeof($errors)) : ?>
      <?php foreach ($errors as $error) :  ?>
      <?php echo showAlert($error, 'danger'); ?>
      <?php
            endforeach;
        endif; ?>

      <div class="card">
        <div class="card-header">
          <h3 class="text-muted font-weight-bold">Create a new post</h3>
        </div>
        <div class="card-body">

          <form action="#" method="POST" class="needs-validation" novalidate>

            <div class="form-group">
              <label for="postTitle">Post Title:</label>
              <input type="text" class="form-control" name="postTitle" id="postTitle" placeholder="Post Title" required>
              <div class="invalid-feedback">
                Post Title is required field.
              </div>
            </div>

            <div class="form-group">
              <label for="postBody">Post Body:</label>
              <textarea name="postBody" class="form-control" rows="6" id="postBody" placeholder="Write a Post.."
                required></textarea>
              <div class="invalid-feedback">
                Post bosy is required field.
              </div>
            </div>

            <div class="form-group">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="postVisible" id="inlineRadio1" value="1" required
                  checked>
                <label class="form-check-label" for="inlineRadio1">Public</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="postVisible" id="inlineRadio2" value="0" required>
                <label class="form-check-label" for="inlineRadio2">Private</label>

                <div class="invalid-feedback ml-2">Please check is required.</div>
              </div>
            </div>

            <div class="form-group mt-3">
              <button type="submit" name="createPost" class="btn btn-success btn-lg">CREATE POST</button>

            </div>
            <div class="text-right">
              <button type="reset" class="btn btn-danger">RESET</button>
              <a href="index.php" class="btn btn-outline-dark">GO BACK</a>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>


<?php require_once 'includes/footer.inc.php';
