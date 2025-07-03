<?php
// actions/register_process.php

// Mulai session
session_start();

// Simpan data ke file (simulasi database)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];
    
    // Validasi password
    if ($password !== $konfirmasi_password) {
        $_SESSION['register_error'] = 'Password dan konfirmasi password tidak cocok';
        header('Location: ../pages/register.php');
        exit();
    }
    
    // Data user
    $user = [
        'nama' => $nama,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT), // Hash password for security
        'role' => 'user', // Default role user
        'registered_at' => date('Y-m-d H:i:s')
    ];
    
    // Simpan ke file (simulasi database)
    $file = '../database/users.txt';
    $data = file_get_contents($file);
    
    // Cek apakah email sudah terdaftar
    $users = explode(PHP_EOL, $data);
    foreach ($users as $user_line) {
        if (!empty($user_line)) {
            $existing_user = json_decode($user_line, true);
            if ($existing_user['email'] === $email) {
                $_SESSION['register_error'] = 'Email sudah terdaftar';
                header('Location: ../pages/register.php');
                exit();
            }
        }
    }
    
    // Tambahkan user baru
    $data .= json_encode($user) . PHP_EOL;
    file_put_contents($file, $data);
    
    // Set session sukses
    $_SESSION['registration_success'] = true;
    
    // Redirect ke halaman login
    header('Location: ../pages/login.php?registered=1');
    exit();
} else {
    // Jika akses langsung ke file action
    header('Location: ../index.php');
    exit();
}
