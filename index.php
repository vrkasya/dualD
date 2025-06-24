<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<?php
// Read events from file
$file = 'database/events.txt';
$events = [];

if (file_exists($file)) {
    $data = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($data as $line) {
        $event = json_decode($line, true);
        if ($event) {
            $events[] = $event;
        }
    }
} else {
    $events = [];
}
?>

<!-- Hero Section -->
<section class="hero text-white">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-4 animate-fadeIn">Selamat Datang di EventKampus</h1>
        <p class="fs-5 mb-5 max-w-2xl mx-auto animate-fadeIn delay-100">
            Temukan dan ikuti berbagai event kampus menarik seperti seminar, workshop, dan kompetisi
        </p>
        <a href="<?php echo url('/pages/events.php'); ?>" class="btn btn-primary-custom btn-lg px-5 py-3 fw-bold animate-fadeIn delay-200">
            Jelajahi Event <i class="fas fa-arrow-right ms-2"></i>
        </a>
    </div>
</section>

<!-- Events Section -->
<section id="events" class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center mb-5 display-5 fw-bold">Event Mendatang</h2>
        
        <div class="row g-4">
            <?php foreach ($events as $event): ?>
            <div class="col-md-4">
                <div class="event-card card border-0 animate-fadeIn delay-100" onclick="window.location.href='<?php echo url('/pages/event_detail.php?id=' . urlencode($event['id'])); ?>'">
                    <span class="event-category category-<?= htmlspecialchars($event['kategori']) ?>"><?= ucfirst(htmlspecialchars($event['kategori'])) ?></span>
                    <img src="<?= htmlspecialchars($event['gambar_url']) ?>" 
                        alt="<?= htmlspecialchars($event['judul']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h3 class="card-title fw-bold mb-3"><?= htmlspecialchars($event['judul']) ?></h3>
                        <div class="d-flex align-items-center text-muted mb-2">
                            <i class="far fa-calendar-alt me-2"></i>
                            <span><?= htmlspecialchars($event['tanggal']) ?>, <?= htmlspecialchars($event['waktu']) ?></span>
                        </div>
                        <div class="d-flex align-items-center text-muted mb-3">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <span><?= htmlspecialchars($event['lokasi']) ?></span>
                        </div>
                        <p class="card-text text-muted mb-4">
                            <?= htmlspecialchars($event['deskripsi']) ?>
                        </p>
                        <a href="#" class="btn btn-primary-custom w-100">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-5">
            <a href="<?php echo url('/pages/events.php'); ?>" class="btn btn-outline-secondary btn-lg px-4">
                Lihat Semua Event <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h2 class="display-5 fw-bold mb-4">Tentang EventKampus</h2>
                <p class="text-muted mb-4">
                    EventKampus adalah platform yang memudahkan organisasi kampus dalam mengelola berbagai kegiatan dan event akademik maupun non-akademik.
                </p>
                <p class="text-muted mb-5">
                    Dengan sistem ini, mahasiswa dapat dengan mudah menemukan event yang sesuai minat mereka dan mendaftar secara online, sementara panitia dapat mengelola peserta dengan lebih efisien.
                </p>
                <div class="d-flex justify-content-between">
                    <div class="text-center">
                        <div class="display-6 fw-bold text-primary-custom">50+</div>
                        <div class="text-muted">Event</div>
                    </div>
                    <div class="text-center">
                        <div class="display-6 fw-bold text-primary-custom">2000+</div>
                        <div class="text-muted">Peserta</div>
                    </div>
                    <div class="text-center">
                        <div class="display-6 fw-bold text-primary-custom">15+</div>
                        <div class="text-muted">Organisasi</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="rounded-lg overflow-hidden shadow-lg">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80" 
                         alt="Team" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>
</script>
</body>
</html>
<?php include 'includes/footer.php'; ?>
