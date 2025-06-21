<?php
session_start();
include '../includes/header.php';
include '../includes/navbar.php';


?>

<div class="container mx-auto px-4 py-16">
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Masuk ke Akun</h2>
        
        <?php if (isset($_SESSION['login_error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_GET['registered']) && $_GET['registered'] == 1): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                Pendaftaran berhasil! Silakan masuk dengan akun Anda.
            </div>
        <?php endif; ?>
        
        <form action="../actions/login_process.php" method="POST">
            <div class="mb-4">
                <label for="email" class="block text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>
            <button type="submit" class="w-full py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition mb-4">
                Masuk
            </button>
            <div class="text-center text-sm text-gray-600">
                Belum punya akun? <a href="register.php" class="text-indigo-600 hover:underline">Daftar disini</a>
            </div>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>