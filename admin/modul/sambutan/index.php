<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../../login.php"); exit; }
include_once '../../../config/config.php';

$query = mysqli_query($koneksi, "SELECT * FROM sambutan LIMIT 1");
$d = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Sambutan - Admin</title>
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
                        <div class="card border-0 shadow-sm p-4">
                            <h5 class="fw-bold mb-4" style="color: #1e3d59;">Edit Sambutan Kepala Sekolah</h5>
                            <form action="proses.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Nama Kepala Sekolah</label>
                                    <input type="text" name="nama_kepsek" class="form-control" value="<?= $d['nama_kepsek']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Isi Sambutan</label>
                                    <textarea name="isi_sambutan" class="form-control" rows="8" required><?= $d['isi_sambutan']; ?></textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Foto Kepala Sekolah</label><br>
                                    <img src="../../../assets/img/<?= $d['foto']; ?>" class="rounded-circle shadow-sm mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                                    <input type="file" name="foto" class="form-control">
                                    <small class="text-muted fst-italic">*Kosongkan jika tidak ingin mengganti foto.</small>
                                </div>
                                <div class="border-top pt-3 text-end">
                                    <a href="../../index.php" class="btn btn-secondary px-4 me-2 rounded-pill">Batal</a>
                                    <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>