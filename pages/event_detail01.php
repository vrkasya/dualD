<?php
// pages/event_detail.php

// Untuk implementasi nyata, data event akan diambil dari database berdasarkan ID
// Berikut contoh data dummy untuk keperluan tampilan
$event_id = isset($_GET['id']) ? $_GET['id'] : 1;

$events = [
    1 => [
        'id' => 1,
        'title' => 'Seminar Kewirausahaan',
        'category' => 'seminar',
        'date' => '15 Oktober 2023',
        'time' => '09:00 - 12:00',
        'location' => 'Aula Kampus Utama',
        'description' => 'Pelajari strategi membangun bisnis dari nol bersama para praktisi sukses. Seminar ini akan membahas berbagai aspek kewirausahaan mulai dari ide bisnis, perencanaan, hingga eksekusi.',
        'image' => 'https://images.unsplash.com/photo-1431540015161-0bf868a8d214?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
        'participants' => 42,
        'organizer' => 'Himpunan Mahasiswa Ekonomi',
        'contact' => '081234567890 (Budi)',
        'speakers' => [
            ['name' => 'Dr. Andi Wijaya', 'title' => 'CEO PT Sukses Makmur'],
            ['name' => 'Diana Putri', 'title' => 'Founder Startup Fintech'],
            ['name' => 'Rudi Hartono', 'title' => 'Business Consultant']
        ],
        'schedule' => [
            ['time' => '09:00 - 09:30', 'activity' => 'Registrasi & Sarapan'],
            ['time' => '09:30 - 10:30', 'activity' => 'Keynote Speaker: Dr. Andi Wijaya'],
            ['time' => '10:30 - 11:30', 'activity' => 'Panel Diskusi: Strategi Memulai Bisnis'],
            ['time' => '11:30 - 12:00', 'activity' => 'Sesi Tanya Jawab & Penutupan']
        ],
        'requirements' => [
            'Membawa kartu identitas (KTM/KTP)',
            'Membawa alat tulis sendiri',
            'Berpakaian rapi (bebas rapih)'
        ]
    ],
    2 => [
        'id' => 2,
        'title' => 'Workshop Web Development',
        'category' => 'workshop',
        'date' => '20 Oktober 2023',
        'time' => '13:00 - 16:00',
        'location' => 'Lab Komputer Gedung B',
        'description' => 'Pelajari dasar-dasar pengembangan web modern dengan HTML, CSS, dan JavaScript. Workshop ini cocok untuk pemula yang ingin memulai karir di bidang teknologi.',
        'image' => 'https://images.unsplash.com/photo-1499750317857-1f4135064a6a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
        'participants' => 28,
        'organizer' => 'Komunitas Programmer Kampus',
        'contact' => '081298765432 (Rina)',
        'speakers' => [
            ['name' => 'Ahmad Fauzi', 'title' => 'Senior Web Developer']
        ],
        'schedule' => [
            ['time' => '13:00 - 13:30', 'activity' => 'Registrasi & Persiapan'],
            ['time' => '13:30 - 14:30', 'activity' => 'Pengenalan HTML & CSS'],
            ['time' => '14:30 - 15:30', 'activity' => 'Praktik Membuat Website Sederhana'],
            ['time' => '15:30 - 16:00', 'activity' => 'Pengenalan JavaScript Dasar']
        ],
        'requirements' => [
            'Membawa laptop sendiri',
            'Sudah terinstall text editor (VS Code/Sublime)',
            'Minimal pengetahuan dasar komputer'
        ]
    ]
];

// Ambil event berdasarkan ID
$event = isset($events[$event_id]) ? $events[$event_id] : $events[1];

// Untuk implementasi nyata, gunakan kode berikut:
// include '../config/db.php';
// $event = get_event_by_id($event_id);

session_start();
include '../includes/header.php';
include '../includes/navbar.php';
?>

