<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../../login.php"); exit; }
include_once '../../../config/config.php';

// Ambil ID dari URL
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM berita WHERE id_berita = '$id'");
$data = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan
if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Berita - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body style="background-color: #f8f9fa;">
    <div class="d-flex" id="wrapper">
        <?php include '../../sidebar.php'; ?>
        <div id="page-content-wrapper" class="w-100">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white py-3">
                                <h5 class="fw-bold m-0" style="color: #1e3d59;">Edit Berita</h5>
                            </div>
                            <div class="card-body p-4">
                                <form action="proses.php?aksi=edit" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id_berita" value="<?= $data['id_berita']; ?>">
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Judul Berita</label>
                                        <input type="text" name="judul" class="form-control" value="<?= $data['judul']; ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Isi Berita</label>
                                        <textarea name="isi" class="form-control" rows="10" required><?= $data['isi']; ?></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Tanggal Berita</label>
                                            <input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal']; ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Gambar Saat Ini</label><br>
                                            <img src="../../../assets/img/berita/<?= $data['gambar']; ?>" width="150" class="rounded mb-2 shadow-sm">
                                            <input type="file" name="gambar" class="form-control" accept="image/*">
                                            <small class="text-muted">*Kosongkan jika tidak ingin mengganti gambar</small>
                                        </div>
                                    </div>

                                    <div class="mt-4 border-top pt-3">
                                        <button type="submit" class="btn btn-primary px-4 shadow-sm">Simpan Perubahan</button>
                                        <a href="index.php" class="btn btn-secondary px-4">Batal</a>
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