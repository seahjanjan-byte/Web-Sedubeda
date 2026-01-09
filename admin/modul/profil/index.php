<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../../login.php"); exit; }
include_once '../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Profil - Admin SDN 02</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body style="background-color: #f8f9fa;">
    <div class="d-flex" id="wrapper">
        <?php include '../../sidebar.php'; ?>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3 px-4">
                <button class="btn btn-primary d-md-none me-3" id="sidebarToggle" style="background-color: #1e3d59; border: none;">
                    <i class="fas fa-bars"></i>
                </button>
                <h4 class="fw-bold m-0">Pengaturan Profil Sekolah</h4>
            </nav>

            <div class="container-fluid p-4">
                <div class="card border-0 shadow-sm p-4">
                    <h5 class="fw-bold mb-4" style="color: #1e3d59;">Daftar Konten Profil</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Jenis Profil</th>
                                    <th>Keterangan Konten</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge bg-info p-2">Visi & Misi</span></td>
                                    <td class="small text-muted text-uppercase">Teks Statis</td>
                                    <td class="text-center">
                                        <a href="edit.php?jenis=visi_misi" class="btn btn-warning btn-sm text-white rounded-pill px-3">
                                            <i class="fas fa-edit me-1"></i> Kelola Isi
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-info p-2">Sejarah Sekolah</span></td>
                                    <td class="small text-muted text-uppercase">Teks Statis</td>
                                    <td class="text-center">
                                        <a href="edit.php?jenis=sejarah" class="btn btn-warning btn-sm text-white rounded-pill px-3">
                                            <i class="fas fa-edit me-1"></i> Kelola Isi
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-success p-2">Struktur Organisasi</span></td>
                                    <td class="small text-muted text-uppercase">File Gambar/Bagan</td>
                                    <td class="text-center">
                                        <a href="edit.php?jenis=struktur" class="btn btn-warning btn-sm text-white rounded-pill px-3">
                                            <i class="fas fa-project-diagram me-1"></i> Update Bagan
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelector('#sidebarToggle').addEventListener('click', () => {
            document.getElementById('wrapper').classList.toggle('toggled');
        });
    </script>
</body>
</html>