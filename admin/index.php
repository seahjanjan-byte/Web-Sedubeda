<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
include_once '../config/config.php';

// MODIFIKASI: Ambil jumlah pesan baru (Hanya yang BELUM DIBACA dan BELUM DIARSIP)
$q_pesan_baru = mysqli_query($koneksi, "SELECT id_pesan FROM pesan WHERE status_baca = 0 AND status_arsip = 0");
$total_pesan_baru = mysqli_num_rows($q_pesan_baru);

// Ambil 5 pesan terbaru untuk ditampilkan di tabel dashboard
$latest_messages = mysqli_query($koneksi, "SELECT * FROM pesan ORDER BY tanggal_kirim DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SDN 02</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        #wrapper { overflow-x: hidden; background-color: #f8f9fa; }
        #sidebar-wrapper { min-height: 100vh; margin-left: -15rem; transition: margin .25s ease-out; width: 15rem; }
        #wrapper.toggled #sidebar-wrapper { margin-left: 0; }
        #page-content-wrapper { min-width: 100vw; }
        .list-group-item { border: none; padding: 20px 30px; }
        @media (min-width: 768px) {
            #sidebar-wrapper { margin-left: 0; }
            #page-content-wrapper { min-width: 0; width: 100%; }
        }
        .stat-card { transition: transform 0.3s; cursor: pointer; }
        .stat-card:hover { transform: translateY(-5px); }
        .badge-new { font-size: 0.7rem; padding: 5px 10px; }
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <?php include 'sidebar.php'; ?>

        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3 px-4">
                <button class="btn btn-primary d-md-none me-3" id="sidebarToggle" style="background-color: #1e3d59; border: none;">
                    <i class="fas fa-bars"></i>
                </button>
                <span class="navbar-text fw-bold">Panel Kendali Website</span>
                <div class="ms-auto d-flex align-items-center">
                    <span class="me-3 small text-muted d-none d-md-block">Halo, <?= $_SESSION['admin_nama']; ?></span>
                    <img src="../assets/img/logo_tel.png" width="35" alt="Admin">
                </div>
            </nav>

            <div class="container-fluid px-4">
                <div class="row g-3 my-2">
                    <div class="col-md-6 col-lg-4">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded border-start border-warning border-5 stat-card">
                            <div>
                                <h3 class="fs-2"><?= isset($total_visitor) ? $total_visitor : '0'; ?></h3>
                                <p class="fs-5 mb-0 text-muted">Total Pengunjung</p>
                            </div>
                            <i class="fas fa-eye fs-1 p-3 text-warning"></i>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4" onclick="window.location='modul/pesan/index.php'">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded border-start border-danger border-5 stat-card">
                            <div>
                                <h3 class="fs-2"><?= $total_pesan_baru; ?></h3>
                                <p class="fs-5 mb-0 text-muted">Pesan Baru</p>
                            </div>
                            <i class="fas fa-envelope-open-text fs-1 p-3 text-danger"></i>
                        </div>
                    </div>
                </div>

                <div class="row my-4">
                    <div class="col">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white py-3">
                                <h5 class="m-0 fw-bold text-primary"><i class="fas fa-history me-2"></i> Pesan Masuk Terbaru</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Pengirim</th>
                                                <th>Subjek</th>
                                                <th>Waktu</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(mysqli_num_rows($latest_messages) > 0) : ?>
                                                <?php while($msg = mysqli_fetch_assoc($latest_messages)) : ?>
                                                <tr style="cursor: pointer;" onclick="window.location='modul/pesan/index.php'">
                                                    <td>
                                                        <div class="fw-bold"><?= htmlspecialchars($msg['nama']); ?></div>
                                                        <small class="text-muted"><?= htmlspecialchars($msg['telepon']); ?></small>
                                                    </td>
                                                    <td><?= htmlspecialchars($msg['subjek']); ?></td>
                                                    <td class="small"><?= date('d/m H:i', strtotime($msg['tanggal_kirim'])); ?></td>
                                                    <td class="text-center">
                                                        <?php if($msg['status_baca'] == 0) : ?>
                                                            <span class="badge bg-danger rounded-pill badge-new">BARU</span>
                                                        <?php else : ?>
                                                            <span class="badge bg-light text-muted border rounded-pill badge-new">DIBACA</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <?php endwhile; ?>
                                            <?php else : ?>
                                                <tr><td colspan="4" class="text-center py-3 text-muted italic">Belum ada pesan masuk.</td></tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-end mt-2">
                                    <a href="modul/pesan/index.php" class="btn btn-sm btn-link text-decoration-none p-0">Buka Kotak Masuk <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col">
                        <h3 class="fs-4 mb-2">Selamat bekerja, <?= $_SESSION['admin_nama']; ?>!</h3>
                        <p class="text-muted">Gunakan menu di samping kiri untuk mengelola konten website sekolah.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            const sidebarToggle = document.body.querySelector('#sidebarToggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.getElementById('wrapper').classList.toggle('toggled');
                });
            }
        });
    </script>
</body>
</html>