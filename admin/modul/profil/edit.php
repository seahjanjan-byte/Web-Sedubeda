<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../../login.php"); exit; }

// Pastikan include config berada di paling atas agar $koneksi dikenal
include_once '../../../config/config.php'; 

$jenis = $_GET['jenis'];
$query = mysqli_query($koneksi, "SELECT * FROM profil WHERE jenis = '$jenis'");
$d = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan
if (!$d) { echo "<script>window.location='index.php';</script>"; exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil - Admin SDN 02</title>
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
                <h4 class="fw-bold m-0">Kelola <?= ucwords(str_replace('_', ' ', $jenis)); ?></h4>
            </nav>

            <div class="container-fluid p-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form action="proses.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="jenis" value="<?= $jenis; ?>">

                            <?php if ($jenis == 'struktur') : ?>
                                <div class="mb-4 text-center">
                                    <label class="form-label d-block fw-bold mb-3">Bagan Struktur Saat Ini</label>
                                    <img src="../../../assets/img/<?= $d['gambar']; ?>" class="img-fluid rounded border p-2 mb-3" style="max-height: 300px;">
                                    <input type="file" name="gambar" class="form-control" accept="image/*" required>
                                    <small class="text-muted fst-italic">*Pilih file gambar baru untuk mengganti bagan.</small>
                                </div>
                            <?php else : ?>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Konten Teks</label>
                                    <textarea name="konten" class="form-control" rows="12" required><?= $d['konten']; ?></textarea>
                                </div>
                            <?php endif; ?>

                            <div class="border-top pt-3 mt-4 text-end">
                                <a href="index.php" class="btn btn-secondary px-4 me-2 rounded-pill">
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
    <script>
        document.querySelector('#sidebarToggle').addEventListener('click', () => {
            document.getElementById('wrapper').classList.toggle('toggled');
        });
    </script>
</body>
</html>