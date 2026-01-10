<?php
include_once dirname(__DIR__) . '/config/config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SD Negeri Dukuhbenda 02</title>
    
    <link rel="stylesheet" href="<?= $base_url; ?>assets/css/style.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base_url; ?>assets/css/style.css?v=<?= time(); ?>">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <link rel="stylesheet" href="<?= $base_url; ?>assets/css/style.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= $base_url; ?>index.php">
                <img src="<?= $base_url; ?>assets/img/logo_tel.png" alt="Logo">
                <div>
                    <span class="d-block fw-bold lh-1" style="color: var(--primary-color);">SD NEGERI</span>
                    <small class="text-muted">DUKUHBENDA 02</small>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base_url; ?>index.php">Beranda</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profil
                        </a>
                        <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="profilDropdown">
                            <li><a class="dropdown-item" href="<?= $base_url; ?>pages/visi-misi.php">Visi Misi</a></li>
                            <li><a class="dropdown-item" href="<?= $base_url; ?>pages/sejarah.php">Sejarah Sekolah</a></li>
                            <li><a class="dropdown-item" href="<?= $base_url; ?>pages/struktur.php">Struktur Organisasi</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="<?= $base_url; ?>pages/guru.php">Guru & Staff</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $base_url; ?>pages/berita.php">Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $base_url; ?>pages/ppdb.php">PPDB</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $base_url; ?>pages/galeri.php">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $base_url; ?>pages/prestasi.php">Prestasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $base_url; ?>pages/fasilitas.php">Fasilitas</a></li>
                    </ul>
            </div>
        </div>
    </nav>

    <main>