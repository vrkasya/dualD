<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>


<!-- <div class="container">
    <h1>Upcoming Events</h1>
    <div id="event-list"> -->

        <!-- Hero Section -->
        <section class="hero flex items-center justify-center text-white">
            <!-- ... (konten hero section) ... -->
            <div class="text-center px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 animate-fadeIn">Selamat Datang di EventKampus</h1>
            <p class="text-xl mb-8 max-w-2xl mx-auto animate-fadeIn delay-100">Temukan dan ikuti berbagai event kampus menarik seperti seminar, workshop, dan kompetisi</p>
            <button class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-bold hover:bg-indigo-700 transition animate-fadeIn delay-200">
                Jelajahi Event <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
        </section>

        <!-- Events Section -->
        <section id="events" class="py-16 bg-white">
            <!-- ... (konten events section) ... -->
            <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Event Mendatang</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Event Card 1 -->
                <div class="event-card bg-white relative animate-fadeIn delay-100">
                    <div class="event-category bg-indigo-100 text-indigo-800">Seminar</div>
                    <img src="#" 
                         alt="Seminar Kewirausahaan" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Seminar Kewirausahaan</h3>
                        <div class="flex items-center text-gray-500 mb-3">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span>15 Oktober 2023, 09:00 - 12:00</span>
                        </div>
                        <div class="flex items-center text-gray-500 mb-4">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>Aula Kampus Utama</span>
                        </div>
                        <p class="text-gray-600 mb-4">Pelajari strategi membangun bisnis dari nol bersama para praktisi sukses.</p>
                        <button onclick="showRegistrationForm('Seminar Kewirausahaan')" class="w-full py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            Daftar Sekarang
                        </button>
                    </div>
                </div>
                
                <!-- Event Card 2 -->
                <div class="event-card bg-white relative animate-fadeIn delay-200">
                    <div class="event-category bg-green-100 text-green-800">Workshop</div>
                    <img src="#" 
                         alt="Workshop Coding" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Workshop Web Development</h3>
                        <div class="flex items-center text-gray-500 mb-3">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span>20 Oktober 2023, 13:00 - 16:00</span>
                        </div>
                        <div class="flex items-center text-gray-500 mb-4">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>Lab Komputer Gedung B</span>
                        </div>
                        <p class="text-gray-600 mb-4">Pelajari dasar-dasar pengembangan web modern dengan HTML, CSS, dan JavaScript.</p>
                        <button onclick="showRegistrationForm('Workshop Web Development')" class="w-full py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            Daftar Sekarang
                        </button>
                    </div>
                </div>
                
                <!-- Event Card 3 -->
                <div class="event-card bg-white relative animate-fadeIn delay-300">
                    <div class="event-category bg-yellow-100 text-yellow-800">Kompetisi</div>
                    <img src="#" 
                         alt="Hackathon" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Hackathon Kampus 2023</h3>
                        <div class="flex items-center text-gray-500 mb-3">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span>5 November 2023, 08:00 - 20:00</span>
                        </div>
                        <div class="flex items-center text-gray-500 mb-4">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>Gedung Inovasi</span>
                        </div>
                        <p class="text-gray-600 mb-4">Kompetisi pengembangan aplikasi selama 12 jam dengan hadiah total Rp 10 juta.</p>
                        <button onclick="showRegistrationForm('Hackathon Kampus 2023')" class="w-full py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            Daftar Sekarang
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <button class="px-6 py-3 bg-gray-200 text-gray-800 rounded-lg font-medium hover:bg-gray-300 transition">
                    Lihat Semua Event <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
        </section>

        <!-- About Section -->
        <section id="about" class="py-16 bg-gray-50">
            <!-- ... (konten about section) ... -->
            <h2 class="text-3xl font-bold mb-4">Tentang EventKampus</h2>
                    <p class="text-gray-600 mb-4">
                        EventKampus adalah platform yang memudahkan organisasi kampus dalam mengelola berbagai kegiatan dan event akademik maupun non-akademik.
                    </p>
                    <p class="text-gray-600 mb-6">
                        Dengan sistem ini, mahasiswa dapat dengan mudah menemukan event yang sesuai minat mereka dan mendaftar secara online, sementara panitia dapat mengelola peserta dengan lebih efisien.
                    </p>
                    <div class="flex space-x-4">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-indigo-600">50+</div>
                            <div class="text-gray-500">Event</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-indigo-600">2000+</div>
                            <div class="text-gray-500">Peserta</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-indigo-600">15+</div>
                            <div class="text-gray-500">Organisasi</div>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80" 
                         alt="Team" class="rounded-lg shadow-lg w-full">
                </div>
            </div>
        </div>
        </section>

    <!-- </div>
</div> -->

<?php include 'includes/footer.php'; ?>