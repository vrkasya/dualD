<?php
// actions/login_process.php

// Mulai session
session_start();

// Data user dummy (dalam aplikasi nyata, ini akan diganti dengan database)
$valid_users = [
    'admin@eventkampus.com' => [
        'password' => 'admin123', // Dalam aplikasi nyata, password harus di-hash
        'nama' => 'Administrator',
        'role' => 'admin'
    ],
    'user@eventkampus.com' => [
        'password' => 'user123',
        'nama' => 'User Biasa',
        'role' => 'user'
    ]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Validasi login
    if (isset($valid_users[$email]) && $valid_users[$email]['password'] === $password) {
        // Set session
        $_SESSION['logged_in'] = true;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_nama'] = $valid_users[$email]['nama'];
        $_SESSION['user_role'] = $valid_users[$email]['role'];
        
        // Redirect ke halaman sesuai role
        if ($_SESSION['user_role'] === 'admin') {
            header('Location: ../admin/index.php');
        } else {
            header('Location: ../index.php');
        }
        exit();
    } else {
        // Login gagal
        $_SESSION['login_error'] = 'Email atau password salah';
        header('Location: ../pages/login.php');
        exit();
    }
} else {
    // Jika akses langsung ke file action
    header('Location: ../index.php');
    exit();
}
?>