<?php include '../includes/header.php'; ?>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="fw-bold text-primary">Arsip Berita</h2>
            <p class="text-muted">Informasi terbaru seputar SDN Dukuhbenda 02</p>
        </div>
        <div class="col-md-6">
            <form action="" method="GET" class="d-flex mt-3">
                <input type="text" name="cari" class="form-control me-2" placeholder="Masukkan kata kunci berita..." value="<?= isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
                <button type="submit" class="btn btn-primary px-4">Cari</button>
            </form>
        </div>
    </div>

    <div class="row">
        <?php
        // Logika Pencarian
        // Logika Pencarian di pages/berita.php
        $keyword = "";
        if (isset($_GET['cari'])) {
            $keyword = mysqli_real_escape_string($koneksi, $_GET['cari']);
            // Tambahkan status = 'tampil'
            $query = mysqli_query($koneksi, "SELECT * FROM berita WHERE status = 'tampil' AND (judul LIKE '%$keyword%' OR isi LIKE '%$keyword%') ORDER BY tanggal DESC");
        } else {
            // Tambahkan status = 'tampil'
            $query = mysqli_query($koneksi, "SELECT * FROM berita WHERE status = 'tampil' ORDER BY tanggal DESC");
        }

        if (mysqli_num_rows($query) > 0) {
            while ($b = mysqli_fetch_assoc($query)) {
                $cuplikan = substr(strip_tags($b['isi']), 0, 120) . "...";
        ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="<?= $base_url; ?>assets/img/berita/<?= $b['gambar']; ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <small class="text-primary fw-bold"><?= date('d M Y', strtotime($b['tanggal'])); ?></small>
                            <h5 class="card-title fw-bold mt-2"><?= $b['judul']; ?></h5>
                            <p class="card-text text-muted"><?= $cuplikan; ?></p>
                        </div>
                        <div class="card-footer bg-white border-0 pb-3">
                            <a href="<?= $base_url; ?>pages/detail-berita.php?slug=<?= $b['slug']; ?>" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<div class='col-12 text-center py-5'><h4 class='text-muted'>Berita tidak ditemukan.</h4><a href='berita.php' class='btn btn-link'>Kembali ke semua berita</a></div>";
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