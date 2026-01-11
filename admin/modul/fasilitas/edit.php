<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../../login.php"); exit; }
include_once '../../../config/config.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM fasilitas WHERE id_fasilitas = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) { header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Fasilitas - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <style>
        /* Custom style untuk menyamakan dengan form Galeri */
        .card-custom {
            background-color: #fdfaf3; /* Warna krem sesuai gambar */
            border-radius: 15px;
        }
        .btn-update {
            background-color: #2c3e50; /* Warna biru gelap sesuai tombol Update Galeri */
            color: white;
            border-radius: 20px;
        }
        .btn-update:hover { color: white; opacity: 0.9; }
        .btn-batal {
            background-color: #bdc3c7;
            color: white;
            border-radius: 20px;
        }
    </style>
</head>
<body style="background-color: #f8f9fa;">
    <div class="d-flex" id="wrapper">
        <?php include '../../sidebar.php'; ?>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3 px-4">
                <h4 class="fw-bold m-0">Edit Fasilitas</h4>
            </nav>
            
            <div class="container-fluid p-4">
                <div class="card border-0 shadow-sm p-4 card-custom">
                    <form action="proses.php?aksi=edit" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_fasilitas" value="<?= $data['id_fasilitas']; ?>">

                        <div class="mb-4">
                            <label class="form-label fw-bold">Nama Fasilitas</label>
                            <input type="text" name="nama_fasilitas" class="form-control" 
                                   value="<?= $data['nama_fasilitas']; ?>" required>
                        </div>

                        <div class="row align-items-end">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Ganti Gambar Baru (Biarkan kosong jika tidak ganti)</label>
                                <input type="file" name="gambar" class="form-control">
                                <div class="form-text text-danger">*Kosongkan jika tidak ingin mengubah gambar.</div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold d-block">Gambar Saat Ini:</label>
                                <img src="../../../assets/img/fasilitas/<?= $data['gambar']; ?>" 
                                     width="150" class="img-thumbnail rounded shadow-sm">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="index.php" class="btn btn-batal px-4">Batal</a>
                            <button type="submit" class="btn btn-update px-4 shadow-sm">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>