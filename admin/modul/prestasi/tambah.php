<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../../login.php"); exit; }
include_once '../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Prestasi - Admin</title>
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
                                <h5 class="fw-bold m-0" style="color: #1e3d59;">Tambah Data Prestasi</h5>
                            </div>
                            <div class="card-body p-4">
                                <form action="proses.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nama Prestasi / Lomba</label>
                                        <input type="text" name="nama_prestasi" class="form-control" placeholder="Contoh: Juara 1 Lomba Mewarnai" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nama Pemenang (Siswa/Regu)</label>
                                        <input type="text" name="pemenang" class="form-control" placeholder="Nama siswa atau tim" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Tahun</label>
                                            <input type="number" name="tahun" class="form-control" value="<?= date('Y'); ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Tingkat</label>
                                            <select name="tingkat" class="form-select" required>
                                                <option value="Kecamatan">Kecamatan</option>
                                                <option value="Kabupaten">Kabupaten</option>
                                                <option value="Provinsi">Provinsi</option>
                                                <option value="Nasional">Nasional</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Foto Dokumentasi</label>
                                        <input type="file" name="gambar" class="form-control" accept="image/*" required>
                                    </div>
                                    <div class="mt-4 border-top pt-3 text-end">
                                        <a href="index.php" class="btn btn-secondary px-4 me-2">Batal</a>
                                        <button type="submit" class="btn btn-primary px-4 shadow-sm">Simpan Prestasi</button>
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