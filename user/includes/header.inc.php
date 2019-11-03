<?php
// session start
session_start();

// Authenticated User
if (!isset($_SESSION["USER_ID"]) && $_SESSION["USER_ID"] == '') {
  header("Location: ../login.php");
}


// check Mod (Prod or Dev)
$ini_array = parse_ini_file("../php.ini");

if ($ini_array["PROD_MOD"] == true) {
  ini_set("error_reporting", "~E_NOTICE");
}

// Database connection file
require_once "includes/db.inc.php";

// functions
require_once "includes/functions.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP BLOG : <?php echo $PAGE_TITLE ?>
  </title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,700i,800&display=swap" rel="stylesheet">

  <!--  Bootstrap CSS -->
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="assets/fa/font-awesome.min.css"> -->
  <script src="https://kit.fontawesome.com/07c04c5cdb.js" crossorigin="anonymous"></script>
  <!-- CSS -->
  <link rel="stylesheet" href="../css/style.css">

</head>

<body>
  <!-- Navbar -->
  <?php require_once "navbar.inc.php";
