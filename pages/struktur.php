<?php include '../includes/header.php'; ?>
<div class="container py-5 text-center">
    <h2 class="fw-bold mb-4">Struktur Organisasi</h2>
    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM profil WHERE jenis = 'struktur'");
    $d = mysqli_fetch_assoc($query);
    ?>
    <div class="card border-0 shadow-sm p-3">
        <img src="<?= $base_url; ?>assets/img/<?= $d['gambar']; ?>" class="img-fluid rounded" alt="Bagan Struktur">
    </div>
</div>