<section class="py-5 bg-light">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php">Beranda</a></li>
                <li class="breadcrumb-item"><a href="events.php">Event</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $event['title'] ?></li>
            </ol>
        </nav>
        
        <div class="row">
            <!-- Konten Utama -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="position-relative">
                        <img src="<?= $event['image'] ?>" class="card-img-top" alt="<?= $event['title'] ?>" style="height: 400px; object-fit: cover;">
                        <span class="badge bg-primary position-absolute top-0 end-0 m-3 fs-6 py-2 px-3">
                            <?= ucfirst($event['category']) ?>
                        </span>
                    </div>
                    
                    <div class="card-body p-4">
                        <h1 class="card-title fw-bold mb-3"><?= $event['title'] ?></h1>
                        
                        <div class="d-flex flex-wrap gap-4 mb-4">
                            <div class="d-flex align-items-center">
                                <i class="far fa-calendar-alt fs-5 text-primary me-2"></i>
                                <div>
                                    <small class="text-muted">Tanggal</small>
                                    <div class="fw-medium"><?= $event['date'] ?></div>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <i class="far fa-clock fs-5 text-primary me-2"></i>
                                <div>
                                    <small class="text-muted">Waktu</small>
                                    <div class="fw-medium"><?= $event['time'] ?></div>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <i class="fas fa-map-marker-alt fs-5 text-primary me-2"></i>
                                <div>
                                    <small class="text-muted">Lokasi</small>
                                    <div class="fw-medium"><?= $event['location'] ?></div>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <i class="fas fa-users fs-5 text-primary me-2"></i>
                                <div>
                                    <small class="text-muted">Peserta</small>
                                    <div class="fw-medium"><?= $event['participants'] ?> Terdaftar</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-5">
                            <h4 class="fw-bold mb-3">Deskripsi Event</h4>
                            <p class="card-text"><?= $event['description'] ?></p>
                        </div>
                        
                        <!-- Pembicara -->
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
                                            <h5 class="mb-0"><?= $speaker['name'] ?></h5>
                                            <p class="text-muted mb-0"><?= $speaker['title'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <!-- Jadwal Acara -->
                        <div class="mb-5">
                            <h4 class="fw-bold mb-3">Jadwal Acara</h4>
                            <div class="timeline">
                                <?php foreach ($event['schedule'] as $item): ?>
                                <div class="timeline-item mb-4">
                                    <div class="timeline-content bg-light p-4 rounded">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="mb-2"><?= $item['activity'] ?></h5>
                                            <span class="badge bg-primary"><?= $item['time'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <!-- Persyaratan -->
                        <div>
                            <h4 class="fw-bold mb-3">Persyaratan</h4>
                            <ul class="list-group">
                                <?php foreach ($event['requirements'] as $requirement): ?>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-3"></i>
                                    <?= $requirement ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar Pendaftaran -->
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
                            <h4 class="fw-bold"><?= $event['date'] ?></h4>
                            <p class="text-muted mb-0"><?= $event['time'] ?></p>
                            <p class="text-muted"><?= $event['location'] ?></p>
                        </div>
                        
                        <div class="d-grid mb-3">
                            <?php if (isset($_SESSION['logged_in'])): ?>
                                <a href="event_register.php?event_id=<?= $event['id'] ?>" class="btn btn-primary-custom btn-lg py-3">
                                    <i class="fas fa-user-plus me-2"></i> Daftar Event
                                </a>
                            <?php else: ?>
                                <button class="btn btn-primary-custom btn-lg py-3" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    <i class="fas fa-user-plus me-2"></i> Daftar Event
                                </button>
                            <?php endif; ?>
                        </div>
                        
                        <div class="text-center mt-4">
                            <p class="text-muted mb-2">Penyelenggara</p>
                            <p class="fw-bold mb-0"><?= $event['organizer'] ?></p>
                            <p class="text-muted mb-0"><?= $event['contact'] ?></p>
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
        
        <!-- Event Terkait -->
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
