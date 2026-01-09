<?php 
include '../includes/header.php'; 

// Ambil slug dari URL
if (isset($_GET['slug'])) {
    $slug = mysqli_real_escape_string($koneksi, $_GET['slug']);
    $query = mysqli_query($koneksi, "SELECT * FROM berita WHERE slug = '$slug'");
    $data = mysqli_fetch_assoc($query);

    // Jika berita tidak ditemukan
    if (!$data) {
        echo "<script>window.location='berita.php';</script>";
        exit;
    }
} else {
    header("Location: berita.php");
    exit;
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $base_url; ?>index.php">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="berita.php">Berita</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>

            <h1 class="fw-bold mb-3"><?= $data['judul']; ?></h1>
            <p class="text-muted"><i class="fas fa-calendar-alt me-2"></i> Dipublikasikan pada: <?= date('d F Y', strtotime($data['tanggal'])); ?></p>
            
            <hr>

            <img src="<?= $base_url; ?>assets/img/berita/<?= $data['gambar']; ?>" class="img-fluid rounded shadow-sm mb-4 w-100" style="max-height: 450px; object-fit: cover;">

            <div class="content lh-lg" style="text-align: justify; font-size: 1.1rem;">
                <?= nl2br($data['isi']); ?>
            </div>

            <div class="mt-5 pt-4 border-top">
                <a href="berita.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Berita</a>
            </div>
        </div>
    </div>
</div>

<footer class="py-4 bg-dark text-white text-center">
    <small>&copy; 2026 SDN Dukuhbenda 02</small>
</footer>
<?php 
// Mengambil footer secara dinamis
include_once dirname(__DIR__) . '/includes/footer.php'; 
?>
</body>
</html>