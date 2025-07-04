<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: ../login.php');
    exit();
}

$user_role = $_SESSION['user_role'];
$user_email = $_SESSION['user_email'] ?? '';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/dashboard.php');
    exit();
}

$id = $_POST['id'] ?? '';
$judul = trim($_POST['judul'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$tanggal = trim($_POST['tanggal'] ?? '');
$waktu_mulai = trim($_POST['waktu_mulai'] ?? '');
$waktu_selesai = trim($_POST['waktu_selesai'] ?? '');
$waktu = $waktu_mulai . ' - ' . $waktu_selesai;
$lokasi = trim($_POST['lokasi'] ?? '');
$gambar_url = trim($_POST['gambar_url'] ?? '');
$contact = trim($_POST['contact'] ?? '');
$speakers = $_POST['speakers'] ?? ['name' => [], 'title' => []];
$schedule = $_POST['schedule'] ?? ['start_time' => [], 'end_time' => [], 'activity' => []];
$requirements = $_POST['requirements'] ?? [];

if (!$id || !$judul || !$deskripsi || !$kategori || !$tanggal || !$waktu || !$lokasi || !$gambar_url || !$contact) {
    $_SESSION['error'] = 'Semua field harus diisi.';
    header("Location: ../pages/event_edit.php?id=" . urlencode($id));
    exit();
}

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

// Load events
$events_file = '../database/events.txt';
$events = [];
if (file_exists($events_file)) {
    $lines = file($events_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $event = json_decode($line, true);
        if ($event) {
            $events[] = $event;
        }
    }
} else {
    $_SESSION['error'] = 'File events tidak ditemukan.';
    header("Location: ../pages/event_edit.php?id=" . urlencode($id));
    exit();
}

// Find and update event
$found = false;
foreach ($events as &$event) {
    if ($event['id'] === $id) {
        // Check permission
        if ($user_role !== 'admin' && (!isset($event['creator']) || $event['creator'] !== $user_email)) {
            $_SESSION['error'] = 'Anda tidak memiliki izin untuk mengedit event ini.';
            header("Location: ../pages/dashboard.php");
            exit();
        }
        $event['judul'] = $judul;
        $event['deskripsi'] = $deskripsi;
        $event['kategori'] = $kategori;
        $event['tanggal'] = $tanggal;
        $event['waktu_mulai'] = $waktu_mulai;
        $event['waktu_selesai'] = $waktu_selesai;
        $event['waktu'] = $waktu;
        $event['lokasi'] = $lokasi;
        $event['gambar_url'] = $gambar_url;
        $event['contact'] = $contact;
        $event['speakers'] = $formatted_speakers;
        $event['schedule'] = $formatted_schedule;
        $event['requirements'] = array_values($filtered_requirements);
        $found = true;
        break;
    }
}
unset($event);

if (!$found) {
    $_SESSION['error'] = 'Event tidak ditemukan.';
    header("Location: ../pages/dashboard.php");
    exit();
}

// Save back to file
$file_content = '';
foreach ($events as $event) {
    $file_content .= json_encode($event, JSON_UNESCAPED_SLASHES) . "\n";
}

if (file_put_contents($events_file, $file_content) === false) {
    $_SESSION['error'] = 'Gagal menyimpan perubahan.';
    header("Location: ../pages/event_edit.php?id=" . urlencode($id));
    exit();
}

$_SESSION['success'] = 'Event berhasil diperbarui.';
header("Location: ../pages/dashboard.php");
exit();
?>
