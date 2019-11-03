<?php
// Redirect
function redirectTo($url)
{
    header('Location: ' . $url);
}

//clear users injection
function validateFormData($formData)
{
    $formData = trim(
        stripslashes(
            htmlspecialchars(
                strip_tags(
                    str_replace(array('(', ')'), '', $formData)
                ),
                ENT_QUOTES
            )
        )
    );
    return $formData;
}

// Alert
function showAlert($message, $class)
{
    return '<div class="alert alert-' . $class . ' mt-3">
  <button type="button" class="close" data-dismiss="alert">&times;</button>' .
    $message . '
  </div>';
}

// Authenticated
function Authenticated()
{
    if ($_SESSION['USER_ID']) {
        redirectTo("/user");
    }
}

// DATABASE QUERY
function find($table, ?string $field = '*')
{
    global $connection;
    $q = "SELECT $field FROM `$table`";
    $result = mysqli_query($connection, $q);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return mysqli_error($connection);
    }
}

// Where
function findWhere($table, $field, $value, ?int $visible = 1, ?int $userId = null)
{
    global $connection;
    if ($visible == 1) {
        $q = "SELECT * FROM `$table` WHERE $field= $value";
    } else {
        $q = "SELECT * FROM `$table` WHERE $field= '$value' AND `user_id` = '$userId'";
    }
    $result = mysqli_query($connection, $q);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return mysqli_error($connection);
    }
}
