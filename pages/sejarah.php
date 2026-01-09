<?php include '../includes/header.php'; ?>
<div class="container py-5">
    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM profil WHERE jenis = 'sejarah'");
    $d = mysqli_fetch_assoc($query);
    ?>
    <h2 class="fw-bold text-center mb-4">Sejarah</h2>
    <div class="card border-0 shadow-sm p-4">
        <div class="lh-lg"><?= nl2br($d['konten']); ?></div>
    </div>
</div>
<?php 
// Mengambil file footer dengan path yang aman
include_once dirname(__DIR__) . '/includes/footer.php'; 
?>