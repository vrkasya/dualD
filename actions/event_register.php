<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: ../login.php");
    exit;
}

$user_role = $_SESSION['user_role'] ?? '';
$user_email = $_SESSION['user_email'] ?? '';

if ($user_role !== 'peserta') {
    echo "Hanya peserta yang bisa mendaftar.";
    exit;
}

$event_id = $_POST['event_id'] ?? '';

if (!$event_id) {
    die('Event ID tidak valid.');
}

$events_file = '../database/events.txt';
$registrations_file = '../database/registrations.txt';

// Cek apakah event ada di events.txt
$event_found = false;
if (file_exists($events_file)) {
    $lines = file($events_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $e = json_decode($line, true);
        if ($e && $e['id'] === $event_id) {
            $event_found = true;
            break;
        }
    }
}

if (!$event_found) {
    die('Event tidak ditemukan.');
}

// Cek apakah user sudah terdaftar di registrations.txt
$already_registered = false;
if (file_exists($registrations_file)) {
    $regs = file($registrations_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($regs as $reg_line) {
        $reg = json_decode($reg_line, true);
        if ($reg && $reg['event_id'] === $event_id && $reg['user_email'] === $user_email) {
            $already_registered = true;
            break;
        }
    }
}

if ($already_registered) {
    echo "Kamu sudah terdaftar untuk event ini.";
} else {
    $new_registration = [
        'event_id' => $event_id,
        'user_email' => $user_email,
        'registered_at' => date("Y-m-d H:i:s")
    ];
    file_put_contents($registrations_file, json_encode($new_registration) . PHP_EOL, FILE_APPEND);

    echo "Berhasil mendaftar!";
}

echo "<br><a href='../pages/event_detail.php?id=" . htmlspecialchars($event_id) . "'>Kembali ke Detail Event</a>";
?>
