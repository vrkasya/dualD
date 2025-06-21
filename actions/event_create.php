<?php
// actions/event_create.php

// Mulai session
session_start();

// Cek apakah user adalah admin
if (!isset($_SESSION['logged_in']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

// Simpan data event baru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $lokasi = $_POST['lokasi'];
    $kategori = $_POST['kategori'];
    $gambar_url = $_POST['gambar_url'];
    
    // Data event
    $event = [
        'id' => uniqid(),
        'judul' => $judul,
        'deskripsi' => $deskripsi,
        'tanggal' => $tanggal,
        'waktu' => $waktu,
        'lokasi' => $lokasi,
        'kategori' => $kategori,
        'gambar_url' => $gambar_url,
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    // Simpan ke file (simulasi database)
    $file = '../database/events.txt';
    $data = file_get_contents($file);
    $data .= json_encode($event) . PHP_EOL;
    file_put_contents($file, $data);
    
    // Set session sukses
    $_SESSION['event_created'] = true;
    
    // Redirect ke dashboard admin
    header('Location: ../admin/index.php');
    exit();
} else {
    // Jika akses langsung ke file action
    header('Location: ../admin/index.php');
    exit();
}
?>