<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../../login.php"); exit; }
include_once '../../../config/config.php';

// Ambil ID prestasi dari URL
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM prestasi WHERE id_prestasi = '$id'");
$data = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan
if (!$data) {
    echo "<script>alert('Data prestasi tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Prestasi - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body style="background-color: #f8f9fa;">
    <div class="d-flex" id="wrapper">
        <?php include '../../sidebar.php'; ?>
        <div id="page-content-wrapper" class="w-100">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white py-3">
                                <h5 class="fw-bold m-0" style="color: #1e3d59;">Edit Data Prestasi</h5>
                            </div>
                            <div class="card-body p-4">
                                <form action="proses.php?aksi=edit" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id_prestasi" value="<?= $data['id_prestasi']; ?>">

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nama Prestasi / Lomba</label>
                                        <input type="text" name="nama_prestasi" class="form-control" value="<?= $data['nama_prestasi']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nama Pemenang (Siswa/Tim)</label>
                                        <input type="text" name="pemenang" class="form-control" value="<?= $data['pemenang']; ?>" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Tahun</label>
                                            <input type="number" name="tahun" class="form-control" value="<?= $data['tahun']; ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Tingkat</label>
                                            <select name="tingkat" class="form-select" required>
                                                <option value="Kecamatan" <?= $data['tingkat'] == 'Kecamatan' ? 'selected' : ''; ?>>Kecamatan</option>
                                                <option value="Kabupaten" <?= $data['tingkat'] == 'Kabupaten' ? 'selected' : ''; ?>>Kabupaten</option>
                                                <option value="Provinsi" <?= $data['tingkat'] == 'Provinsi' ? 'selected' : ''; ?>>Provinsi</option>
                                                <option value="Nasional" <?= $data['tingkat'] == 'Nasional' ? 'selected' : ''; ?>>Nasional</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Gambar Saat Ini</label><br>
                                        <img src="../../../assets/img/prestasi/<?= $data['gambar']; ?>" width="150" class="rounded shadow-sm mb-2">
                                        <input type="file" name="gambar" class="form-control" accept="image/*">
                                        <small class="text-muted">*Kosongkan jika tidak ingin mengganti gambar.</small>
                                    </div>
                                    <div class="mt-4 border-top pt-3 text-end">
                                        <a href="index.php" class="btn btn-secondary px-4 me-2">Batal</a>
                                        <button type="submit" class="btn btn-primary px-4 shadow-sm">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>