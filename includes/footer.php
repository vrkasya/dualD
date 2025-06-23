<?php require_once __DIR__ . '/../config/path.php'; ?>

<!-- Footer -->
<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-calendar-alt fa-2x me-2"></i>
                    <span class="h4 fw-bold mb-0">EventKampus</span>
                </div>
                <p class="text-light">
                    Platform untuk menemukan dan mengelola event kampus dengan mudah dan efisien.
                </p>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h5 class="mb-3">Tautan</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-light text-decoration-none">Beranda</a></li>
                            <li class="mb-2"><a href="#events" class="text-light text-decoration-none">Event</a></li>
                            <li class="mb-2"><a href="#about" class="text-light text-decoration-none">Tentang</a></li>
                            <li><a href="#contact" class="text-light text-decoration-none">Kontak</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h5 class="mb-3">Layanan</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-light text-decoration-none">Daftar Event</a></li>
                            <li class="mb-2"><a href="#" class="text-light text-decoration-none">Buat Event</a></li>
                            <li><a href="#" class="text-light text-decoration-none">Panduan</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5 class="mb-3">Kontak</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2 d-flex align-items-center">
                                <i class="fas fa-envelope me-2 text-light"></i>
                                <span>info@eventkampus.com</span>
                            </li>
                            <li class="mb-2 d-flex align-items-center">
                                <i class="fas fa-phone me-2 text-light"></i>
                                <span>+62 21 12345678</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="fas fa-map-marker-alt me-2 text-light"></i>
                                <span>Daerah Istimewa Yogyakarta, Indonesia</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4 bg-light">
        <div class="text-center text-light">
            <p>&copy; 2025 EventKampus. Hak Cipta Dilindungi.</p>
        </div>
    </div>
</footer>
    
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script>
    // Fungsi untuk menampilkan modal login
    function showLoginForm() {
        document.getElementById('loginModal').classList.remove('d-none');
        document.getElementById('loginModal').classList.add('d-block');
        document.getElementById('registerModal').classList.add('d-none');
    }

    // Fungsi untuk menampilkan modal register
    function showRegisterForm() {
        document.getElementById('registerModal').classList.remove('d-none');
        document.getElementById('registerModal').classList.add('d-block');
        document.getElementById('loginModal').classList.add('d-none');
    }

    // Fungsi untuk menyembunyikan modal
    function hideModal() {
        document.getElementById('loginModal').classList.add('d-none');
        document.getElementById('registerModal').classList.add('d-none');
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
    }
    </script>

    
</body>
</html>