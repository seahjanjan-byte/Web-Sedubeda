<?php include '../includes/header.php'; ?>
<div class="container py-5">
    <h2 class="fw-bold text-center mb-5">Fasilitas Sekolah</h2>
    <div class="row">
        <?php
        $q = mysqli_query($koneksi, "SELECT * FROM fasilitas");
        while($f = mysqli_fetch_assoc($q)) { ?>
            <div class="col-md-4 mb-4 text-center">
                <div class="card border-0 shadow-sm overflow-hidden h-100">
                    <img src="<?= $base_url; ?>assets/img/fasilitas/<?= $f['gambar']; ?>" class="card-img-top" style="height:200px; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="fw-bold"><?= $f['nama_fasilitas']; ?></h5>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php 
// Mengambil footer secara dinamis
include_once dirname(__DIR__) . '/includes/footer.php'; 
?>