<?php
session_start();
include '../includes/header.php';
include '../includes/navbar.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../pages/login.php');
    exit();
}

$user_name = $_SESSION['user_nama'] ?? 'User';
$user_email = $_SESSION['user_email'] ?? '';
$user_role = $_SESSION['user_role'] ?? 'peserta';
?>

<section class="py-5">
    <div class="container">
        <h1 class="mb-4">Profil Saya</h1>
        <div class="card p-4">
            <h3>Halo, <?= htmlspecialchars($user_name) ?>!</h3>
            <p><strong>Email:</strong> <?= htmlspecialchars($user_email) ?></p>
            <p><strong>Role:</strong> <?= ucfirst(htmlspecialchars($user_role)) ?></p>

            <?php if ($user_role === 'admin'): ?>
                <h4>Admin Dashboard</h4>
                <p>Anda memiliki akses penuh ke sistem. Anda dapat mengelola pengguna, event, dan pengaturan lainnya.</p>
                <a href="<?= url('/admin/index.php') ?>" class="btn btn-primary">Masuk ke Admin Dashboard</a>
            <?php elseif ($user_role === 'pengurus'): ?>
                <h4>Pengurus Dashboard</h4>
                <p>Anda dapat mengelola event dan peserta.</p>
                <a href="<?= url('/pages/dashboard.php') ?>" class="btn btn-primary">Masuk ke Dashboard</a>
            <?php else: ?>
                <h4>Peserta</h4>
                <p>Anda dapat melihat event dan mendaftar sebagai peserta.</p>
                <a href="<?= url('/pages/events.php') ?>" class="btn btn-primary">Lihat Event</a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
