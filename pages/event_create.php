<?php
session_start();
include '../includes/header.php';
include '../includes/navbar.php';

// Check if user is admin (optional, based on session)
// if (!isset($_SESSION['logged_in']) || $_SESSION['user_role'] !== 'admin') {
//     header('Location: ../index.php');
//     exit();
// }
?>

<section class="py-5">
    <div class="container">
        <h1 class="mb-4">Buat Event Baru</h1>
        <form action="../actions/event_create.php" method="POST">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Event</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="mb-3">
                <label for="waktu" class="form-label">Waktu</label>
                <input type="text" class="form-control" id="waktu" name="waktu" placeholder="e.g. 09:00 - 12:00" required>
            </div>
            <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select" id="kategori" name="kategori" required>
                    <option value="">Pilih kategori</option>
                    <option value="seminar">Seminar</option>
                    <option value="workshop">Workshop</option>
                    <option value="kompetisi">Kompetisi</option>
                    <option value="hiburan">Hiburan</option>
                    <option value="pelatihan">Pelatihan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="gambar_url" class="form-label">URL Gambar</label>
                <input type="url" class="form-control" id="gambar_url" name="gambar_url" required>
            </div>
            <button type="submit" class="btn btn-primary">Buat Event</button>
        </form>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
