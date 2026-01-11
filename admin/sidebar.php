<?php
// Pastikan variabel $koneksi tersedia (biasanya diinclude di file utama yang memanggil sidebar)
// Hitung jumlah pesan masuk yang belum diarsip (status_arsip = 0)
$query_notif = mysqli_query($koneksi, "SELECT id_pesan FROM pesan WHERE status_arsip = 0 AND status_baca = 0");
$jml_pesan_baru = mysqli_num_rows($query_notif);
?>
<div class="border-end" id="sidebar-wrapper" style="background-color: #1e3d59;">
    <div class="sidebar-heading border-bottom text-white py-4 px-3 fw-bold">
        <i class="fas fa-school me-2"></i> SEDUBEDA
    </div>
    <div class="list-group list-group-flush">
        <a class="list-group-item list-group-item-action py-3 text-white bg-transparent border-0" href="<?= $base_url; ?>admin/index.php">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </a>
        <a class="list-group-item list-group-item-action py-3 text-white bg-transparent border-0" href="<?= $base_url; ?>admin/modul/berita/index.php">
            <i class="fas fa-newspaper me-2"></i> Kelola Berita
        </a>
        <a class="list-group-item list-group-item-action py-3 text-white bg-transparent border-0" href="<?= $base_url; ?>admin/modul/guru/index.php">
            <i class="fas fa-users me-2"></i> Data Guru
        </a>
        <a class="list-group-item list-group-item-action py-3 text-white bg-transparent border-0" href="<?= $base_url; ?>admin/modul/prestasi/index.php">
            <i class="fas fa-trophy me-2"></i> Prestasi
        </a>
        <a class="list-group-item list-group-item-action py-3 text-white bg-transparent border-0" href="<?= $base_url; ?>admin/modul/galeri/index.php">
            <i class="fas fa-images me-2"></i> Galeri Foto
        </a>

        <a class="list-group-item list-group-item-action py-3 text-white bg-transparent border-0" href="<?= $base_url; ?>admin/modul/fasilitas/index.php">
            <i class="fas fa-building me-2"></i> Kelola Fasilitas
        </a>
        <a class="list-group-item list-group-item-action py-3 text-white bg-transparent border-0" href="<?= $base_url; ?>admin/modul/ppdb/index.php">
            <i class="fas fa-file-signature me-2"></i> Update PPDB
        </a>
        <a class="list-group-item list-group-item-action py-3 text-white bg-transparent border-0" href="<?= $base_url; ?>admin/modul/profil/index.php">
            <i class="fas fa-info-circle me-2"></i> Profil Sekolah
        </a>
        <a class="list-group-item list-group-item-action py-3 text-white bg-transparent border-0" href="<?= $base_url; ?>admin/modul/slider/index.php">
            <i class="fas fa-images me-2"></i> Kelola Slider
        </a>
        <a class="list-group-item list-group-item-action py-3 text-white bg-transparent border-0" href="<?= $base_url; ?>admin/modul/sambutan/index.php">
            <i class="fas fa-comment-dots me-2"></i> Sambutan Kepsek
        </a>
        
        <a class="list-group-item list-group-item-action py-3 text-white bg-transparent border-0 d-flex justify-content-between align-items-center" href="<?= $base_url; ?>admin/modul/pesan/index.php">
            <span><i class="fas fa-envelope me-2"></i> Pesan Masuk</span>
            <?php if ($jml_pesan_baru > 0) : ?>
                <span class="badge rounded-pill bg-danger shadow-sm"><?= $jml_pesan_baru; ?></span>
            <?php endif; ?>
        </a>

        <hr class="bg-light mx-3 opacity-25">
        <a class="list-group-item list-group-item-action py-3 text-danger bg-transparent border-0 fw-bold" href="<?= $base_url; ?>admin/logout.php">
            <i class="fas fa-sign-out-alt me-2"></i> Keluar
        </a>
    </div>
</div>