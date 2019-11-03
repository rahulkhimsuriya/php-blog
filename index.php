<?php
// Page Title
$PAGE_TITLE = "HOME";

require_once "includes/header.inc.php";
?>

<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading">PHP Blog Example</h1>
    <p class="lead text-muted">Welcome to php our php CMS project.</p>
    <p>
      <a href="login.php" class="btn btn-info my-2">Sign in</a>
      <a href="register.php" class="btn btn-outline-secondary my-2">Join now</a>
    </p>
  </div>
</section>

<section id="tech">
  <div class="container text-center">
    <div class="row">
      <div class="col-md-4 offset-md-0 col-xs-10 offset-xs-1">
        <i class="fab fa-php fa-5x mb-1" style="color:#9b59b6;"></i>
        <h4>PHP Front-End</h4>
        <p>PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages.</p>
      </div>
      <div class="col-md-4 offset-md-0 col-xs-10 offset-xs-1">
        <i class="fas fa-database fa-5x mb-2" style="color:#2ecc71;"></i>
        <h4>MySQL Back-End</h4>
        <p>MySQL is the most popular Open Source Relational SQL Database Management System</p>
      </div>
      <div class="col-md-4 offset-md-0 col-xs-10 offset-xs-1">
        <i class="fab fa-css3-alt fa-5x" style="color:#2980b9;"></i>
        <h4>Bootstrap</h4>
        <p>Twitter Bootstrap is the most popular front end framework in the recent time. It is sleek, intuitive, and powerful mobile first front-end framework for faster and easier web development.</p>
      </div>
    </div>
  </div>
</section>

<style>
  .btn {
    width: 150px;
    font-size: 20px;
  }
</style>

<?php require_once "includes/footer.inc.php"; ?>
