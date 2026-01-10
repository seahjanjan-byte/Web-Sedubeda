<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../../login.php"); exit; }
include_once '../../../config/config.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM galeri WHERE id_galeri = '$id'");
$d = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Galeri - Admin</title>
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
                <h4 class="fw-bold m-0">Edit Galeri Kegiatan</h4>
            </nav>

            <div class="container-fluid p-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form action="proses.php?aksi=edit" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_galeri" value="<?= $d['id_galeri']; ?>">
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Judul Kegiatan</label>
                                <input type="text" name="judul" class="form-control" value="<?= $d['judul']; ?>" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Tanggal Kegiatan</label>
                                    <input type="date" name="tanggal" class="form-control" value="<?= $d['tanggal']; ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Ganti Cover (Biarkan kosong jika tidak ganti)</label>
                                    <input type="file" name="gambar" class="form-control" accept="image/*">
                                    <div class="mt-2">
                                        <small class="text-muted d-block mb-1">Cover saat ini:</small>
                                        <img src="../../../assets/img/galeri/<?= $d['gambar']; ?>" width="100" class="rounded border">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold">Link Google Drive</label>
                                <input type="url" name="link_gdrive" class="form-control" value="<?= $d['link_gdrive']; ?>">
                            </div>
                            <div class="border-top pt-3 text-end">
                                <a href="index.php" class="btn btn-secondary px-4 me-2 rounded-pill">Batal</a>
                                <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">Update Galeri</button>
                            </div>
                        </form>
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