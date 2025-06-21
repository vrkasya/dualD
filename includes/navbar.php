<?php require_once __DIR__ . '/../config/path.php'; ?>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?php echo url('/'); ?>">
            <i class="fas fa-calendar-alt me-2"></i>
            <span class="fw-bold">EventKampus</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo url('/'); ?>">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo url('/#events'); ?>">Event</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo url('/#about'); ?>">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo url('/#contact'); ?>">Kontak</a>
                </li>
            </ul>
            <div class="d-flex">
                <a href="<?php echo url('pages/login.php'); ?>" class="btn btn-light text-primary-custom fw-medium me-2">Masuk</a>
                <a href="<?php echo url('pages/register.php'); ?>" class="btn btn-primary-custom fw-medium">Daftar</a>
            </div>
        </div>
    </div>
</nav>