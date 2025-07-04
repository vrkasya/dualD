<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: ../login.php');
    exit();
}

$user_role = $_SESSION['user_role'] ?? '';
$user_email = $_SESSION['user_email'] ?? '';

// Load events from file
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
}

// Load participants from list_peserta.txt
$participants_file = '../database/list_peserta.txt';
$participants = [];
if (file_exists($participants_file)) {
    $content = file_get_contents($participants_file);
    $participants = json_decode($content, true) ?: [];
}

// Get category filter from GET or POST
$category = $_GET['category'] ?? $_POST['category'] ?? '';

// Pagination parameters
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$per_page = 5; // items per page

// Filter events by category if set
if ($category !== '') {
    $events = array_filter($events, function($event) use ($category) {
        return isset($event['kategori']) && $event['kategori'] === $category;
    });
}

// Total events after filtering
$total_events = count($events);

// Calculate total pages
$total_pages = ceil($total_events / $per_page);

// Slice events for current page
$offset = ($page - 1) * $per_page;
$events_page = array_slice($events, $offset, $per_page);

// Prepare response data
$response = [
    'events' => $events_page,
    'total_events' => $total_events,
    'total_pages' => $total_pages,
    'current_page' => $page,
    'category' => $category,
];

// Output JSON response
header('Content-Type: application/json');
echo json_encode($response);
exit();
?>
