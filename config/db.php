<?php
// config/db.php

// Fungsi untuk mendapatkan semua event
function get_all_events() {
    $file = __DIR__ . '/../database/events.txt';
    $events = [];
    
    if (file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $events[] = json_decode($line, true);
        }
    }
    
    return $events;
}

// Fungsi untuk mendapatkan event berdasarkan ID
function get_event_by_id($id) {
    $events = get_all_events();
    foreach ($events as $event) {
        if ($event['id'] === $id) {
            return $event;
        }
    }
    return null;
}

// Fungsi untuk mendapatkan event mendatang (limit 3)
function get_upcoming_events() {
    $events = get_all_events();
    $today = date('Y-m-d');
    
    // Filter event yang tanggalnya >= hari ini
    $upcoming = array_filter($events, function($event) use ($today) {
        return $event['tanggal'] >= $today;
    });
    
    // Urutkan berdasarkan tanggal terdekat
    usort($upcoming, function($a, $b) {
        return strtotime($a['tanggal']) - strtotime($b['tanggal']);
    });
    
    // Ambil 3 event terdekat
    return array_slice($upcoming, 0, 3);
}

// Fungsi untuk mendapatkan event terbaru (limit 3)
function get_latest_events() {
    $events = get_all_events();
    
    // Urutkan berdasarkan tanggal pembuatan terbaru
    usort($events, function($a, $b) {
        return strtotime($b['created_at']) - strtotime($a['created_at']);
    });
    
    // Ambil 3 event terbaru
    return array_slice($events, 0, 3);
}
?>