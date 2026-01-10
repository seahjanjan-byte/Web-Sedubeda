<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../../login.php"); exit; }
include_once '../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Slider - Admin</title>
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
                                <h5 class="fw-bold m-0" style="color: #1e3d59;">Tambah Slider Baru</h5>
                            </div>
                            <div class="card-body p-4">
                                <form action="proses.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Judul Slider (Muncul di atas gambar)</label>
                                        <input type="text" name="judul" class="form-control" placeholder="Contoh: Selamat Datang di SDN 02" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Deskripsi Singkat</label>
                                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Penjelasan singkat..."></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Pilih Gambar Slider</label>
                                        <input type="file" name="gambar" class="form-control" accept="image/*" required>
                                        <small class="text-muted">Disarankan ukuran 1200x500 pixel agar pas.</small>
                                    </div>
                                    <div class="mt-4 border-top pt-3 text-end">
                                        <a href="index.php" class="btn btn-secondary px-4 me-2 rounded-pill">Batal</a>
                                        <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">Simpan Slider</button>
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