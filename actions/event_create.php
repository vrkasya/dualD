<?php
// actions/event_create.php

// Mulai session
session_start();

// Cek apakah user adalah admin
// if (!isset($_SESSION['logged_in']) || $_SESSION['user_role'] !== 'admin') {
//     header('Location: ../index.php');
//     exit();
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $lokasi = $_POST['lokasi'];
    $kategori = $_POST['kategori'];
    $gambar_url = $_POST['gambar_url'];
    $contact = $_POST['contact'] ?? '';
    $speakers = $_POST['speakers'] ?? ['name' => [], 'title' => []];
    $schedule = $_POST['schedule'] ?? ['start_time' => [], 'end_time' => [], 'activity' => []];
    $requirements = $_POST['requirements'] ?? [];
    $creator = $_SESSION['user_email'] ?? 'unknown';

    // Format speakers array
    $formatted_speakers = [];
    for ($i = 0; $i < count($speakers['name']); $i++) {
        if (!empty($speakers['name'][$i]) && !empty($speakers['title'][$i])) {
            $formatted_speakers[] = [
                'name' => $speakers['name'][$i],
                'title' => $speakers['title'][$i]
            ];
        }
    }

    // Format schedule array
    $formatted_schedule = [];
    for ($i = 0; $i < count($schedule['start_time']); $i++) {
        if (!empty($schedule['start_time'][$i]) && !empty($schedule['end_time'][$i]) && !empty($schedule['activity'][$i])) {
            $formatted_schedule[] = [
                'start_time' => $schedule['start_time'][$i],
                'end_time' => $schedule['end_time'][$i],
                'activity' => $schedule['activity'][$i]
            ];
        }
    }

    // Filter requirements
    $filtered_requirements = array_filter($requirements, function($req) {
        return !empty(trim($req));
    });

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
        'contact' => $contact,
        'speakers' => $formatted_speakers,
        'schedule' => $formatted_schedule,
        'requirements' => array_values($filtered_requirements),
        'created_at' => date('Y-m-d H:i:s'),
        'creator' => $creator
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