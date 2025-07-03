<?php
session_start();
include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-container">
                <h2 class="text-center mb-4 fw-bold">Lupa Password</h2>

                <?php if (isset($_SESSION['forgot_password_error'])): ?>
                    <div class="alert alert-danger mb-4">
                        <?= $_SESSION['forgot_password_error']; unset($_SESSION['forgot_password_error']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['forgot_password_success'])): ?>
                    <div class="alert alert-success mb-4">
                        <?= $_SESSION['forgot_password_success']; unset($_SESSION['forgot_password_success']); ?>
                    </div>
                <?php endif; ?>

                <form action="../actions/forgot_password_process.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Masukkan Email Anda</label>
                        <input type="email" id="email" name="email" class="form-control form-control-lg" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" id="password" name="password" class="form-control form-control-lg" required>
                    </div>
                    <div class="mb-4">
                        <label for="konfirmasi_password" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" id="konfirmasi_password" name="konfirmasi_password" class="form-control form-control-lg" required>
                    </div>
                    <button type="submit" class="btn btn-primary-custom w-100 py-2">Ubah Password</button>
                </form>
                <div class="mt-4 text-center">
                    <a href="login.php" class="text-decoration-none">Kembali ke Halaman Masuk</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
