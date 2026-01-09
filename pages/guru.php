<?php include '../includes/header.php'; ?>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Guru & Staff</h2>
        <p class="text-muted">Mengenal lebih dekat tenaga pendidik SDN Dukuhbenda 02</p>
        <hr class="mx-auto" style="width: 100px; height: 3px; background: #0d6efd;">
    </div>

    <div class="row">
        <?php
        $queryGuru = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY id_guru ASC");
        if (mysqli_num_rows($queryGuru) > 0) {
            while ($g = mysqli_fetch_assoc($queryGuru)) {
        ?>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card border-0 shadow-sm text-center p-3">
                    <img src="<?= $base_url; ?>assets/img/guru/<?= $g['foto']; ?>" class="card-img-top rounded-circle mx-auto mt-3" style="width: 150px; height: 150px; object-fit: cover;" alt="<?= $g['nama']; ?>">
                    <div class="card-body">
                        <h5 class="fw-bold mb-1"><?= $g['nama']; ?></h5>
                        <p class="text-primary mb-0"><?= $g['jabatan']; ?></p>
                    </div>
                </div>
            </div>
        <?php 
            }
        } else {
            echo "<p class='text-center'>Data guru belum tersedia.</p>";
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