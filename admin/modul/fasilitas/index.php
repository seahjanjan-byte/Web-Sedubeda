<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../../login.php"); exit; }
include_once '../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Fasilitas - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body style="background-color: #f8f9fa;">
    <div class="d-flex" id="wrapper">
        <?php include '../../sidebar.php'; ?>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3 px-4">
                <h4 class="fw-bold m-0">Fasilitas Sekolah</h4>
            </nav>
            <div class="container-fluid p-4">
                <div class="card border-0 shadow-sm p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold m-0">Daftar Fasilitas</h5>
                        <a href="tambah.php" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">+ Tambah Fasilitas</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Gambar</th>
                                    <th>Nama Fasilitas</th>
                                    <th class="text-center" width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $q = mysqli_query($koneksi, "SELECT * FROM fasilitas ORDER BY id_fasilitas DESC");
                                if (mysqli_num_rows($q) > 0) {
                                    while($f = mysqli_fetch_assoc($q)) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td>
                                                <img src="../../../assets/img/fasilitas/<?= $f['gambar']; ?>" 
                                                     width="80" class="rounded shadow-sm">
                                            </td>
                                            <td class="fw-semibold"><?= $f['nama_fasilitas']; ?></td>
                                            <td class="text-center">
                                                <a href="edit.php?id=<?= $f['id_fasilitas']; ?>" class="btn btn-warning btn-sm text-white mx-1 shadow-sm" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="proses.php?aksi=hapus&id=<?= $f['id_fasilitas']; ?>" 
                                                   class="btn btn-danger btn-sm mx-1 shadow-sm" 
                                                   title="Hapus"
                                                   onclick="return confirm('Yakin ingin menghapus fasilitas ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } 
                                } else { ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">Belum ada data fasilitas.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>