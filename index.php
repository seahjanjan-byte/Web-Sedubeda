<?php 
include 'includes/header.php'; 
?>

<div id="heroSlider" class="carousel slide shadow-sm" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php
        $querySlider = mysqli_query($koneksi, "SELECT * FROM slider ORDER BY id_slider DESC");
        $aktif = "active";
        if (mysqli_num_rows($querySlider) > 0) {
            while ($row = mysqli_fetch_assoc($querySlider)) {
                ?>
                <div class="carousel-item <?= $aktif; ?>" data-bs-interval="3000">
                    <img src="<?= $base_url; ?>assets/img/slider/<?= $row['gambar']; ?>" class="d-block w-100" alt="..." style="height: 500px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5); border-radius: 10px;">
                        <h5><?= $row['judul']; ?></h5>
                        <p><?= $row['deskripsi']; ?></p>
                    </div>
                </div>
                <?php
                $aktif = ""; // Hanya slide pertama yang pakai class 'active'
            }
        } else {
            // Placeholder jika database slider kosong
            echo '<div class="carousel-item active"><img src="https://via.placeholder.com/1200x500?text=Slider+Belum+Diisi" class="d-block w-100"></div>';
        }
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<section class="py-5 bg-white">
    <div class="container">
        <?php
        $querySambutan = mysqli_query($koneksi, "SELECT * FROM sambutan LIMIT 1");
        $data = mysqli_fetch_assoc($querySambutan);
        ?>
        <div class="row align-items-center">
            <div class="col-md-4 text-center mb-4 mb-md-0">
                <img src="<?= $base_url; ?>assets/img/<?= $data['foto']; ?>" class="img-fluid rounded-circle shadow" style="width: 250px; height: 250px; object-fit: cover;" alt="Foto Kepala Sekolah">
            </div>
            <div class="col-md-8">
                <h2 class="fw-bold mb-3">Sambutan Kepala Sekolah</h2>
                <hr class="mb-4" style="width: 100px; height: 3px; background: #0d6efd;">
                <p class="lead italic text-muted">"<?= $data['isi_sambutan']; ?>"</p>
                <h5 class="fw-bold mt-4"><?= $data['nama_kepsek']; ?></h5>
                <small class="text-secondary">Kepala Sekolah SDN Dukuhbenda 02</small>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Berita Terbaru</h2>
            <div class="mx-auto" style="width: 80px; height: 3px; background: #0d6efd;"></div>
        </div>

        <div class="row">
            <?php
            // Tetap ambil 3 berita terbaru
            $queryBerita = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY tanggal DESC LIMIT 3");
            
            if (mysqli_num_rows($queryBerita) > 0) {
                while ($b = mysqli_fetch_assoc($queryBerita)) {
                    $cuplikan = substr(strip_tags($b['isi']), 0, 100) . "...";
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="<?= $base_url; ?>assets/img/berita/<?= $b['gambar']; ?>" class="card-img-top" alt="<?= $b['judul']; ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($b['tanggal'])); ?></small>
                            <h5 class="card-title fw-bold mt-2"><?= $b['judul']; ?></h5>
                            <p class="card-text text-secondary"><?= $cuplikan; ?></p>
                        </div>
                        <div class="card-footer bg-white border-0 pb-3">
                            <a href="<?= $base_url; ?>pages/detail-berita.php?slug=<?= $b['slug']; ?>" class="btn btn-outline-primary btn-sm w-100">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            <?php 
                } 
            } else {
                echo "<div class='col-12 text-center'><p class='text-muted'>Belum ada berita terbaru.</p></div>";
            }
            ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="<?= $base_url; ?>pages/berita.php" class="btn btn-primary px-5 shadow-sm">Lihat Semua Berita</a>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Hubungi Kami</h2>
            <div class="mx-auto" style="width: 80px; height: 3px; background: #0d6efd;"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-4">
                    <h4 class="fw-bold mb-4">Kirim Pesan</h4>
                    <form action="<?= $base_url; ?>functions/proses-kontak.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama Anda" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat Email</label>
                            <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subjek</label>
                            <input type="text" name="subjek" class="form-control" placeholder="Contoh: Tanya PPDB" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pesan</label>
                            <textarea name="isi_pesan" class="form-control" rows="4" placeholder="Tuliskan pesan Anda di sini..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Kirim Pesan Sekarang</button>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-4 h-100">
                    <h4 class="fw-bold mb-3">Informasi Sekolah</h4>
                    <p class="text-muted mb-4">
                        <i class="fas fa-map-marker-alt text-primary me-2"></i> 
                        Jl. Raya Dukuhbenda, Kec. Bumijawa, Kab. Tegal, Jawa Tengah.
                    </p>
                    
                    <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.3!2d109.1!3d-7.2!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMTInMDAuMCJTIDEwOcKwMDYnMDAuMCJF!5e0!3m2!1sid!2sid!4v1700000000000" 
                            style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>

                    <div class="mt-4">
                        <p class="mb-1"><strong>Kontak:</strong></p>
                        <p class="text-muted"><i class="fas fa-phone me-2"></i> (0283) 123456</p>
                        <p class="text-muted"><i class="fas fa-envelope me-2"></i> info@sdndukuhbenda02.sch.id</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
function toggleVisitor() {
    const box = document.getElementById('visitor-box');
    const icon = document.getElementById('visitor-icon');
    
    box.classList.toggle('minimized');
    
    if (box.classList.contains('minimized')) {
        icon.classList.remove('fa-minus');
        icon.classList.add('fa-users'); // Icon berubah jadi orang saat kecil
    } else {
        icon.classList.remove('fa-users');
        icon.classList.add('fa-minus');
    }
}
</script>
<?php 
// Khusus untuk file di folder utama (index.php), gunakan path langsung
include_once 'includes/footer.php'; 
?>
</body>
</html>