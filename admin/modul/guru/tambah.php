<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../../login.php"); exit; }
include_once '../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Guru - Admin</title>
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
                                <h5 class="fw-bold m-0" style="color: #1e3d59;">Tambah Data Guru</h5>
                            </div>
                            <div class="card-body p-4">
                                <form action="proses.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nama Lengkap & Gelar</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Contoh: Ahmad, S.Pd." required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Jabatan</label>
                                        <input type="text" name="jabatan" class="form-control" placeholder="Contoh: Guru Kelas IV" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Foto Guru</label>
                                        <input type="file" name="foto" class="form-control" accept="image/*" required>
                                        <small class="text-muted">Gunakan foto dengan rasio 1:1 agar tampilan maksimal.</small>
                                    </div>
                                    <div class="mt-4 border-top pt-3 text-end">
                                        <a href="index.php" class="btn btn-secondary px-4 me-2">Batal</a>
                                        <button type="submit" class="btn btn-primary px-4 shadow-sm">Simpan Data</button>
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