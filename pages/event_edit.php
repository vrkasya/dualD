<?php
session_start();
include '../includes/header.php';
include '../includes/navbar.php';

if (!isset($_SESSION['logged_in'])) {
    header('Location: ../login.php');
    exit();
}

$user_role = $_SESSION['user_role'];
$user_email = $_SESSION['user_email'] ?? '';

if (!isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit();
}

$event_id = $_GET['id'];

// Load events from file
$events_file = '../database/events.txt';
$events = [];
if (file_exists($events_file)) {
    $lines = file($events_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $event = json_decode($line, true);
        if ($event) {
            $events[] = $event;
        }
    }
} else {
    $events = [];
}

// Find event by id
$event_to_edit = null;
foreach ($events as $event) {
    if ($event['id'] === $event_id) {
        $event_to_edit = $event;
        break;
    }
}

if (!$event_to_edit) {
    echo "<div class='container py-5'><h2>Event tidak ditemukan.</h2></div>";
    include '../includes/footer.php';
    exit();
}

// Check permission: admin or creator (pengurus)
if ($user_role !== 'admin' && (!isset($event_to_edit['creator']) || $event_to_edit['creator'] !== $user_email)) {
    echo "<div class='container py-5'><h2>Anda tidak memiliki izin untuk mengedit event ini.</h2></div>";
    include '../includes/footer.php';
    exit();
}

?>

