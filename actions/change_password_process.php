<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $konfirmasi_password = $_POST['konfirmasi_password'] ?? '';

    if ($password !== $konfirmasi_password) {
        $_SESSION['change_password_error'] = 'Password dan konfirmasi password tidak cocok';
        header('Location: ../pages/change_password.php');
        exit();
    }

    $user_file = '../database/users.txt';

    if (!file_exists($user_file)) {
        $_SESSION['change_password_error'] = 'Database pengguna tidak ditemukan';
        header('Location: ../pages/change_password.php');
        exit();
    }

    $user_lines = file($user_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $updated_users = [];
    $email_found = false;

    foreach ($user_lines as $line) {
        $user = json_decode($line, true);
        if ($user['email'] === $email) {
            $user['password'] = password_hash($password, PASSWORD_DEFAULT);
            $email_found = true;
        }
        $updated_users[] = json_encode($user);
    }

    if (!$email_found) {
        $_SESSION['change_password_error'] = 'Email tidak ditemukan';
        header('Location: ../pages/change_password.php');
        exit();
    }

    file_put_contents($user_file, implode(PHP_EOL, $updated_users) . PHP_EOL);

    $_SESSION['change_password_success'] = 'Password berhasil diubah. Silakan login dengan password baru Anda.';
    header('Location: ../pages/login.php');
    exit();
} else {
    header('Location: ../index.php');
    exit();
}
