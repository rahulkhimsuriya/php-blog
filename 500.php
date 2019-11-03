<?php
// Page Title
$PAGE_TITLE = "Database Config.";

require_once("includes/header.inc.php");
require_once("includes/functions.inc.php");
?>

<?php
// Redirect if Database is Setup
if (empty($DB_ERROR)) {
  redirectTo("index.php");
}
?>

<div class="container text-center">
  <div class="row">

    <div class="col-md-6 offset-md-1">
      <img src="assets/img/database.jpg" alt="Database Error" srcset="Dabase Connection Eroor :(" class="img img-fluid">

      <?php
      // var_dump($DB_ERROR);
      foreach ($DB_ERROR as $key => $value) {
        echo "<h3>" . $value . "</h3>";
      }
      ?>
    </div>

    <div class="col-md-4 offset-md-0 mt-auto">
      <div class="card card-header">
        <h3 class=" card-title text-primary">Config Database</h3>
        <div class="card-body text-muted text-left">
          <p>Step 1 : Create Database</p>
          <p>Step 2 : fill up your mysql config. in (php.ini) (like host,user,password, db name) </p>
          <p>Step 3 : open your database and import (php_blog.sql) </p>
          <p>Step 4 : You're ready to expore. :) </p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once("includes/footer.inc.php"); ?>