<div class="container py-5">
    <h1>Edit Event</h1>
    <form action="../actions/event_edit.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($event_to_edit['id']) ?>">
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Event</label>
            <input type="text" class="form-control" id="judul" name="judul" value="<?= htmlspecialchars($event_to_edit['judul']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required><?= htmlspecialchars($event_to_edit['deskripsi']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= htmlspecialchars($event_to_edit['tanggal']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="waktu" class="form-label">Waktu</label>
            <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai" value="<?= htmlspecialchars($event_to_edit['waktu_mulai'] ?? '') ?>" required>
            <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai" value="<?= htmlspecialchars($event_to_edit['waktu_selesai'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= htmlspecialchars($event_to_edit['lokasi']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-select" id="kategori" name="kategori" required>
                <option value="">Pilih kategori</option>
                <?php
                $categories = ['seminar', 'workshop', 'kompetisi', 'hiburan', 'pelatihan'];
                foreach ($categories as $cat) {
                    $selected = ($event_to_edit['kategori'] === $cat) ? 'selected' : '';
                    echo "<option value=\"$cat\" $selected>" . ucfirst($cat) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="gambar_url" class="form-label">URL Gambar</label>
            <input type="url" class="form-control" id="gambar_url" name="gambar_url" value="<?= htmlspecialchars($event_to_edit['gambar_url']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="contact" class="form-label">Kontak Penyelenggara</label>
            <input type="text" class="form-control" id="contact" name="contact" value="<?= htmlspecialchars($event_to_edit['contact'] ?? '') ?>" placeholder="Nomor telepon atau email" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Pembicara</label>
            <div id="speakers-container">
                <?php
                $speakers = $event_to_edit['speakers'] ?? [];
                if (!empty($speakers) && isset($speakers[0]['name'])) {
                    $count_speakers = count($speakers);
                    for ($i = 0; $i < $count_speakers; $i++):
                        $name = $speakers[$i]['name'] ?? '';
                        $title = $speakers[$i]['title'] ?? '';
                ?>
                <div class="speaker-entry mb-2 d-flex justify-content-between gap-2">
                    <input type="text" name="speakers[name][]" class="form-control" placeholder="Nama Pembicara" value="<?= htmlspecialchars($name) ?>" required>
                    <input type="text" name="speakers[title][]" class="form-control" placeholder="Jabatan" value="<?= htmlspecialchars($title) ?>" required>
                    <button type="button" class="btn btn-danger btn-sm mt-1 remove-speaker-btn">Hapus Pembicara</button>
                </div>
                <?php endfor;
                } elseif (!empty($speakers)) {
                    // fallback for old format
                    $count_speakers = max(count($speakers['name'] ?? []), count($speakers['title'] ?? []));
                    for ($i = 0; $i < $count_speakers; $i++):
                        $name = $speakers['name'][$i] ?? '';
                        $title = $speakers['title'][$i] ?? '';
                ?>
                <div class="speaker-entry mb-2 d-flex justify-content-between gap-2">
                    <input type="text" name="speakers[name][]" class="form-control" placeholder="Nama Pembicara" value="<?= htmlspecialchars($name) ?>" required>
                    <input type="text" name="speakers[title][]" class="form-control" placeholder="Jabatan" value="<?= htmlspecialchars($title) ?>" required>
                    <button type="button" class="btn btn-danger btn-sm mt-1 remove-speaker-btn">Hapus Pembicara</button>
                </div>
                <?php endfor;
                }
                ?>
            </div>
            <button type="button" class="btn btn-secondary btn-sm" id="add-speaker-btn">Tambah Pembicara</button>
        </div>
        <div class="mb-3">
            <label class="form-label">Jadwal Acara</label>
            <div id="schedule-container">
                <?php
                $schedule = $event_to_edit['schedule'] ?? [];
                if (!empty($schedule) && isset($schedule[0]['start_time'])) {
                    $count_schedule = count($schedule);
                    for ($i = 0; $i < $count_schedule; $i++):
                        $start_time = $schedule[$i]['start_time'] ?? '';
                        $end_time = $schedule[$i]['end_time'] ?? '';
                        $activity = $schedule[$i]['activity'] ?? '';
                ?>
                <div class="schedule-entry mb-2 d-flex justify-content-between gap-2">
                    <input type="time" name="schedule[start_time][]" class="form-control" placeholder="Waktu Mulai" value="<?= htmlspecialchars($start_time) ?>" required>
                    <input type="time" name="schedule[end_time][]" class="form-control" placeholder="Waktu Selesai" value="<?= htmlspecialchars($end_time) ?>" required>
                    <input type="text" name="schedule[activity][]" class="form-control" placeholder="Kegiatan" value="<?= htmlspecialchars($activity) ?>" required>
                    <button type="button" class="btn btn-danger btn-sm mt-1 remove-schedule-btn">Hapus Jadwal</button>
                </div>
                <?php endfor;
                } elseif (!empty($schedule)) {
                    // fallback for old format
                    $count_schedule = max(count($schedule['start_time'] ?? []), count($schedule['end_time'] ?? []), count($schedule['activity'] ?? []));
                    for ($i = 0; $i < $count_schedule; $i++):
                        $start_time = $schedule['start_time'][$i] ?? '';
                        $end_time = $schedule['end_time'][$i] ?? '';
                        $activity = $schedule['activity'][$i] ?? '';
                ?>
                <div class="schedule-entry mb-2 d-flex justify-content-between gap-2">
                    <input type="time" name="schedule[start_time][]" class="form-control" placeholder="Waktu Mulai" value="<?= htmlspecialchars($start_time) ?>" required>
                    <input type="time" name="schedule[end_time][]" class="form-control" placeholder="Waktu Selesai" value="<?= htmlspecialchars($end_time) ?>" required>
                    <input type="text" name="schedule[activity][]" class="form-control" placeholder="Kegiatan" value="<?= htmlspecialchars($activity) ?>" required>
                    <button type="button" class="btn btn-danger btn-sm mt-1 remove-schedule-btn">Hapus Jadwal</button>
                </div>
                <?php endfor;
                }
                ?>
            </div>
            <button type="button" class="btn btn-secondary btn-sm" id="add-schedule-btn">Tambah Jadwal</button>
        </div>
        <div class="mb-3">
            <label class="form-label">Persyaratan</label>
            <div id="requirements-container">
                <?php
                $requirements = $event_to_edit['requirements'] ?? [];
                foreach ($requirements as $requirement):
                ?>
                <div class="requirement-entry mb-1 d-flex gap-2 align-items-center">
                    <input type="text" name="requirements[]" class="form-control" placeholder="Persyaratan" value="<?= htmlspecialchars($requirement) ?>" required>
                    <button type="button" class="btn btn-danger btn-sm remove-requirement-btn">Hapus Persyaratan</button>
                </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="btn btn-secondary btn-sm" id="add-requirement-btn">Tambah Persyaratan</button>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="dashboard.php" class="btn btn-secondary ms-2">Batal</a>
    </form>
</div>

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
    div.classList.add('requirement-entry', 'mb-1', 'd-flex', 'gap-2', 'align-items-center');
    div.innerHTML = `
        <input type="text" name="requirements[]" class="form-control" placeholder="Persyaratan" required>
        <button type="button" class="btn btn-danger btn-sm remove-requirement-btn">Hapus Persyaratan</button>
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

<?php include '../includes/footer.php'; ?>
