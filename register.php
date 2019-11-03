<?php
// Page Title
$PAGE_TITLE = "Register";

require_once("includes/header.inc.php");
require_once("includes/functions.inc.php");
?>

<?php
$firstName = $lastName = $email = $username = $password = $rePassword = $agree = '';
$newUserCreated = '';
$errors = [];
$debug = [];

if (isset($_POST['register'])) {
  $firstName = validateFormData($_POST['firstName']);
  $lastName = validateFormData($_POST['lastName']);
  $email = validateFormData($_POST['email']);
  $username = validateFormData($_POST['username']);
  $password = validateFormData($_POST['password']);
  $rePassword = validateFormData($_POST['rePassword']);
  $agree = $_POST['agree'];

  if (
    empty($firstName) || $firstName === '' ||
    empty($lastName) || $lastName === '' ||
    empty($email) || $email === '' ||
    empty($username) || $username === '' ||
    empty($password) || $password === '' ||
    empty($rePassword) || $rePassword === ''
  ) {
    array_push($debug, $firstName, $lastName, $email, $password, $rePassword, $agree);
    array_push($errors, "Please fill all fields.");
  } else {

    array_push($debug, $firstName, $lastName, $email, $username, $password, $rePassword, $agree);
    // Register New User
    if (sizeof($errors) < 0 || sizeof($errors) == 0) {

      // array_push($debug, $firstName, $lastName, $email, $password, $rePassword, $agree);

      // check both password are same or not
      if ($password !== $rePassword) {
        array_push($errors, "Please check password.");
      } else {

        // if user exist  with same email or username than save his/her data in this Array
        $CHECK_USER = [];

        // Check for email
        $q = "SELECT `email`, `username` FROM `users` WHERE `email`='$email' OR `username`='$username'";
        $res = mysqli_query($connection, $q);

        if (mysqli_num_rows($res) > 0) {
          $CHECK_USER = mysqli_fetch_assoc($res);
        }

        // Check Email or Username alredy exist or not
        if (sizeof($CHECK_USER) > 0) {

          // Check for Email
          if ($CHECK_USER['email'] === $email) {
            array_push($errors, "Email already registered.");
          }

          if ($CHECK_USER['username'] === $username) {
            array_push($errors, "Username already registered.");
          }
        } else {

          // Hash Password
          $password_hash = password_hash($password, PASSWORD_DEFAULT);

          $newUser = "INSERT INTO `users`
                (`id`, `first_name`,`last_name`,`email`,`username`, `password`, `updated_at`, `registered_at`)
          VALUES (NULL, '$firstName', '$lastName', '$email','$username', '$password_hash', Now(),Now())";

          $result = mysqli_query($connection, $newUser);

          if ($result) {
            $newUserCreated = true;
            $_SESSION['userId'] = mysqli_insert_id($connection);

            // Clear all fields
            $firstName = $lastName = $email = $username = $password = $rePassword = $agree = '';
          } else {
            $debug = mysqli_error(($connection));
            array_push($errors, mysqli_error($connection));
          }
        }
      }
    }
  }
}

?>

<div class="row mt-5 ml-1 mr-1">
  <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-10 offset-sm-1">
    <!-- <div class="card p-3"> -->
    <h3 style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">Welcome</h3>
    <p class="text-secondary">It only takes a few seconds to create your account
    </p>
    <hr>

    <?php if (sizeof($errors) > 0) : ?>
      <?php foreach ($errors as $error) :  ?>
        <?= showAlert($error, 'danger'); ?>
    <?php endforeach;
    endif; ?>

    <?php if (isset($newUserCreated) && $newUserCreated == true) : ?>
      <div class="alert alert-success">You're successfully registered. now you can login</div>
    <?php endif; ?>

    <form class="needs-validation" action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" novalidate>
      <div class="row">

        <div class="col-md-6 offset-md-0 mb-3">
          <input type="text" class="form-control" placeholder="Firstname" value="<?= isset($firstName) ? $firstName : '' ?>" name="firstName" id="firstName" required>
          <div class="invalid-feedback">
            Valid first name is required.
          </div>
        </div>

        <div class="col-md-6 offset-md-0 mb-3">
          <input type="text" class="form-control" placeholder="Lastname" value="<?= isset($lastName) ? $lastName : '' ?>" name="lastName" required>
          <div class="invalid-feedback">
            Valid last name is required.
          </div>
        </div>
      </div>

      <div class="mb-3">
        <input type="email" class="form-control" placeholder="you@example.com" value="<?= isset($email) ? $email : '' ?>" name="email" required>
        <div class="invalid-feedback">
          Please enter a valid email address.
        </div>
      </div>

      <div class="mb-3">
        <input type="text" class="form-control" placeholder="Username" value="<?= isset($username) ? $username : '' ?>" name="username" required>
        <div class="invalid-feedback">
          Your username is required.
        </div>
      </div>

      <div class="mb-3">
        <input type="password" class="form-control" id="password" placeholder="Password" value="<?= isset($password) ? $password : '' ?>" name="password" required>
        <div class="invalid-feedback">
          Your password is required.
        </div>
      </div>

      <div class="mb-3">
        <input type="password" class="form-control" id="password" placeholder="Re-Password" value="<?= isset($rePassword) ? $rePassword : '' ?>" name="rePassword" required>
        <div class="invalid-feedback">
          Your re password is required.
        </div>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="agree" name="agree" required>
        <label class="form-check-label text-secondary small" for="agree">Creating an account means you’re okay with our <span class="text-primary"> Terms of Service, Privacy Policy,</span> and our default <span class="text-primary">Notification Settings.</span> </label> <br />
        <div class="invalid-feedback">
          You must check Terms of Service and Privacy Policy.
        </div>
      </div>

      <hr class="mb-4">
      <div class="col-sm-8 offset-sm-2 mb-5">
        <button class="btn btn-info btn-lg btn-block" name="register" type="submit">Register Now</button>
      </div>

    </form>
  </div>
  <!-- </div> -->
</div>



<?php require_once("includes/footer.inc.php"); ?>
