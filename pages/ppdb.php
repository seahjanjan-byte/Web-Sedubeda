<?php include '../includes/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 text-center">
            <h2 class="fw-bold mb-4" data-aos="fade-up">Informasi PPDB</h2>
            <p class="text-muted mb-5" data-aos="fade-up" data-aos-delay="100">
                Silakan unduh atau pelajari brosur pendaftaran siswa baru di bawah ini.
            </p>
            
            <?php
            // Mengambil data brosur dari database
            $q = mysqli_query($koneksi, "SELECT * FROM ppdb LIMIT 1");
            $d = mysqli_fetch_assoc($q);
            ?>
            
            <div class="ppdb-container mb-5" data-aos="zoom-in" data-aos-delay="200">
                <img src="<?= $base_url; ?>assets/img/<?= $d['brosur']; ?>" 
                     class="img-fluid w-100 shadow-lg rounded-4 mb-4" 
                     style="max-width: 850px; height: auto;" 
                     alt="Brosur PPDB SDN Dukuhbenda 02">
                
                <div class="mt-2" data-aos="fade-up" data-aos-delay="300">
                    <a href="<?= $base_url; ?>assets/img/<?= $d['brosur']; ?>" 
                       class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm" download>
                        <i class="fas fa-download me-2"></i> Download Brosur (Kualitas HD)
                    </a>
                </div>
            </div>

            <div class="alert alert-info border-0 shadow-sm rounded-4 p-4 text-start" data-aos="fade-up">
                <h6 class="fw-bold"><i class="fas fa-info-circle me-2"></i> Butuh bantuan pendaftaran?</h6>
                <p class="mb-0 small">Hubungi Admin Sekolah melalui WhatsApp atau datang langsung ke sekolah pada jam kerja (07.30 - 13.00 WIB).</p>
            </div>
        </div>
    </div>
</div>

<?php 
// Mengambil footer secara dinamis
include_once dirname(__DIR__) . '/includes/footer.php'; 
?>