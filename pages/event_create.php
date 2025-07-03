<?php
session_start();
include '../includes/header.php';
include '../includes/navbar.php';

// Check if user is logged in and has role 'pengurus' or 'admin'
if (!isset($_SESSION['logged_in']) || !in_array($_SESSION['user_role'], ['pengurus', 'admin'])) {
    header('Location: ../index.php');
    exit();
}
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
                <label for="waktu" class="form-label">Durasi</label>
                <div class="d-flex justify-content-between gap-2">
                    <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai" required>
                    <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai" required>
                </div>
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
            <div class="mb-3">
                <label for="contact" class="form-label">Kontak Penyelenggara</label>
                <input type="text" class="form-control" id="contact" name="contact" placeholder="Nomor telepon atau email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Pembicara</label>
                <div id="speakers-container">
                <div class="speaker-entry mb-2 d-flex justify-content-between gap-2">
                    <input type="text" name="speakers[name][]" class="form-control" placeholder="Nama Pembicara" required>
                    <input type="text" name="speakers[title][]" class="form-control" placeholder="Jabatan" required>
                </div>
                </div>
                <button type="button" class="btn btn-secondary btn-sm" id="add-speaker-btn">Tambah Pembicara</button>
            </div>
            <div class="mb-3">
                <label class="form-label">Jadwal Acara</label>
                <div id="schedule-container">
                <div class="schedule-entry mb-2 d-flex justify-content-between gap-2">
                    <input type="time" name="schedule[start_time][]" class="form-control" placeholder="Waktu Mulai" required>
                    <input type="time" name="schedule[end_time][]" class="form-control" placeholder="Waktu Selesai" required>
                    <input type="text" name="schedule[activity][]" class="form-control" placeholder="Kegiatan" required>
                </div>
                </div>
                <button type="button" class="btn btn-secondary btn-sm" id="add-schedule-btn">Tambah Jadwal</button>
            </div>
            <div class="mb-3">
                <label class="form-label">Persyaratan</label>
                <div id="requirements-container">
                    <input type="text" name="requirements[]" class="form-control mb-1" placeholder="Persyaratan" required>
                </div>
                <button type="button" class="btn btn-secondary btn-sm" id="add-requirement-btn">Tambah Persyaratan</button>
            </div>
            <button type="submit" class="btn btn-primary">Buat Event</button>
        </form>
    </div>
</section>

<script>
document.getElementById('add-speaker-btn').addEventListener('click', function() {
    const container = document.getElementById('speakers-container');
    const entry = document.createElement('div');
    entry.classList.add('speaker-entry', 'mb-2', 'd-flex', 'justify-content-between', 'gap-2');
    entry.innerHTML = `
        <input type="text" name="speakers[name][]" class="form-control" placeholder="Nama Pembicara" required>
        <input type="text" name="speakers[title][]" class="form-control" placeholder="Jabatan" required>
        <button type="button" class="btn btn-danger btn-sm mt-1 remove-speaker-btn">Hapus Pembicara</button>
    `;
    container.appendChild(entry);
});

document.getElementById('add-schedule-btn').addEventListener('click', function() {
    const container = document.getElementById('schedule-container');
    const entry = document.createElement('div');
    entry.classList.add('schedule-entry', 'mb-2', 'd-flex', 'justify-content-between', 'gap-2');
    entry.innerHTML = `
        <input type="time" name="schedule[start_time][]" class="form-control" placeholder="Waktu Mulai" required>
        <input type="time" name="schedule[end_time][]" class="form-control" placeholder="Waktu Selesai" required>
        <input type="text" name="schedule[activity][]" class="form-control" placeholder="Kegiatan" required>
        <button type="button" class="btn btn-danger btn-sm mt-1 remove-schedule-btn">Hapus Jadwal</button>
    `;
    container.appendChild(entry);
});

document.getElementById('add-requirement-btn').addEventListener('click', function() {
    const container = document.getElementById('requirements-container');
    const div = document.createElement('div');
    div.classList.add('requirement-entry', 'mb-1');
    div.innerHTML = `
        <input type="text" name="requirements[]" class="form-control mb-1" placeholder="Persyaratan" required>
        <button type="button" class="btn btn-danger btn-sm mt-1 remove-requirement-btn">Hapus Persyaratan</button>
    `;
    container.appendChild(div);
});

// Event delegation for remove buttons
document.getElementById('speakers-container').addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('remove-speaker-btn')) {
        e.target.parentElement.remove();
    }
});

document.getElementById('schedule-container').addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('remove-schedule-btn')) {
        e.target.parentElement.remove();
    }
});

document.getElementById('requirements-container').addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('remove-requirement-btn')) {
        e.target.parentElement.remove();
    }
});
</script>

<?php include '../includes/footer.php'; ?>
</create_file>
