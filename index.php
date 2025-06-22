<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>



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
            <!-- Event Card 1 -->
            <div class="col-md-4">
                <div class="event-card card border-0 animate-fadeIn delay-100" onclick="window.location.href='<?php echo url('/pages/event_detail.php?id=1'); ?>'">
                    <span class="event-category category-seminar">Seminar</span>
                    <img src="https://images.unsplash.com/photo-1431540015161-0bf868a8d214?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Seminar Kewirausahaan" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h3 class="card-title fw-bold mb-3">Seminar Kewirausahaan</h3>
                        <div class="d-flex align-items-center text-muted mb-2">
                            <i class="far fa-calendar-alt me-2"></i>
                            <span>15 Oktober 2023, 09:00 - 12:00</span>
                        </div>
                        <div class="d-flex align-items-center text-muted mb-3">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <span>Aula Kampus Utama</span>
                        </div>
                        <p class="card-text text-muted mb-4">
                            Pelajari strategi membangun bisnis dari nol bersama para praktisi sukses.
                        </p>
                        <a href="#" class="btn btn-primary-custom w-100">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
            
            <!-- Event Card 2 -->
            <div class="col-md-4">
                <div class="event-card card border-0 animate-fadeIn delay-200">
                    <span class="event-category category-workshop">Workshop</span>
                    <img src="https://images.unsplash.com/photo-1499750317857-1f4135064a6a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Workshop Coding" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h3 class="card-title fw-bold mb-3">Workshop Web Development</h3>
                        <div class="d-flex align-items-center text-muted mb-2">
                            <i class="far fa-calendar-alt me-2"></i>
                            <span>20 Oktober 2023, 13:00 - 16:00</span>
                        </div>
                        <div class="d-flex align-items-center text-muted mb-3">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <span>Lab Komputer Gedung B</span>
                        </div>
                        <p class="card-text text-muted mb-4">
                            Pelajari dasar-dasar pengembangan web modern dengan HTML, CSS, dan JavaScript.
                        </p>
                        <a href="#" class="btn btn-primary-custom w-100">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
            
            <!-- Event Card 3 -->
            <div class="col-md-4">
                <div class="event-card card border-0 animate-fadeIn delay-300">
                    <span class="event-category category-kompetisi">Kompetisi</span>
                    <img src="https://images.unsplash.com/photo-1542626991-cbc4e32524cc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80" 
                         alt="Hackathon" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h3 class="card-title fw-bold mb-3">Hackathon Kampus 2023</h3>
                        <div class="d-flex align-items-center text-muted mb-2">
                            <i class="far fa-calendar-alt me-2"></i>
                            <span>5 November 2023, 08:00 - 20:00</span>
                        </div>
                        <div class="d-flex align-items-center text-muted mb-3">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <span>Gedung Inovasi</span>
                        </div>
                        <p class="card-text text-muted mb-4">
                            Kompetisi pengembangan aplikasi selama 12 jam dengan hadiah total Rp 10 juta.
                        </p>
                        <a href="#" class="btn btn-primary-custom w-100">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
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