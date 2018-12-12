<?php
$link = mysqli_connect('127.0.0.1', 'yimmplayground_ijruiz2', 'yimmypassword', 'yimmplayground_first_database');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$email = $_POST["email"];
$password = $_POST["password"];

$sql = "SELECT *
        FROM User u
        WHERE '$email' = u.email AND '$password' = u.password";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) == 1) {
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location:https://yimmplayground.web.illinois.edu/login.php');
        exit();
    } else {
        header('Location:https://yimmplayground.web.illinois.edu/');
        exit();
    }
} else {
     echo "ERROR: Could not able to execute $sql. "
            .mysqli_error($link);
}
?>