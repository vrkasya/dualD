<?php
session_start();
include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-container">
                <h2 class="text-center mb-4 fw-bold">Masuk ke Akun</h2>
                
                <?php if (isset($_SESSION['login_error'])): ?>
                    <div class="alert alert-danger mb-4">
                        <?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($_GET['registered']) && $_GET['registered'] == 1): ?>
                    <div class="alert alert-success mb-4">
                        Pendaftaran berhasil! Silakan masuk dengan akun Anda.
                    </div>
                <?php endif; ?>
                
                <form action="../actions/login_process.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control form-control-lg" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control form-control-lg" required>
                    </div>
                    <button type="submit" class="btn btn-primary-custom w-100 py-2 mb-3">
                        Masuk
                    </button>
                    <div class="text-center mb-3">
                        <a href="forgot_password.php" class="text-decoration-none">Lupa Password?</a>
                    </div>
                    <div class="text-center text-muted">
                        Belum punya akun? <a href="register.php" class="text-decoration-none text-primary-custom">Daftar disini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
