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

include '../actions/event_process.php';

?>

<div class="container py-5">
    <h1>Daftar Event</h1>

    <form method="GET" class="mb-4 d-flex align-items-center gap-3">
        <label for="kategori" class="mb-0">Filter berdasarkan kategori:</label>
        <select name="kategori" id="kategori" onchange="this.form.submit()" class="form-select w-auto">
            <option value="Semua" <?= $selectedKategori === 'Semua' ? 'selected' : '' ?>>Semua Kategori</option>
            <?php foreach ($kategoriList as $kategori): ?>
                <option value="<?= htmlspecialchars($kategori) ?>" <?= strtolower($kategori) === strtolower($selectedKategori) ? 'selected' : '' ?>>
                    <?= ucfirst(htmlspecialchars($kategori)) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="text" name="search" placeholder="Cari event..." value="<?= htmlspecialchars($searchTerm) ?>" class="form-control w-25" />
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <div class="row">
        <?php if (empty($paginatedEvents)): ?>
            <p>Tidak ada event untuk ditampilkan.</p>
        <?php else: ?>
            <?php foreach ($paginatedEvents as $event): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?= htmlspecialchars($event['gambar_url'] ?? 'default.jpg') ?>" class="card-img-top" alt="<?= htmlspecialchars($event['judul']) ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($event['judul']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($event['deskripsi']) ?></p>
                            <p><span class="text-muted"><?= htmlspecialchars($event['tanggal']) ?>, <?= htmlspecialchars($event['waktu'] ?? '-') ?></span></p>
                            <a href="event_detail.php?id=<?= htmlspecialchars($event['id']) ?>" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php if ($totalPages > 1): ?>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?kategori=<?= urlencode($selectedKategori) ?>&search=<?= urlencode($searchTerm) ?>&page=<?= $page - 1 ?>">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?kategori=<?= urlencode($selectedKategori) ?>&search=<?= urlencode($searchTerm) ?>&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?kategori=<?= urlencode($selectedKategori) ?>&search=<?= urlencode($searchTerm) ?>&page=<?= $page + 1 ?>">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
