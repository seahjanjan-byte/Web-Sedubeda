<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../../login.php"); exit; }

include_once '../../../config/config.php'; 

$jenis = $_GET['jenis'];
$query = mysqli_query($koneksi, "SELECT * FROM profil WHERE jenis = '$jenis'");
$d = mysqli_fetch_assoc($query);

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
                                </div>

                            <?php elseif ($jenis == 'visi_misi') : ?>
                                <?php 
                                    $data_vm = json_decode($d['konten'], true);
                                    $visi_array = $data_vm['visi'] ?? [];
                                    $misi_array = $data_vm['misi'] ?? [];
                                    if (!is_array($visi_array)) $visi_array = (empty($visi_array) ? [] : [$visi_array]);
                                    if (!is_array($misi_array)) $misi_array = (empty($misi_array) ? [] : [$misi_array]);
                                ?>
                                
                                <div class="mb-5">
                                    <label class="form-label fw-bold d-block text-primary">VISI SEKOLAH</label>
                                    <table class="table table-bordered align-middle">
                                        <thead class="table-light text-center">
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>Poin Visi</th>
                                                <th width="8%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="containerVisi">
                                            <?php if (empty($visi_array)) : ?>
                                                <tr>
                                                    <td class="text-center fw-bold row-num-visi">1</td>
                                                    <td><input type="text" name="visi[]" class="form-control" placeholder="Tulis poin visi..." required></td>
                                                    <td class="text-center">-</td>
                                                </tr>
                                            <?php else : ?>
                                                <?php foreach ($visi_array as $index => $v) : ?>
                                                    <tr>
                                                        <td class="text-center fw-bold row-num-visi"><?= $index + 1; ?></td>
                                                        <td><input type="text" name="visi[]" class="form-control" value="<?= htmlspecialchars($v); ?>" required></td>
                                                        <td class="text-center">
                                                            <?php if ($index > 0) : ?>
                                                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="hapusBaris(this, 'row-num-visi')"><i class="fas fa-trash"></i></button>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-primary btn-sm rounded-pill px-3" onclick="tambahBaris('containerVisi', 'visi[]', 'row-num-visi')">
                                        <i class="fas fa-plus me-1"></i> Tambah Poin Visi
                                    </button>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold d-block text-primary">MISI SEKOLAH</label>
                                    <table class="table table-bordered align-middle">
                                        <thead class="table-light text-center">
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>Poin Misi</th>
                                                <th width="8%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="containerMisi">
                                            <?php if (empty($misi_array)) : ?>
                                                <tr>
                                                    <td class="text-center fw-bold row-num-misi">1</td>
                                                    <td><input type="text" name="misi[]" class="form-control" placeholder="Tulis poin misi..." required></td>
                                                    <td class="text-center">-</td>
                                                </tr>
                                            <?php else : ?>
                                                <?php foreach ($misi_array as $index => $m) : ?>
                                                    <tr>
                                                        <td class="text-center fw-bold row-num-misi"><?= $index + 1; ?></td>
                                                        <td><input type="text" name="misi[]" class="form-control" value="<?= htmlspecialchars($m); ?>" required></td>
                                                        <td class="text-center">
                                                            <?php if ($index > 0) : ?>
                                                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="hapusBaris(this, 'row-num-misi')"><i class="fas fa-trash"></i></button>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-primary btn-sm rounded-pill px-3" onclick="tambahBaris('containerMisi', 'misi[]', 'row-num-misi')">
                                        <i class="fas fa-plus me-1"></i> Tambah Poin Misi
                                    </button>
                                </div>

                            <?php else : ?>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Konten Teks Sejarah</label>
                                    <textarea name="konten" class="form-control" rows="12" required><?= $d['konten']; ?></textarea>
                                </div>
                            <?php endif; ?>

                            <div class="border-top pt-3 mt-4 text-end">
                                <a href="index.php" class="btn btn-secondary px-4 me-2 rounded-pill">Batal</a>
                                <button type="submit" class="btn btn-success px-4 rounded-pill shadow-sm">Simpan Perubahan</button>
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

        // Fungsi Universal Tambah Baris
        function tambahBaris(containerId, inputName, labelClass) {
            const container = document.getElementById(containerId);
            const rowCount = container.rows.length;
            const row = container.insertRow();
            
            row.innerHTML = `
                <td class="text-center fw-bold ${labelClass}">${rowCount + 1}</td>
                <td><input type="text" name="${inputName}" class="form-control" required></td>
                <td class="text-center">
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="hapusBaris(this, '${labelClass}')"><i class="fas fa-trash"></i></button>
                </td>
            `;
        }

        // Fungsi Universal Hapus Baris
        function hapusBaris(btn, labelClass) {
            const row = btn.parentNode.parentNode;
            const container = row.parentNode;
            container.removeChild(row);
            
            // Re-index nomor urut
            const rows = container.querySelectorAll('.' + labelClass);
            rows.forEach((cell, index) => {
                cell.innerHTML = index + 1;
            });
        }
    </script>
</body>
</html>