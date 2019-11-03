<?php
require_once './includes/header.inc.php'
?>

<style>
  .navbar {
    display: none;
    opacity: 0;
  }

  body {
    background-color: #efefef;
  }
</style>

<?php
$_SESSION['USER_ID'] = '';

session_destroy();

?>

<div class="container mt-5 text-center">
  <div class="row">
    <div class="col-md-8 offset-md-2 col-sm-12">
      <div class="jumbotron">
        <h1 class="display-3 text-success">Logout</h1>
        <p class="lead">you are logout.</p>
        <hr class="my-4">
        <p class="lead">
          <?php
          $link = str_replace("post.php", "index.php", $_SERVER["PHP_SELF"]);
          ?>
          <a class="btn btn-primary btn-lg" href="<?= $link ?>" role="button">Login</a>
        </p>
        <a href="" class="btn btn-outline-info btn-lg">Home Page</a>
      </div>
    </div>
  </div>
</div>