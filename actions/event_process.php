<?php
// dualD/actions/event_process.php

session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: ../login.php');
    exit();
}

$user_role = $_SESSION['user_role'] ?? '';
$user_email = $_SESSION['user_email'] ?? '';

// Daftar kategori yang diizinkan
$kategoriList = ['Semua', 'seminar', 'workshop', 'kompetisi', 'hiburan', 'pelatihan'];

// Ambil filter kategori dari URL
$selectedKategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'Semua';
if (!in_array(strtolower($selectedKategori), array_map('strtolower', $kategoriList))) {
    $selectedKategori = 'Semua'; // fallback jika kategori tidak valid
}

// Baca data dari file
$file = '../database/events.txt';
$events = [];

if (file_exists($file)) {
    $data = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($data as $line) {
        $event = json_decode($line, true);
        if ($event) {
            // Fallback jika "waktu" kosong, gabungkan waktu_mulai dan waktu_selesai
            if (empty($event['waktu']) && isset($event['waktu_mulai']) && isset($event['waktu_selesai'])) {
                $event['waktu'] = $event['waktu_mulai'] . ' - ' . $event['waktu_selesai'];
            }
            $events[] = $event;
        }
    }
}

// Filter berdasarkan kategori jika bukan 'Semua'
if (strtolower($selectedKategori) !== 'semua') {
    $events = array_filter($events, function ($event) use ($selectedKategori) {
        return strtolower($event['kategori']) === strtolower($selectedKategori);
    });
}

// Filter berdasarkan search term jika ada
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
if ($searchTerm !== '') {
    $events = array_filter($events, function ($event) use ($searchTerm) {
        return stripos($event['judul'], $searchTerm) !== false || stripos($event['deskripsi'], $searchTerm) !== false;
    });
}

// Pagination
$perPage = 6;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$totalEvents = count($events);
$totalPages = ceil($totalEvents / $perPage);
$start = ($page - 1) * $perPage;
$paginatedEvents = array_slice($events, $start, $perPage);

// Load participants from list_peserta.txt
$participants_file = '../database/list_peserta.txt';
$participants = [];
if (file_exists($participants_file)) {
    $content = file_get_contents($participants_file);
    $participants = json_decode($content, true) ?: [];
}

// Function to check if user is registered for event
function isUserRegistered($event_id, $user_email, $participants) {
    return isset($participants[$event_id]) && in_array($user_email, $participants[$event_id]);
}

?>
