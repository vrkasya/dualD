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

<div class="container mx-auto px-4 py-16">
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg text-center">
        <div class="text-green-500 text-6xl mb-4">
            <i class="fas fa-check-circle"></i>
        </div>
        <h2 class="text-2xl font-bold mb-4">Pendaftaran Berhasil!</h2>
        <p class="text-gray-600 mb-6">
            Terima kasih telah mendaftar untuk event <span class="font-semibold"><?php echo htmlspecialchars($event_name); ?></span>.
            Kami akan mengirimkan detail lebih lanjut ke email Anda.
        </p>
        <a href="../index.php" class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition">
            Kembali ke Beranda
        </a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>