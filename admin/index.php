<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
include_once '../config/config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SDN Dukuhbenda 02</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="d-flex" id="wrapper">
    <div class="border-end" id="sidebar-wrapper">
        <div class="sidebar-heading border-bottom">
            <i class="fas fa-school me-2"></i> SEDUBEDA
        </div>
        <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action active" href="index.php">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
            <a class="list-group-item list-group-item-action" href="modul/berita/index.php">
                <i class="fas fa-newspaper me-2"></i> Kelola Berita
            </a>
            <a class="list-group-item list-group-item-action" href="modul/guru/index.php">
                <i class="fas fa-users me-2"></i> Data Guru
            </a>
            <a class="list-group-item list-group-item-action" href="modul/prestasi/index.php">
                <i class="fas fa-trophy me-2"></i> Prestasi
            </a>
            <a class="list-group-item list-group-item-action" href="modul/galeri/index.php">
                <i class="fas fa-images me-2"></i> Galeri Foto
            </a>
            <a class="list-group-item list-group-item-action mt-5 text-danger" href="logout.php">
                <i class="fas fa-sign-out-alt me-2"></i> Keluar
            </a>
        </div>
    </div>

    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3 px-4">
            <span class="navbar-text fw-bold">Panel Kendali Website</span>
            <div class="ms-auto d-flex align-items-center">
                <span class="me-3 small text-muted">Halo, <?= $_SESSION['admin_nama']; ?></span>
                <img src="../assets/img/logo.png" width="35" alt="Admin">
            </div>
        </nav>

        <div class="container-fluid p-4">
            <h2 class="fw-bold mb-4" style="color: #1e3d59;">Dashboard Overview</h2>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-3" style="border-left: 5px solid #ff6e40 !important;">
                        <div class="d-flex align-items-center">
                            <div class="p-3 rounded-circle bg-light text-warning me-3">
                                <i class="fas fa-eye fa-2x"></i>
                            </div>
                            <div>
                                <p class="text-muted small mb-0">Total Kunjungan</p>
                                <h3 class="fw-bold mb-0"><?= $total_visitor; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-3" style="border-left: 5px solid #1e3d59 !important;">
                        <div class="d-flex align-items-center">
                            <div class="p-3 rounded-circle bg-light text-primary me-3">
                                <i class="fas fa-newspaper fa-2x"></i>
                            </div>
                            <div>
                                <p class="text-muted small mb-0">Berita Dipublish</p>
                                <h3 class="fw-bold mb-0">0</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5 p-5 bg-white rounded-4 shadow-sm text-center">
                <img src="../assets/img/logo.png" width="100" class="mb-3 opacity-50">
                <h4 class="text-muted">Selamat Bekerja, Administrator!</h4>
                <p class="text-secondary small">Gunakan menu di samping kiri untuk mulai mengelola konten website.</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>