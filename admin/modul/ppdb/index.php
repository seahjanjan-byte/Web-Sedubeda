<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../../login.php"); exit; }
include_once '../../../config/config.php';
$d = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM ppdb LIMIT 1"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Update PPDB - Admin SDN 02</title>
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
                <h4 class="fw-bold m-0">Kelola Informasi PPDB</h4>
            </nav>

            <div class="container-fluid p-4">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card border-0 shadow-sm p-4">
                            <h5 class="fw-bold mb-4" style="color: #1e3d59;">Update Brosur Pendaftaran</h5>
                            <form action="proses.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-4 text-center">
                                    <label class="form-label d-block fw-bold mb-3 text-muted">Pratinjau Brosur Saat Ini</label>
                                    <div class="p-2 border rounded bg-light d-inline-block">
                                        <img src="../../../assets/img/<?= $d['brosur']; ?>" class="img-fluid rounded shadow-sm" style="max-height: 350px;">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Pilih File Brosur Baru (JPG/PNG)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i class="fas fa-file-image"></i></span>
                                        <input type="file" name="brosur" class="form-control" required>
                                    </div>
                                    <small class="text-muted fst-italic">*Pastikan gambar beresolusi tinggi agar tulisan terbaca jelas.</small>
                                </div>
                                <div class="border-top pt-4 text-end">
                                    <a href="../../index.php" class="btn btn-secondary px-4 me-2 rounded-pill">
                                        <i class="fas fa-times me-1"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">
                                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
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