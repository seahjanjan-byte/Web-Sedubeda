<?php
include 'includes/header.php';
?>

<div id="heroSlider" class="carousel slide shadow-sm">
    <div class="carousel-inner">
        <?php
        $querySlider = mysqli_query($koneksi, "SELECT * FROM slider ORDER BY id_slider DESC");
        $aktif = "active";
        if (mysqli_num_rows($querySlider) > 0) {
            while ($row = mysqli_fetch_assoc($querySlider)) {
        ?>
                <div class="carousel-item <?= $aktif; ?>" data-bs-interval="4000">
                    <div class="hero-overlay"></div>
                    <img src="<?= $base_url; ?>assets/img/slider/<?= $row['gambar']; ?>" class="d-block w-100 hero-img" alt="<?= $row['judul']; ?>">

                    <div class="carousel-caption d-block text-start pb-5">
                        <div class="container">
                            <h1 class="display-4 fw-bold mb-2 animate__animated animate__fadeInUp"><?= $row['judul']; ?></h1>
                            <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s"><?= $row['deskripsi']; ?></p>
                        </div>
                    </div>
                </div>
        <?php
                $aktif = ""; // Hanya slide pertama yang pakai class 'active'
            }
        } else {
            echo '<div class="carousel-item active"><img src="https://via.placeholder.com/1200x600?text=Slider+Belum+Diisi" class="d-block w-100 hero-img"></div>';
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

<section class="py-5 bg-white overflow-hidden">
    <div class="container">
        <?php
        $querySambutan = mysqli_query($koneksi, "SELECT * FROM sambutan LIMIT 1");
        $data = mysqli_fetch_assoc($querySambutan);
        ?>
        <div class="row align-items-center">
            <div class="col-md-4 text-center mb-4 mb-md-0" data-aos="fade-right">
                <img src="<?= $base_url; ?>assets/img/<?= $data['foto']; ?>" class="img-fluid rounded-circle shadow-lg border border-5 border-white" style="width: 280px; height: 280px; object-fit: cover;" alt="Foto Kepala Sekolah">
            </div>
            <div class="col-md-8" data-aos="fade-left">
                <h2 class="fw-bold mb-3" style="color: #1e3d59;">Sambutan Kepala Sekolah</h2>
                <div style="width: 80px; height: 4px; background: #ff6e40;" class="mb-4"></div>
                <p class="lead fst-italic text-muted">"<?= $data['isi_sambutan']; ?>"</p>
                <h5 class="fw-bold mt-4 mb-0"><?= $data['nama_kepsek']; ?></h5>
                <small class="text-secondary text-uppercase tracking-wider">Kepala Sekolah SDN Dukuhbenda 02</small>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold">Berita Terbaru</h2>
            <div class="mx-auto" style="width: 80px; height: 3px; background: #0d6efd;"></div>
        </div>

        <div class="row">
            <?php
            $queryBerita = mysqli_query($koneksi, "SELECT * FROM berita WHERE status = 'tampil' ORDER BY tanggal DESC LIMIT 3");

            if (mysqli_num_rows($queryBerita) > 0) {
                while ($b = mysqli_fetch_assoc($queryBerita)) {
                    $cuplikan = substr(strip_tags($b['isi']), 0, 100) . "...";
            ?>
                    <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="100">
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

        <div class="text-center mt-4" data-aos="fade-up">
            <a href="<?= $base_url; ?>pages/berita.php" class="btn btn-primary px-5 shadow-sm">Lihat Semua Berita</a>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold">Hubungi Kami</h2>
            <div class="mx-auto" style="width: 80px; height: 3px; background: #0d6efd;"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-6" data-aos="fade-right">
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
                            <label class="form-label">Nomor Telepon/WA</label>
                            <input type="text" name="telepon" class="form-control" placeholder="08xxxxxxxxxx" required>
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

            <div class="col-md-6" data-aos="fade-left">
                <div class="card border-0 shadow-sm p-4 h-100">
                    <h4 class="fw-bold mb-3">Informasi Sekolah</h4>
                    <p class="text-muted mb-4">
                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                        Jl. Raya Dukuhbenda, Kec. Bumijawa, Kab. Tegal, Jawa Tengah.
                    </p>

                    <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15835.454238713063!2d109.1352424!3d-7.1418725!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f962885994f8b%3A0xc3921e49463e6e8c!2sSD%20Negeri%20Dukuhbenda%2002!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
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

<?php
include_once 'includes/footer.php';
?>