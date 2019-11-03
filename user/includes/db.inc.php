<?php
// php.ini
$ini_array = parse_ini_file("../php.ini");

// Define const variables
define('DB_HOST', $ini_array['MYSQL_HOST']);
define('DB_USER', $ini_array['MYSQL_USER']);
define('DB_PASSWORD', $ini_array['MYSQL_PASS']);
define('DB_NAME', $ini_array['MYSQL_DB']);

// Database Error
$DB_ERROR = [];

// Datbase Connection
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


if (!$connection) {
    $DB_ERROR['Database'] = "Please Setup Database.";
} else {

    if (DB_NAME == '' || !mysqli_select_db($connection, DB_NAME)) {
        $DB_ERROR['Database'] = "Please Setup Database.";
        return;
    }

    // Check Users table exist or not
    if (isset($connection)) {
        $val =  mysqli_query($connection, "SELECT 1 FROM `users`");
        if ($val === false) {
            $DB_ERROR['USER_TABLE'] = "Users Table not exist";
        }
        // Check Posts table exist or not
        $val =  mysqli_query($connection, "SELECT 1 FROM `posts`");
        if ($val === false) {
            $DB_ERROR['POSTS_TABLE'] = "Posts Table not exist";
        }
    }
}
