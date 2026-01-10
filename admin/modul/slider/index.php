<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../../login.php"); exit; }
include_once '../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Slider - Admin SDN 02</title>
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
                <h4 class="fw-bold m-0">Manajemen Slider Beranda</h4>
            </nav>

            <div class="container-fluid p-4">
                <div class="card border-0 shadow-sm p-4">
                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="fw-bold">Daftar Foto Slider</h5>
                        <a href="tambah.php" class="btn btn-primary btn-sm rounded-pill px-3">
                            <i class="fas fa-plus me-1"></i> Tambah Slider
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Preview</th>
                                    <th>Judul / Deskripsi</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $query = mysqli_query($koneksi, "SELECT * FROM slider ORDER BY id_slider DESC");
                                while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <img src="../../../assets/img/slider/<?= $row['gambar']; ?>" width="150" class="rounded shadow-sm">
                                    </td>
                                    <td>
                                        <div class="fw-bold"><?= $row['judul']; ?></div>
                                        <small class="text-muted"><?= $row['deskripsi']; ?></small>
                                    </td>
                                    <td class="text-center">
                                        <a href="edit.php?id=<?= $row['id_slider']; ?>" class="btn btn-warning btn-sm text-white rounded-pill px-3">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="proses.php?aksi=hapus&id=<?= $row['id_slider']; ?>" class="btn btn-danger btn-sm rounded-pill px-3" onclick="return confirm('Hapus slider ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('#sidebarToggle').addEventListener('click', () => {
            document.getElementById('wrapper').classList.toggle('toggled');
        });
    </script>
</body>
</html>