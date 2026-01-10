<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../../login.php");
    exit;
}
include_once '../../../config/config.php';

// Ambil status filter (tampil/arsip)
$view = $_GET['view'] ?? 'tampil';
$status_arsip = ($view == 'arsip') ? 1 : 0;

$query = mysqli_query($koneksi, "SELECT * FROM pesan WHERE status_arsip = $status_arsip ORDER BY status_pin DESC, tanggal_kirim DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pesan Masuk - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>

<body style="background-color: #f8f9fa;">
    <div class="d-flex" id="wrapper">
        <?php include '../../sidebar.php'; ?>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3 px-4">
                <button class="btn btn-primary d-md-none me-3" id="sidebarToggle"><i class="fas fa-bars"></i></button>
                <h4 class="fw-bold m-0">Manajemen Pesan Pengunjung</h4>
            </nav>

            <div class="container-fluid p-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-4">
                            <div class="btn-group rounded-pill overflow-hidden border">
                                <a href="index.php?view=tampil" class="btn btn-sm <?= $view == 'tampil' ? 'btn-primary' : 'btn-light'; ?>">Kotak Masuk</a>
                                <a href="index.php?view=arsip" class="btn btn-sm <?= $view == 'arsip' ? 'btn-primary' : 'btn-light'; ?>">Arsip</a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Status</th>
                                        <th>Pengirim</th>
                                        <th>Subjek</th>
                                        <th>Tanggal</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                                        <tr class="<?= $row['status_pin'] ? 'table-warning' : ''; ?>">
                                            <td class="text-center">
                                                <?php if ($row['status_pin']): ?>
                                                    <i class="fas fa-thumbtack text-danger"></i>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="fw-bold"><?= $row['nama']; ?></div>
                                                <small class="text-muted"><?= $row['telepon']; ?></small>
                                            </td>
                                            <td><?= $row['subjek']; ?></td>
                                            <td class="small"><?= date('d/m/Y H:i', strtotime($row['tanggal_kirim'])); ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-info btn-sm text-white rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalBaca<?= $row['id_pesan']; ?>">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <a href="proses.php?aksi=pin&id=<?= $row['id_pesan']; ?>&set=<?= $row['status_pin'] ? 0 : 1; ?>" class="btn btn-sm <?= $row['status_pin'] ? 'btn-danger' : 'btn-outline-danger'; ?> rounded-pill">
                                                    <i class="fas fa-thumbtack"></i>
                                                </a>
                                                <a href="proses.php?aksi=arsip&id=<?= $row['id_pesan']; ?>&set=<?= $row['status_arsip'] ? 0 : 1; ?>" class="btn btn-outline-secondary btn-sm rounded-pill">
                                                    <i class="fas <?= $row['status_arsip'] ? 'fa-box-open' : 'fa-archive'; ?>"></i>
                                                </a>
                                                <a href="proses.php?aksi=hapus&id=<?= $row['id_pesan']; ?>" class="btn btn-outline-dark btn-sm rounded-pill" onclick="return confirm('Hapus pesan ini permanen?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modalBaca<?= $row['id_pesan']; ?>" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 shadow">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title">Detail Pesan Masuk</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <p><strong>Dari:</strong> <?= $row['nama']; ?> (<?= $row['email']; ?>)</p>
                                                        <p><strong>Telepon:</strong>
                                                            <?php if (!empty($row['telepon'])) : ?>
                                                                <a href="https://wa.me/<?= str_replace(['+', ' ', '-'], '', $row['telepon']); ?>" target="_blank">
                                                                    <?= $row['telepon']; ?> <i class="fab fa-whatsapp text-success"></i>
                                                                </a>
                                                            <?php else : ?>
                                                                <span class="text-muted fst-italic">Tidak mencantumkan nomor</span>
                                                            <?php endif; ?>
                                                        </p>
                                                        <p><strong>Subjek:</strong> <?= $row['subjek']; ?></p>
                                                        <hr>
                                                        <p class="mb-0"><strong>Isi Pesan:</strong></p>
                                                        <p class="bg-light p-3 rounded mt-2" style="white-space: pre-line;"><?= $row['isi_pesan']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>