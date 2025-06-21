<?php
session_start();
if (!isset($_SESSION['registration_success'])) {
    header('Location: ../index.php');
    exit();
}

$event_name = $_SESSION['registered_event'];
unset($_SESSION['registration_success']);
unset($_SESSION['registered_event']);

include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-container text-center">
                <div class="text-success mb-4" style="font-size: 5rem;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h2 class="fw-bold mb-3">Pendaftaran Berhasil!</h2>
                <p class="text-muted mb-4 fs-5">
                    Terima kasih telah mendaftar untuk event <span class="fw-semibold"><?php echo htmlspecialchars($event_name); ?></span>.
                    Kami akan mengirimkan detail lebih lanjut ke email Anda.
                </p>
                <a href="../index.php" class="btn btn-primary-custom px-5 py-3">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>