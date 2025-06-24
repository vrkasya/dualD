<?php
session_start();
include '../includes/header.php';
include '../includes/navbar.php';

// Get event id from query parameter
$event_id = $_GET['id'] ?? null;

$event = null;
$file = '../database/events.txt';

if ($event_id && file_exists($file)) {
    $data = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($data as $line) {
        $e = json_decode($line, true);
        if ($e && $e['id'] === $event_id) {
            $event = $e;
            break;
        }
    }
}

if (!$event) {
    echo "<div class='container py-5'><h2>Event tidak ditemukan</h2></div>";
    include '../includes/footer.php';
    exit();
}
?>

<section class="py-5">
    <div class="container">
        <h1 class="mb-4"><?= htmlspecialchars($event['judul']) ?></h1>
        <div class="mb-3">
            <span class="badge rounded-pill 
                <?= $event['kategori'] == 'seminar' ? 'bg-primary' : '' ?>
                <?= $event['kategori'] == 'workshop' ? 'bg-success' : '' ?>
                <?= $event['kategori'] == 'kompetisi' ? 'bg-warning text-dark' : '' ?>
                <?= $event['kategori'] == 'hiburan' ? 'bg-danger' : '' ?>
                <?= $event['kategori'] == 'pelatihan' ? 'bg-info' : '' ?>">
                <?= ucfirst(htmlspecialchars($event['kategori'])) ?>
            </span>
        </div>
        <img src="<?= htmlspecialchars($event['gambar_url']) ?>" alt="<?= htmlspecialchars($event['judul']) ?>" class="img-fluid mb-4" style="max-height: 400px; object-fit: cover;">
        <div class="mb-3">
            <i class="far fa-calendar-alt me-2"></i> <?= htmlspecialchars($event['tanggal']) ?>, <?= htmlspecialchars($event['waktu']) ?>
        </div>
        <div class="mb-3">
            <i class="fas fa-map-marker-alt me-2"></i> <?= htmlspecialchars($event['lokasi']) ?>
        </div>
        <p><?= nl2br(htmlspecialchars($event['deskripsi'])) ?></p>
        <a href="#" class="btn btn-primary-custom mt-3">Daftar Sekarang</a>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
