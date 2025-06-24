<?php
// pages/events.php
session_start();
include '../includes/header.php';
include '../includes/navbar.php';

// Read events from file
$file = '../database/events.txt';
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
    // File not found, fallback to empty array or show message
    $events = [];
}
?>

<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-5 fw-bold">Daftar Semua Event</h1>
            
            <!-- Filter dan Search -->
            <div class="d-flex gap-2">
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-filter me-2"></i> Kategori
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Semua</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Seminar</a></li>
                        <li><a class="dropdown-item" href="#">Workshop</a></li>
                        <li><a class="dropdown-item" href="#">Kompetisi</a></li>
                        <li><a class="dropdown-item" href="#">Hiburan</a></li>
                        <li><a class="dropdown-item" href="#">Pelatihan</a></li>
                    </ul>
                </div>
                
                <div class="input-group" style="width: 300px;">
                    <input type="text" class="form-control" placeholder="Cari event...">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="row g-4">
            <?php foreach ($events as $event): ?>
            <div class="col-lg-6">
                <div class="event-card card border-0 shadow-sm h-100">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <img src="<?= $event['image'] ?>" class="img-fluid rounded-start h-100" alt="<?= $event['title'] ?>" style="object-fit: cover;">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body d-flex flex-column h-100">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge rounded-pill 
                                        <?= $event['category'] == 'seminar' ? 'bg-primary' : '' ?>
                                        <?= $event['category'] == 'workshop' ? 'bg-success' : '' ?>
                                        <?= $event['category'] == 'kompetisi' ? 'bg-warning text-dark' : '' ?>
                                        <?= $event['category'] == 'hiburan' ? 'bg-danger' : '' ?>
                                        <?= $event['category'] == 'pelatihan' ? 'bg-info' : '' ?>">
                                        <?= ucfirst($event['category']) ?>
                                    </span>
                                    <span class="text-muted">
                                        <i class="fas fa-users me-1"></i> <?= $event['participants'] ?> peserta
                                    </span>
                                </div>
                                
                                <h3 class="card-title fw-bold mb-3"><?= $event['title'] ?></h3>
                                
                                <div class="d-flex align-items-center text-muted mb-2">
                                    <i class="far fa-calendar-alt me-2"></i>
                                    <span><?= $event['date'] ?></span>
                                </div>
                                <div class="d-flex align-items-center text-muted mb-2">
                                    <i class="far fa-clock me-2"></i>
                                    <span><?= $event['time'] ?></span>
                                </div>
                                <div class="d-flex align-items-center text-muted mb-3">
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    <span><?= $event['location'] ?></span>
                                </div>
                                
                                <p class="card-text text-muted mb-4 flex-grow-1"><?= $event['description'] ?></p>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="#" class="btn btn-primary-custom">
                                        <i class="fas fa-info-circle me-2"></i> Detail
                                    </a>
                                    <a href="#" class="btn btn-outline-primary">
                                        <i class="fas fa-user-plus me-2"></i> Daftar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Pagination -->
        <nav class="mt-5">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
