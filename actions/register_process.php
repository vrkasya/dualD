<?php
session_start();
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Check if email already exists
    $checkSql = "SELECT id FROM users WHERE email = '$email'";
    $checkResult = $conn->query($checkSql);
    if ($checkResult && $checkResult->num_rows > 0) {
        $_SESSION['error'] = "Email already registered.";
        header("Location: ../pages/register.php");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Registration successful. Please login.";
        header("Location: ../pages/login.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $conn->error;
        header("Location: ../pages/register.php");
        exit();
    }
}
?>
