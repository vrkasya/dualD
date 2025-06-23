<?php
// actions/login_process.php

// Mulai session
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $file = '../database/users.txt';
    if (!file_exists($file)) {
        $_SESSION['login_error'] = 'Database pengguna tidak ditemukan';
        header('Location: ../pages/login.php');
        exit();
    }

    $data = file_get_contents($file);
    $users = explode(PHP_EOL, $data);
    $user_found = null;

    foreach ($users as $user_line) {
        if (!empty($user_line)) {
            $user = json_decode($user_line, true);
            if ($user['email'] === $email) {
                $user_found = $user;
                break;
            }
        }
    }

    if ($user_found && password_verify($password, $user_found['password'])) {
        $_SESSION['logged_in'] = true;
        $_SESSION['user_email'] = $user_found['email'];
        $_SESSION['user_nama'] = $user_found['nama'];
        $_SESSION['user_role'] = $user_found['role'] ?? 'user';

        if ($_SESSION['user_role'] === 'admin') {
            header('Location: ../admin/index.php');
        } else {
            header('Location: ../index.php');
        }
        exit();
    } else {
        $_SESSION['login_error'] = 'Email atau password salah';
        header('Location: ../pages/login.php');
        exit();
    }
} else {
    header('Location: ../index.php');
    exit();
}
?>