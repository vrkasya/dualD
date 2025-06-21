<?php
session_start();
// Cek apakah user adalah admin
if (!isset($_SESSION['logged_in']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

include '../includes/header.php';
include '../includes/navbar.php';
include '../config/db.php';
?>

<div class="flex">
    <!-- Sidebar -->
    <div class="admin-sidebar w-64 min-h-screen text-white p-4">
        <div class="flex items-center space-x-2 mb-8">
            <i class="fas fa-calendar-alt text-2xl"></i>
            <span class="text-xl font-bold">EventKampus Admin</span>
        </div>
        
        <ul class="space-y-2">
            <li>
                <a href="index.php" class="admin-nav-item flex items-center p-3 rounded-lg active">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="manage_events.php" class="admin-nav-item flex items-center p-3 rounded-lg">
                    <i class="fas fa-calendar mr-3"></i>
                    Kelola Event
                </a>
            </li>
            <li>
                <a href="manage_users.php" class="admin-nav-item flex items-center p-3 rounded-lg">
                    <i class="fas fa-users mr-3"></i>
                    Kelola Pengguna
                </a>
            </li>
            <li>
                <a href="manage_registrations.php" class="admin-nav-item flex items-center p-3 rounded-lg">
                    <i class="fas fa-clipboard-list mr-3"></i>
                    Pendaftaran Event
                </a>
            </li>
            <li>
                <a href="../actions/logout.php" class="admin-nav-item flex items-center p-3 rounded-lg">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Keluar
                </a>
            </li>
        </ul>
    </div>
    
    <!-- Main Content -->
    <div class="flex-1 p-8">
        <h1 class="text-3xl font-bold mb-8">Dashboard Admin</h1>
        
        <?php if (isset($_SESSION['event_created'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                Event berhasil dibuat!
            </div>
            <?php unset($_SESSION['event_created']); ?>
        <?php endif; ?>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Statistik Card 1 -->
            <div class="dashboard-card bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-500 text-sm uppercase">Total Event</h3>
                        <p class="text-3xl font-bold">24</p>
                    </div>
                    <div class="bg-indigo-100 p-3 rounded-full">
                        <i class="fas fa-calendar text-indigo-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Statistik Card 2 -->
            <div class="dashboard-card bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-500 text-sm uppercase">Total Peserta</h3>
                        <p class="text-3xl font-bold">156</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-users text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Statistik Card 3 -->
            <div class="dashboard-card bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-500 text-sm uppercase">Pendaftaran Hari Ini</h3>
                        <p class="text-3xl font-bold">8</p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <i class="fas fa-clipboard-list text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Event Terbaru -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h2 class="text-xl font-bold mb-4">Event Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pendaftar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1431540015161-0bf868a8d214?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Seminar Kewirausahaan</div>
                                        <div class="text-sm text-gray-500">Seminar</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">15 Okt 2023</div>
                                <div class="text-sm text-gray-500">09:00 - 12:00</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Aula Kampus Utama
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                42
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                            </td>
                        </tr>
                        <!-- Baris lainnya -->
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Tombol Tambah Event -->
        <div class="text-right">
            <a href="event_create.php" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                <i class="fas fa-plus mr-2"></i> Tambah Event Baru
            </a>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>