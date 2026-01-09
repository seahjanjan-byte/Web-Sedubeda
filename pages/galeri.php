<?php include '../includes/header.php'; ?>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Galeri Kegiatan</h2>
        <p class="text-muted">Klik tombol pada setiap foto untuk melihat dokumentasi lengkap di Google Drive</p>
        <hr class="mx-auto" style="width: 100px; height: 3px; background: #0d6efd;">
    </div>

    <div class="row">
        <?php
        $queryGaleri = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY tanggal DESC");
        
        if (mysqli_num_rows($queryGaleri) > 0) {
            while ($ga = mysqli_fetch_assoc($queryGaleri)) {
        ?>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100 overflow-hidden">
                    <img src="<?= $base_url; ?>assets/img/galeri/<?= $ga['gambar']; ?>" class="card-img-top" style="height: 220px; object-fit: cover;">
                    
                    <div class="card-body d-flex flex-column">
                        <h6 class="fw-bold mb-3"><?= $ga['judul']; ?></h6>
                        
                        <div class="mt-auto">
                            <a href="<?= $ga['link_gdrive']; ?>" target="_blank" class="btn btn-outline-success btn-sm w-100">
                                <i class="fab fa-google-drive me-1"></i> Lihat Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
            }
        } else {
            echo "<div class='col-12 text-center'><p class='text-muted'>Belum ada dokumentasi foto.</p></div>";
        }
        ?>
    </div>
</div>
<?php 
// Mengambil footer secara dinamis
include_once dirname(__DIR__) . '/includes/footer.php'; 
?>
</body>
</html>