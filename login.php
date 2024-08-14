<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Define valid admin credentials
    $validEmail = 'admin';
    $validPassword = 'admin123';

    if ($email == $validEmail && $password == $validPassword) {
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Invalid email or password";
    }
}
?>
