<?php
session_start();
include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-container">
                <h2 class="text-center mb-4 fw-bold">Buat Akun Baru</h2>
                <p class="text-center text-muted mb-4">Silakan isi formulir di bawah ini untuk membuat akun baru dan bergabung dengan komunitas kami.</p>
                <?php if (isset($_SESSION['register_error'])): ?>
                    <div class="alert alert-danger mb-4">
                        <?php echo $_SESSION['register_error']; unset($_SESSION['register_error']); ?>
                    </div>
                <?php endif; ?>
                
                <form action="../actions/register_process.php" method="POST">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" class="form-control form-control-lg" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control form-control-lg" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control form-control-lg" required>
                    </div>
                    <div class="mb-4">
                        <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
                        <input type="password" id="konfirmasi_password" name="konfirmasi_password" class="form-control form-control-lg" required>
                    </div>
                    <button type="submit" class="btn btn-primary-custom w-100 py-2">
                        Daftar
                    </button>
                </form>
                <div class="mt-4 text-center text-muted">
                    Sudah punya akun? <a href="login.php" class="text-decoration-none text-primary-custom">Masuk disini</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
