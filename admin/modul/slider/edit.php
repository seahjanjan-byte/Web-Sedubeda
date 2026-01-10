<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../../login.php"); exit; }
include_once '../../../config/config.php';

// Ambil ID slider dari URL
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM slider WHERE id_slider = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Slider - Admin SDN 02</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body style="background-color: #f8f9fa;">
    <div class="d-flex" id="wrapper">
        <?php include '../../sidebar.php'; ?>
        <div id="page-content-wrapper" class="w-100">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3 px-4">
                <button class="btn btn-primary d-md-none me-3" id="sidebarToggle" style="background-color: #1e3d59; border: none;">
                    <i class="fas fa-bars"></i>
                </button>
                <h4 class="fw-bold m-0">Edit Slider Banner</h4>
            </nav>

            <div class="container-fluid p-4">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <form action="proses.php?aksi=edit" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id_slider" value="<?= $data['id_slider']; ?>">
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Judul Slider</label>
                                        <input type="text" name="judul" class="form-control" value="<?= $data['judul']; ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Deskripsi Singkat</label>
                                        <textarea name="deskripsi" class="form-control" rows="3" required><?= $data['deskripsi']; ?></textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Gambar Banner Saat Ini</label><br>
                                        <div class="p-2 border rounded bg-light d-inline-block mb-2">
                                            <img src="../../../assets/img/slider/<?= $data['gambar']; ?>" class="img-fluid rounded" style="max-height: 200px;">
                                        </div>
                                        <input type="file" name="gambar" class="form-control" accept="image/*">
                                        <small class="text-muted fst-italic">*Kosongkan jika tidak ingin mengganti gambar banner.</small>
                                    </div>

                                    <div class="border-top pt-3 text-end">
                                        <a href="index.php" class="btn btn-secondary px-4 me-2 rounded-pill">Batal</a>
                                        <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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