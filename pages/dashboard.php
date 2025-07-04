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

// Load users from file
$users_file = '../database/users.txt';
$users = [];
if (file_exists($users_file)) {
    $lines = file($users_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $user = json_decode($line, true);
        if ($user) {
            $users[$user['email']] = $user;
        }
    }
}

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
}

// Load registrations from file
$registrations_file = '../database/registrations.txt';
$registrations = [];
if (file_exists($registrations_file)) {
    $lines = file($registrations_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $reg = json_decode($line, true);
        if ($reg) {
            $registrations[] = $reg;
        }
    }
}

// Get registered event IDs for peserta
$registered_event_ids = [];
if ($user_role === 'peserta') {
    foreach ($registrations as $reg) {
        if (isset($reg['user_email']) && $reg['user_email'] === $user_email) {
            $registered_event_ids[] = $reg['event_id'];
        }
    }
}

// Function to count participants for an event
function countParticipants($event_id, $registrations) {
    $count = 0;
    foreach ($registrations as $reg) {
        if (isset($reg['event_id']) && $reg['event_id'] === $event_id) {
            $count++;
        }
    }
    return $count;
}

?>

<div class="container py-5">
    <h1 class="mb-4">Dashboard</h1>

    <?php if ($user_role === 'admin' || $user_role === 'pengurus'): ?>
        <h2><?= $user_role === 'admin' ? 'Semua Event' : 'Event yang Anda Buat' ?></h2>
        <a href="event_create.php" class="btn btn-success mb-3">Buat Event Baru</a>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Judul</th>
                    <?php if ($user_role === 'admin'): ?>
                    <th>Pembuat</th>
                    <?php endif; ?>
                    <th>Deskripsi</th>
                    <th>Peserta Terdaftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $found = false;
                foreach ($events as $event) {
                    if ($user_role === 'admin' || (isset($event['creator']) && $event['creator'] === $user_email)) {
                        $found = true;
                ?>
                <tr>
                    <td><?= htmlspecialchars($event['judul']) ?></td>
                    <?php if ($user_role === 'admin'): ?>
                    <td>
                        <?php
                        $creator_email = $event['creator'] ?? '';
                        if (isset($users[$creator_email])) {
                            $creator_name = htmlspecialchars($users[$creator_email]['nama']);
                            echo '<a href="profile.php?email=' . urlencode($creator_email) . '">' . $creator_name . '</a>';
                        } else {
                            echo htmlspecialchars($creator_email);
                        }
                        ?>
                    </td>
                    <?php endif; ?>
                    <td><?= htmlspecialchars($event['deskripsi']) ?></td>
                    <td><?= countParticipants($event['id'], $registrations) ?></td>
                    <td>
                        <a href="event_edit.php?id=<?= htmlspecialchars($event['id']) ?>" class="btn btn-primary btn-sm me-2">Edit</a>
                        <a href="event_delete.php?id=<?= htmlspecialchars($event['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus event ini?');">Hapus</a>
                    </td>
                </tr>
                <?php
                    }
                }
                if (!$found) {
                ?>
                <tr>
                    <td colspan="<?= $user_role === 'admin' ? 5 : 4 ?>" class="text-center">Tidak ada event untuk ditampilkan.</td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

    <?php elseif ($user_role === 'peserta'): ?>
        <h2>Event yang Anda Daftar</h2>
        <div class="row">
            <?php
            $found = false;
            foreach ($events as $event):
                if (in_array($event['id'], $registered_event_ids)):
                    $found = true;
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?= htmlspecialchars($event['gambar_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($event['judul']) ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><a href="event_detail.php?id=<?= htmlspecialchars($event['id']) ?>"><?= htmlspecialchars($event['judul']) ?></a></h5>
                            <p class="card-text"><?= htmlspecialchars($event['deskripsi']) ?></p>
                            <p>Penyelenggara: 
                                <?php
                                $creator_email = $event['creator'] ?? '';
                                if (isset($users[$creator_email])) {
                                    echo '<a href="profile.php?email=' . urlencode($creator_email) . '">' . htmlspecialchars($users[$creator_email]['nama']) . '</a>';
                                } else {
                                    echo htmlspecialchars($creator_email);
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php
                endif;
            endforeach;
            if (!$found):
            ?>
                <p>Anda belum mendaftar event apapun.</p>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <p>Role tidak dikenali.</p>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
