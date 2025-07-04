<?php
session_start();
include '../includes/header.php';
include '../includes/navbar.php';

$event_id = isset($_GET['id']) ? $_GET['id'] : '';

$events_file = '../database/events.txt';
$users_file = '../database/users.txt';

$event = null;
$organizer = null;
$participants_count = 0;

// Load event data from events.txt
if (file_exists($events_file)) {
    $lines = file($events_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $e = json_decode($line, true);
        if ($e && $e['id'] === $event_id) {
            $event = $e;
            break;
        }
    }
}

// Load organizer data from users.txt
if ($event && file_exists($users_file)) {
    $lines = file($users_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $u = json_decode($line, true);
        if ($u && isset($u['email']) && $u['email'] === $event['creator']) {
            $organizer = $u;
            break;
        }
    }
}

// Use participants count from event data
$participants_count = 0;
$registrations_file = '../database/registrations.txt';
if (file_exists($registrations_file)) {
    $regs = file($registrations_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($regs as $reg_line) {
        $reg = json_decode($reg_line, true);
        if ($reg && $reg['event_id'] === $event['id']) {
            $participants_count++;
        }
    }
}

if (!$event) {
    echo "<div class='container py-5'><div class='alert alert-danger'>Event tidak ditemukan.</div></div>";
    include '../includes/footer.php';
    exit();
}
?>

<section class="py-5 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php">Beranda</a></li>
                <li class="breadcrumb-item"><a href="events.php">Event</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($event['judul']) ?></li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="position-relative">
                        <img src="<?= htmlspecialchars($event['gambar_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($event['judul']) ?>" style="height: 400px; object-fit: cover;">
                        <span class="badge bg-primary position-absolute top-0 end-0 m-3 fs-6 py-2 px-3">
                            <?= ucfirst(htmlspecialchars($event['kategori'])) ?>
                        </span>
                    </div>

                    <div class="card-body p-4">
                        <h1 class="card-title fw-bold mb-3"><?= htmlspecialchars($event['judul']) ?></h1>

                        <div class="d-flex flex-wrap gap-4 mb-4">
                            <div class="d-flex align-items-center">
                                <i class="far fa-calendar-alt fs-5 text-primary me-2"></i>
                                <div>
                                    <small class="text-muted">Tanggal</small>
                                    <div class="fw-medium"><?= htmlspecialchars($event['tanggal']) ?></div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <i class="far fa-clock fs-5 text-primary me-2"></i>
                                <div>
                                    <small class="text-muted">Waktu</small>
                                    <div class="fw-medium"><?= htmlspecialchars($event['waktu']) ?></div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <i class="fas fa-map-marker-alt fs-5 text-primary me-2"></i>
                                <div>
                                    <small class="text-muted">Lokasi</small>
                                    <div class="fw-medium"><?= htmlspecialchars($event['lokasi']) ?></div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <i class="fas fa-users fs-5 text-primary me-2"></i>
                                <div>
                                    <small class="text-muted">Peserta</small>
                                    <div class="fw-medium"><?= htmlspecialchars($participants_count) ?> Terdaftar</div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-5">
                            <h4 class="fw-bold mb-3">Deskripsi Event</h4>
                            <p class="card-text"><?= nl2br(htmlspecialchars($event['deskripsi'])) ?></p>
                        </div>

                        <div class="mb-5">
                            <h4 class="fw-bold mb-3">Pembicara</h4>
                            <div class="row">
                                <?php foreach ($event['speakers'] as $speaker): ?>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center p-3 bg-light rounded">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                            <i class="fas fa-user fs-4"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h5 class="mb-0"><?= htmlspecialchars($speaker['name']) ?></h5>
                                            <p class="text-muted mb-0"><?= htmlspecialchars($speaker['title']) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="mb-5">
                            <h4 class="fw-bold mb-3">Jadwal Acara</h4>
                            <div class="timeline">
                                <?php foreach ($event['schedule'] as $item): ?>
                                <div class="timeline-item mb-4">
                                    <div class="timeline-content bg-light p-4 rounded">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="mb-2"><?= htmlspecialchars($item['activity']) ?></h5>
                                            <span class="badge bg-primary"><?= htmlspecialchars($item['start_time'] ?? '') ?> - <?= htmlspecialchars($item['end_time'] ?? '') ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div>
                            <h4 class="fw-bold mb-3">Persyaratan</h4>
                            <ul class="list-group">
                                <?php foreach ($event['requirements'] as $requirement): ?>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-3"></i>
                                    <?= htmlspecialchars($requirement) ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold">Daftar Sekarang</h3>
                            <p class="text-muted">Segera daftarkan diri Anda untuk mengikuti event ini</p>
                        </div>

                        <div class="mb-4 text-center">
                            <div class="d-flex justify-content-center mb-3">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="fas fa-calendar-alt fs-4"></i>
                                </div>
                            </div>
                            <h4 class="fw-bold"><?= htmlspecialchars($event['tanggal']) ?></h4>
                            <p class="text-muted mb-0"><?= htmlspecialchars($event['waktu']) ?></p>
                            <p class="text-muted"><?= htmlspecialchars($event['lokasi']) ?></p>
                        </div>

                        <div class="d-grid mb-3 text-center">
                            <?php
                            $isRegistered = false;
                            if (isset($_SESSION['logged_in'])) {
                                $registrations_file = '../database/registrations.txt';
                                $user_email = $_SESSION['user_email'] ?? '';
                                if (file_exists($registrations_file)) {
                                    $regs = file($registrations_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                                    foreach ($regs as $reg_line) {
                                        $reg = json_decode($reg_line, true);
                                        if ($reg && $reg['event_id'] === $event['id'] && $reg['user_email'] === $user_email) {
                                            $isRegistered = true;
                                            break;
                                        }
                                    }
                                }
                            }
                            ?>

                            <?php if (isset($_SESSION['logged_in'])): ?>
                                <?php if ($isRegistered): ?>
                                    <button class="btn btn-success btn-lg py-3" disabled>
                                        <i class="fas fa-check me-2"></i> Terdaftar
                                    </button>
                                <?php else: ?>
                                    <form action="../actions/event_register.php" method="POST">
                                        <input type="hidden" name="event_id" value="<?= htmlspecialchars($event['id']) ?>">
                                        <button type="submit" class="btn btn-primary-custom btn-lg py-3">
                                            <i class="fas fa-user-plus me-2"></i> Daftar Event
                                        </button>
                                    </form>
                                <?php endif; ?>
                            <?php else: ?>
                                <button class="btn btn-primary-custom btn-lg py-3" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    <i class="fas fa-user-plus me-2"></i> Daftar Event
                                </button>
                            <?php endif; ?>
                        </div>

                        <div class="text-center mt-4">
                            <p class="text-muted mb-2">Penyelenggara</p>
                            <p class="fw-bold mb-0"><?= htmlspecialchars($organizer['nama'] ?? '') ?></p>
                            <p class="text-muted mb-0"><?= htmlspecialchars($event['contact'] ?? '') ?></p>
                        </div>

                        <div class="mt-4">
                            <div class="d-grid">
                                <a href="#" class="btn btn-outline-primary">
                                    <i class="fas fa-share-alt me-2"></i> Bagikan Event
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <h3 class="fw-bold mb-4">Event Terkait</h3>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" class="card-img-top" alt="Lomba Debat" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <span class="badge bg-warning text-dark mb-2">Kompetisi</span>
                            <h5 class="card-title fw-bold">Lomba Debat Bahasa Inggris</h5>
                            <div class="d-flex align-items-center text-muted mb-2">
                                <i class="far fa-calendar-alt me-2"></i>
                                <span>12 November 2023</span>
                            </div>
                            <a href="event_detail.php?id=4" class="btn btn-outline-primary w-100">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="https://images.unsplash.com/photo-1527613426441-4da17471b66d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1472&q=80" class="card-img-top" alt="Seminar Kesehatan Mental" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <span class="badge bg-primary mb-2">Seminar</span>
                            <h5 class="card-title fw-bold">Seminar Kesehatan Mental</h5>
                            <div class="d-flex align-items-center text-muted mb-2">
                                <i class="far fa-calendar-alt me-2"></i>
                                <span>18 November 2023</span>
                            </div>
                            <a href="event_detail.php?id=5" class="btn btn-outline-primary w-100">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="https://images.unsplash.com/photo-1545239351-ef35f43d514b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1074&q=80" class="card-img-top" alt="Workshop Desain Grafis" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <span class="badge bg-success mb-2">Workshop</span>
                            <h5 class="card-title fw-bold">Workshop Desain Grafis</h5>
                            <div class="d-flex align-items-center text-muted mb-2">
                                <i class="far fa-calendar-alt me-2"></i>
                                <span>25 November 2023</span>
                            </div>
                            <a href="event_detail.php?id=6" class="btn btn-outline-primary w-100">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
