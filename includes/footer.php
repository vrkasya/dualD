    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between">
                <div class="mb-6 md:mb-0">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-calendar-alt text-2xl"></i>
                        <span class="text-xl font-bold">EventKampus</span>
                    </div>
                    <p class="text-gray-400 max-w-md">
                        Platform untuk menemukan dan mengelola event kampus dengan mudah dan efisien.
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:grid-cols-3">
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Tautan</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white">Beranda</a></li>
                            <li><a href="#events" class="text-gray-400 hover:text-white">Event</a></li>
                            <li><a href="#about" class="text-gray-400 hover:text-white">Tentang</a></li>
                            <li><a href="#contact" class="text-gray-400 hover:text-white">Kontak</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Layanan</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white">Daftar Event</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Buat Event</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Panduan</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <i class="fas fa-envelope mr-2 text-gray-400"></i>
                                <span>info@eventkampus.com</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-phone mr-2 text-gray-400"></i>
                                <span>+62 21 12345678</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                                <span>Jakarta, Indonesia</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2023 EventKampus. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="form-container w-full max-w-md p-8">
            <!-- ... (kode modal login) ... -->
        </div>
    </div>

    <!-- Register Modal -->
    <div id="registerModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="form-container w-full max-w-md p-8">
            <!-- ... (kode modal register) ... -->
        </div>
    </div>

    <script>
        // Fungsi untuk menampilkan modal login
        function showLoginForm() {
            document.getElementById('loginModal').classList.remove('hidden');
            document.getElementById('registerModal').classList.add('hidden');
        }

        // Fungsi untuk menampilkan modal register
        function showRegisterForm() {
            document.getElementById('registerModal').classList.remove('hidden');
            document.getElementById('loginModal').classList.add('hidden');
        }

        // Fungsi untuk menyembunyikan modal
        function hideModal() {
            document.getElementById('loginModal').classList.add('hidden');
            document.getElementById('registerModal').classList.add('hidden');
        }

        // Fungsi untuk simulasi login
        function loginUser() {
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;
            
            // Validasi sederhana
            if(email && password) {
                alert('Login berhasil!');
                hideModal();
            } else {
                alert('Silakan isi email dan password');
            }
        }

        // Fungsi untuk menampilkan form pendaftaran event
        function showRegistrationForm(eventName) {
            alert(`Pendaftaran untuk event: ${eventName}\nForm pendaftaran akan muncul di sini.`);
            // Di sini bisa diarahkan ke halaman pendaftaran atau tampilkan modal
        }
    </script>
</body>
</html>