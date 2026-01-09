<?php include '../includes/header.php'; ?>
<div class="container py-5">
    <h2 class="fw-bold text-center mb-4">Informasi PPDB</h2>
    <p class="text-center text-muted mb-5">Silakan unduh atau pelajari brosur pendaftaran siswa baru di bawah ini.</p>
    
    <?php
    $q = mysqli_query($koneksi, "SELECT * FROM ppdb LIMIT 1");
    $d = mysqli_fetch_assoc($q);
    ?>
    
    <div class="text-center">
        <img src="<?= $base_url; ?>assets/img/<?= $d['brosur']; ?>" class="img-fluid shadow rounded mb-4" style="max-width: 800px;">
        <br>
        <a href="<?= $base_url; ?>assets/img/<?= $d['brosur']; ?>" class="btn btn-primary btn-lg" download>
            <i class="fas fa-download me-2"></i> Download Brosur (PDF/JPG)
        </a>
    </div>
</div>
<?php 
// Mengambil footer secara dinamis
include_once dirname(__DIR__) . '/includes/footer.php'; 
?>
