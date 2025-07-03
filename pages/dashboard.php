<?php
session_start();
include '../includes/header.php';
include '../includes/navbar.php';

if (!isset($_SESSION['logged_in'])) {
    header('Location: ../login.php');
    exit();
}

$user_role = $_SESSION['user_role'];
$user_email = $_SESSION['user_email'] ?? '';

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

// For peserta, get registered events from registrations table
$registered_event_ids = [];
if ($user_role === 'peserta') {
    // Connect to database
    $mysqli = new mysqli('localhost', 'root', '', 'your_database_name'); // Adjust credentials and db name
    if ($mysqli->connect_errno) {
        die('Failed to connect to MySQL: ' . $mysqli->connect_error);
    }
    $stmt = $mysqli->prepare("SELECT event_id FROM registrations WHERE user_email = ?");
    $stmt->bind_param('s', $user_email);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $registered_event_ids[] = $row['event_id'];
    }
    $stmt->close();
    $mysqli->close();
}

?>

<div class="container py-5">
    <h1 class="mb-4">Dashboard</h1>

    <?php if ($user_role === 'admin'): ?>
        <h2>Semua Event</h2>
        <div class="row">
            <?php foreach ($events as $event): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?= htmlspecialchars($event['gambar_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($event['judul']) ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($event['judul']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($event['deskripsi']) ?></p>
                            <a href="event_detail.php?id=<?= htmlspecialchars($event['id']) ?>" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php elseif ($user_role === 'pengurus'): ?>
        <h2>Event yang Anda Buat</h2>
        <div class="row">
            <?php
            $found = false;
            foreach ($events as $event):
                if (isset($event['creator']) && $event['creator'] === $user_email):
                    $found = true;
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?= htmlspecialchars($event['gambar_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($event['judul']) ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($event['judul']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($event['deskripsi']) ?></p>
                            <a href="event_detail.php?id=<?= htmlspecialchars($event['id']) ?>" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php
                endif;
            endforeach;
            if (!$found):
            ?>
                <p>Anda belum membuat event apapun.</p>
            <?php endif; ?>
        </div>

    <?php elseif ($user_role === 'peserta'): ?>
        <h2>Event yang Anda Daftar</h2>
        <div class="row">
            <?php
            $found = false;
            foreach ($events as $event):
                if (in_array($event['id'], $registered_event_ids)):
                    $found = true;
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?= htmlspecialchars($event['gambar_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($event['judul']) ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($event['judul']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($event['deskripsi']) ?></p>
                            <a href="event_detail.php?id=<?= htmlspecialchars($event['id']) ?>" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php
                endif;
            endforeach;
            if (!$found):
            ?>
                <p>Anda belum mendaftar event apapun.</p>
            <?php endif; ?>
        </div>

    <?php else: ?>
        <p>Role tidak dikenali.</p>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
