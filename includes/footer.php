</main> <footer class="py-5 text-white" style="background-color: #1e3d59;">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3">SDN DUKUHBENDA 02</h5>
                    <p class="small opacity-75">
                        Mencetak generasi yang cerdas, berkarakter, dan siap menghadapi tantangan zaman dengan pondasi iman dan takwa.
                    </p>
                    <div class="mt-4">
                        <a href="#" class="text-white me-3 fs-5"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white me-3 fs-5"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white fs-5"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div class="col-md-4 text-center">
                    <h5 class="fw-bold mb-3">Tautan Cepat</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="<?= $base_url; ?>index.php" class="text-white text-decoration-none opacity-75">Beranda</a></li>
                        <li class="mb-2"><a href="<?= $base_url; ?>pages/visi-misi.php" class="text-white text-decoration-none opacity-75">Profil Sekolah</a></li>
                        <li class="mb-2"><a href="<?= $base_url; ?>pages/berita.php" class="text-white text-decoration-none opacity-75">Berita Terkini</a></li>
                        <li class="mb-2"><a href="<?= $base_url; ?>pages/prestasi.php" class="text-white text-decoration-none opacity-75">Prestasi Siswa</a></li>
                    </ul>
                </div>

                <div class="col-md-4 text-md-end">
                    <h5 class="fw-bold mb-3">Layanan Informasi</h5>
                    <p class="small mb-3 opacity-75">Klik tombol di bawah untuk konsultasi atau tanya jawab langsung via WhatsApp:</p>
                    
                    <a href="https://wa.me/628XXXXXXXXXX" target="_blank" class="btn btn-success px-4 py-2 shadow-sm border-0" style="background-color: #25d366; border-radius: 50px; font-weight: 600;">
                        <i class="fab fa-whatsapp me-2"></i> Chat Admin Sekolah
                    </a>
                    
                    <div class="mt-4 small opacity-75">
                        <i class="fas fa-map-marker-alt me-2"></i> Bumijawa, Tegal, Jawa Tengah
                    </div>
                </div>
            </div>

            <hr class="my-4" style="opacity: 0.1;">
            
            <div class="text-center small opacity-50">
                &copy; 2026 SDN Dukuhbenda 02. All Rights Reserved.
            </div>
        </div>
    </footer>

    <div id="visitor-box" class="minimized" onclick="toggleVisitor()">
        <i class="fas fa-eye visitor-eye-icon"></i>
        
        <div class="visitor-inner-content">
            <span class="visitor-label">PENGUNJUNG</span>
            <div class="visitor-number"><?= $total_visitor; ?></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init({ duration: 1000, once: true, });

    // Inisialisasi Slider dengan fitur geser manual yang kuat
    const myCarouselElement = document.querySelector('#heroSlider');
    
    if (myCarouselElement) {
        const carousel = new bootstrap.Carousel(myCarouselElement, {
            interval: 4000, // Kecepatan pindah 4 detik
            ride: 'carousel', // Menjalankan otomatis sejak halaman dimuat
            pause: false,     // Slider TIDAK AKAN berhenti saat disentuh/diklik
            touch: true       // Mengaktifkan fitur geser manual di HP
        });
    }

    function toggleVisitor() {
        document.getElementById('visitor-box').classList.toggle('minimized');
    }
</script>
</body>
</html>