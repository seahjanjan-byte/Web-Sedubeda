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
    <title>Admin Dashboard - SDN 02</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        #wrapper {
            overflow-x: hidden;
            background-color: #f8f9fa;
        }

        #sidebar-wrapper {
            min-height: 100vh;
            margin-left: -15rem;
            transition: margin .25s ease-out;
            width: 15rem;
        }

        #wrapper.toggled #sidebar-wrapper {
            margin-left: 0;
        }

        #page-content-wrapper {
            min-width: 100vw;
        }

        .list-group-item {
            border: none;
            padding: 20px 30px;
        }

        .list-group-item.active {
            background-color: transparent;
            color: #ff6e40;
        }

        @media (min-width: 768px) {
            #sidebar-wrapper {
                margin-left: 0;
            }

            #page-content-wrapper {
                min-width: 0;
                width: 100%;
            }
        }
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
                    <img src="../assets/img/logo.png" width="35" alt="Admin">
                </div>
            </nav>

            <div class="container-fluid px-4">
                <div class="row g-3 my-2">
                    <div class="col-md-4">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded border-start border-warning border-5">
                            <div>
                                <h3 class="fs-2"><?= $total_visitor; ?></h3>
                                <p class="fs-5">Total Pengunjung</p>
                            </div>
                            <i class="fas fa-eye fs-1 p-3 text-warning"></i>
                        </div>
                    </div>
                </div>

                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Selamat bekerja, <?= $_SESSION['admin_nama']; ?>!</h3>
                    <p class="text-muted">Gunakan menu di samping kiri untuk mengelola konten website sekolah.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script>
    // Pastikan DOM sudah dimuat
    window.addEventListener('DOMContentLoaded', event => {
        // Cari tombol dengan ID sidebarToggle
        const sidebarToggle = document.body.querySelector('#sidebarToggle');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', event => {
                event.preventDefault();
                // Tambah atau hapus class 'toggled' pada elemen #wrapper
                document.getElementById('wrapper').classList.toggle('toggled');
            });
        }
    });
</script>