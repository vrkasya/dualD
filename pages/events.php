<?php
// pages/events.php

// Untuk implementasi nyata, data event akan diambil dari database
// Berikut contoh data dummy untuk keperluan tampilan
$events = [
    [
        'id' => 1,
        'title' => 'Seminar Kewirausahaan',
        'category' => 'seminar',
        'date' => '15 Oktober 2023',
        'time' => '09:00 - 12:00',
        'location' => 'Aula Kampus Utama',
        'description' => 'Pelajari strategi membangun bisnis dari nol bersama para praktisi sukses.',
        'image' => 'https://images.unsplash.com/photo-1431540015161-0bf868a8d214?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
        'participants' => 42
    ],
    [
        'id' => 2,
        'title' => 'Workshop Web Development',
        'category' => 'workshop',
        'date' => '20 Oktober 2023',
        'time' => '13:00 - 16:00',
        'location' => 'Lab Komputer Gedung B',
        'description' => 'Pelajari dasar-dasar pengembangan web modern dengan HTML, CSS, dan JavaScript.',
        'image' => 'https://images.unsplash.com/photo-1499750317857-1f4135064a6a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
        'participants' => 28
    ],
    [
        'id' => 3,
        'title' => 'Hackathon Kampus 2023',
        'category' => 'kompetisi',
        'date' => '5 November 2023',
        'time' => '08:00 - 20:00',
        'location' => 'Gedung Inovasi',
        'description' => 'Kompetisi pengembangan aplikasi selama 12 jam dengan hadiah total Rp 10 juta.',
        'image' => 'https://images.unsplash.com/photo-1542626991-cbc4e32524cc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80',
        'participants' => 65
    ],
    [
        'id' => 4,
        'title' => 'Lomba Debat Bahasa Inggris',
        'category' => 'kompetisi',
        'date' => '12 November 2023',
        'time' => '10:00 - 16:00',
        'location' => 'Ruang Seminar Gedung C',
        'description' => 'Kompetisi debat bahasa Inggris antar fakultas dengan tema teknologi dan lingkungan.',
        'image' => 'https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
        'participants' => 24
    ],
    [
        'id' => 5,
        'title' => 'Seminar Kesehatan Mental',
        'category' => 'seminar',
        'date' => '18 November 2023',
        'time' => '13:00 - 15:00',
        'location' => 'Audiovisual Center',
        'description' => 'Pentingnya kesehatan mental bagi mahasiswa dan cara mengelolanya dengan baik.',
        'image' => 'https://images.unsplash.com/photo-1527613426441-4da17471b66d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1472&q=80',
        'participants' => 38
    ],
    [
        'id' => 6,
        'title' => 'Workshop Desain Grafis',
        'category' => 'workshop',
        'date' => '25 November 2023',
        'time' => '09:00 - 12:00',
        'location' => 'Lab Multimedia Gedung D',
        'description' => 'Belajar dasar-dasar desain grafis menggunakan Adobe Photoshop dan Illustrator.',
        'image' => 'https://images.unsplash.com/photo-1545239351-ef35f43d514b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1074&q=80',
        'participants' => 31
    ],
    [
        'id' => 7,
        'title' => 'Festival Musik Kampus',
        'category' => 'hiburan',
        'date' => '2 Desember 2023',
        'time' => '16:00 - 22:00',
        'location' => 'Lapangan Basket Utama',
        'description' => 'Hiburan musik dengan penampilan band kampus dan musisi lokal.',
        'image' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
        'participants' => 120
    ],
    [
        'id' => 8,
        'title' => 'Pelatihan Public Speaking',
        'category' => 'pelatihan',
        'date' => '9 Desember 2023',
        'time' => '09:00 - 12:00',
        'location' => 'Ruang Serbaguna Gedung A',
        'description' => 'Tingkatkan kemampuan berbicara di depan umum dengan teknik-teknik terbaru.',
        'image' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1074&q=80',
        'participants' => 27
    ]
];

// Untuk implementasi nyata, gunakan kode berikut untuk mengambil data dari database:
// include '../config/db.php';
// $events = get_all_events();

session_start();
include '../includes/header.php';
include '../includes/navbar.php';
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