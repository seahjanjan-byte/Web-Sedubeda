<?php 
// Sertakan file koneksi secara eksplisit agar variabel $koneksi terbaca
include_once dirname(__DIR__) . '/config/config.php';
include '../includes/header.php'; 
?>

<div class="container py-5">
    <?php
    // Sekarang variabel $koneksi dipastikan sudah ada
    $query = mysqli_query($koneksi, "SELECT * FROM profil WHERE jenis = 'visi_misi'");
    $d = mysqli_fetch_assoc($query);
    
    // Decode data JSON (karena sekarang kita menggunakan format JSON untuk Visi & Misi)
    $data = json_decode($d['konten'], true);
    ?>
    
    <h2 class="fw-bold text-center mb-5">Visi & Misi</h2>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm p-4 mb-4">
                <h4 class="fw-bold text-primary mb-4 text-center">VISI</h4>
                <div class="lh-lg">
                    <ul class="list-group list-group-flush">
                        <?php 
                        $visi = $data['visi'] ?? [];
                        if (is_array($visi) && !empty($visi)) {
                            foreach ($visi as $v) {
                                echo '<li class="list-group-item border-0 px-0 fs-5 text-center fst-italic">"' . htmlspecialchars($v) . '"</li>';
                            }
                        } else {
                            echo '<li class="list-group-item border-0 text-center">Belum ada data visi.</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="card border-0 shadow-sm p-4">
                <h4 class="fw-bold text-primary mb-4 text-center">MISI</h4>
                <div class="lh-lg">
                    <ol class="ps-4">
                        <?php 
                        $misi = $data['misi'] ?? [];
                        if (is_array($misi) && !empty($misi)) {
                            foreach ($misi as $m) {
                                echo '<li class="mb-2">' . htmlspecialchars($m) . '</li>';
                            }
                        } else {
                            echo '<li>Belum ada data misi.</li>';
                        }
                        ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once dirname(__DIR__) . '/includes/footer.php'; ?>