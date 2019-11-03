<?php
$PAGE_TITLE = "PROFILE";
require_once './includes/header.inc.php' ?>

<?php
$userid = $_SESSION["USER_ID"];
$user = [];
$errors = [];
$success = [];

$q = "SELECT * FROM `users` WHERE `id`=$userid LIMIT 1";
$result = mysqli_query($connection, $q);
if ($result) {
  $user = mysqli_fetch_assoc($result);
} else {
  array_push($errors, "can not get user data");
}
?>

<?php
// Change Info...

$firstName = $lastName = '';

if (isset($_POST["changeInfo"])) {

  $firstName = validateFormData($_POST["firstName"]);
  $lastName = validateFormData($_POST["lastName"]);

  if (!empty($firstName) && !empty($lastName)) {

    $q = "UPDATE `users` SET `first_name`='$firstName', `last_name`='$lastName' WHERE `id`='$userid'";
    $result = mysqli_query($connection, $q);

    if ($result) {
      array_push($success, "Profile info udated successfully;");
      $user["first_name"] = $firstName;
      $user["last_name"] = $lastName;
    } else {
      array_push($errors, "can not update profile info.");
    }
  } else {
    array_push($errors, "Please fill all required fields");
  }
}

?>

<?php
// Change Password

$password = $rePassword = $password_hash = '';

if (isset($_POST["changePass"])) {

  $password = $_POST["password"];
  $rePassword = $_POST["rePassword"];

  if ($password !== $rePassword) {
    array_push($errors, "Please check password . both are not the same");
  } else {
    if (!empty($password) && !empty($rePassword)) {

      $password_hash = password_hash($password, PASSWORD_DEFAULT);

      $q = "UPDATE `users` SET `password`='$password_hash' WHERE `id`='$userid'";
      $result = mysqli_query($connection, $q);

      if ($result) {
        array_push($success, "Password udated successfully;");
      } else {
        array_push($errors, "can not update profile info.");
      }
    } else {
      array_push($errors, "Please fill all required fields");
    }
  }
}

?>


<div class="container mt-4">
  <div class="page-header">
    <h1 id="navbars">Profile</h1>
    <hr>
  </div>

  <div class="row">

    <div class="col-sm-12 col-md-6 offset-md-3">

      <?php if (sizeof($errors) > 0) : ?>
        <?php foreach ($errors as $error) :  ?>
          <?= showAlert($error, 'danger'); ?>
      <?php endforeach;
      endif; ?>

      <?php if (sizeof($success) > 0) : ?>
        <?php foreach ($success as $s) :  ?>
          <?= showAlert($s, 'success'); ?>
      <?php endforeach;
      endif; ?>
    </div>


    <div class="col-md-6 col-sm-12">

      <div class="page-header">
        <h4>Profile Info.</h4>
        <hr>
      </div>

      <form class="needs-validation" action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" novalidate>

        <div class="mb-3">
          <input type="text" class="form-control" placeholder="Firstname" value="<?= $user["first_name"] ?>" name="firstName" id="firstName" required>
          <div class="invalid-feedback">
            first name is required.
          </div>
        </div>

        <div class="mb-3">
          <input type="text" class="form-control" placeholder="Lastname" value="<?= $user["last_name"] ?>" name="lastName" required>
          <div class="invalid-feedback">
            last name is required.
          </div>
        </div>

        <div class="mb-3">
          <input type="email" class="form-control disabled" placeholder="you@example.com" value="<?= $user["email"] ?>" name="email" required disabled>
          <div class="invalid-feedback">
            Please enter a valid email address.
          </div>
        </div>

        <div class="mb-3">
          <input type="text" class="form-control disabled" placeholder="Username" value="<?= $user["username"] ?>" name="username" required disabled>
          <div class="invalid-feedback">
            Your username is required.
          </div>
        </div>

        <hr class="mb-4">
        <button class="btn btn-primary btn-lg" name="changeInfo" type="submit">Submit Changes</button>

      </form>

    </div>

    <div class="col-md-6 col-sm-12">

      <div class="page-header">
        <h4>Change Password</h4>
        <hr>
      </div>

      <form class="needs-validation" action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" novalidate>

        <div class="mb-3">
          <input type="password" class="form-control disabled" placeholder="Password" value="" name="password" required>
          <div class="invalid-feedback">
            Please enter a Password.
          </div>
        </div>

        <div class="mb-3">
          <input type="password" class="form-control disabled" placeholder="Re-Password" value="" name="rePassword" required>
          <div class="invalid-feedback">
            Please re enter a Password.
          </div>
        </div>

        <hr class="mb-4">
        <button class="btn btn-success btn-lg" name="changePass" type="submit">Change Password</button>

      </form>

    </div>


  </div>

</div>

<?php require_once './includes/footer.inc.php' ?>