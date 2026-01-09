<?php include '../includes/header.php'; ?>

<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center">Prestasi Siswa & Sekolah</h2>

    <div class="card border-0 shadow-sm p-4 mb-5 bg-light">
        <form action="" method="GET" class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-bold">Cari Prestasi</label>
                <input type="text" name="cari" class="form-control" placeholder="Nama lomba/pemenang..." value="<?= @$_GET['cari']; ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">Tingkat</label>
                <select name="tingkat" class="form-select">
                    <option value="">-- Semua Tingkat --</option>
                    <option value="Kecamatan" <?= @$_GET['tingkat'] == 'Kecamatan' ? 'selected' : ''; ?>>Kecamatan</option>
                    <option value="Kabupaten" <?= @$_GET['tingkat'] == 'Kabupaten' ? 'selected' : ''; ?>>Kabupaten</option>
                    <option value="Provinsi" <?= @$_GET['tingkat'] == 'Provinsi' ? 'selected' : ''; ?>>Provinsi</option>
                    <option value="Nasional" <?= @$_GET['tingkat'] == 'Nasional' ? 'selected' : ''; ?>>Nasional</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">Urutkan Tahun</label>
                <select name="sort_tahun" class="form-select">
                    <option value="DESC" <?= @$_GET['sort_tahun'] == 'DESC' ? 'selected' : ''; ?>>Terbaru</option>
                    <option value="ASC" <?= @$_GET['sort_tahun'] == 'ASC' ? 'selected' : ''; ?>>Terlama</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>
    </div>

    <div class="row">
        <?php
        // LOGIKA FILTERING SQL
        $where_clauses = [];
        if (!empty($_GET['cari'])) {
            $cari = mysqli_real_escape_string($koneksi, $_GET['cari']);
            $where_clauses[] = "(nama_prestasi LIKE '%$cari%' OR pemenang LIKE '%$cari%')";
        }
        if (!empty($_GET['tingkat'])) {
            $tingkat = mysqli_real_escape_string($koneksi, $_GET['tingkat']);
            $where_clauses[] = "tingkat = '$tingkat'";
        }

        $where_sql = "";
        if (count($where_clauses) > 0) {
            $where_sql = " WHERE " . implode(" AND ", $where_clauses);
        }

        $sort = (isset($_GET['sort_tahun']) && $_GET['sort_tahun'] == 'ASC') ? 'ASC' : 'DESC';

        $query = mysqli_query($koneksi, "SELECT * FROM prestasi $where_sql ORDER BY tahun $sort");

        if (mysqli_num_rows($query) > 0) {
            while ($p = mysqli_fetch_assoc($query)) {
        ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="<?= $base_url; ?>assets/img/prestasi/<?= $p['gambar']; ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-info mb-2"><?= $p['tingkat']; ?></span>
                        <h5 class="fw-bold"><?= $p['nama_prestasi']; ?></h5>
                        <p class="text-muted mb-1"><i class="fas fa-user me-2"></i> <?= $p['pemenang']; ?></p>
                        <p class="text-muted"><i class="fas fa-calendar me-2"></i> Tahun <?= $p['tahun']; ?></p>
                    </div>
                </div>
            </div>
        <?php 
            }
        } else {
            echo "<div class='text-center py-5'><p class='text-muted'>Data prestasi tidak ditemukan.</p></div>";
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