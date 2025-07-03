<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'] ?? '';
    $password = $_POST['password'] ?? '';
    $konfirmasi_password = $_POST['konfirmasi_password'] ?? '';

    if ($password !== $konfirmasi_password) {
        $_SESSION['reset_password_error'] = 'Password dan konfirmasi password tidak cocok';
        header('Location: ../pages/reset_password.php?token=' . urlencode($token));
        exit();
    }

    $reset_file = '../database/reset_tokens.txt';
    $user_file = '../database/users.txt';

    if (!file_exists($reset_file) || !file_exists($user_file)) {
        $_SESSION['reset_password_error'] = 'File database tidak ditemukan';
        header('Location: ../pages/reset_password.php?token=' . urlencode($token));
        exit();
    }

    // Verify token and get email
    $reset_lines = file($reset_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $reset_data = [];
    $email = '';
    $token_valid = false;

    foreach ($reset_lines as $line) {
        $item = json_decode($line, true);
        if ($item['token'] === $token && $item['expiry'] >= time()) {
            $email = $item['email'];
            $token_valid = true;
        } else {
            $reset_data[] = $item;
        }
    }

    if (!$token_valid) {
        $_SESSION['reset_password_error'] = 'Token reset password tidak valid atau sudah kadaluarsa';
        header('Location: ../pages/forgot_password.php');
        exit();
    }

    // Update user password
    $user_lines = file($user_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $updated_users = [];

    foreach ($user_lines as $line) {
        $user = json_decode($line, true);
        if ($user['email'] === $email) {
            $user['password'] = password_hash($password, PASSWORD_DEFAULT);
        }
        $updated_users[] = json_encode($user);
    }

    file_put_contents($user_file, implode(PHP_EOL, $updated_users) . PHP_EOL);

    // Save updated reset tokens (remove used token)
    $lines_to_save = array_map(function($item) {
        return json_encode($item);
    }, $reset_data);
    file_put_contents($reset_file, implode(PHP_EOL, $lines_to_save) . PHP_EOL);

    $_SESSION['reset_password_success'] = 'Password berhasil direset. Silakan login dengan password baru Anda.';
    header('Location: ../pages/login.php');
    exit();
} else {
    header('Location: ../index.php');
    exit();
}
