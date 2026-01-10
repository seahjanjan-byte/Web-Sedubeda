<?php
session_start();
include_once '../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jenis = $_POST['jenis'];

    if ($jenis == 'struktur') {
        // Logika Update Gambar Struktur
        $file_name = $_FILES['gambar']['name'];
        $tmp_name  = $_FILES['gambar']['tmp_name'];
        
        if (!empty($file_name)) {
            $ext      = pathinfo($file_name, PATHINFO_EXTENSION);
            $new_name = "struktur_" . time() . "." . $ext;

            $old = mysqli_query($koneksi, "SELECT gambar FROM profil WHERE jenis='struktur'");
            $row = mysqli_fetch_assoc($old);
            if (file_exists("../../../assets/img/" . $row['gambar'])) {
                unlink("../../../assets/img/" . $row['gambar']);
            }

            move_uploaded_file($tmp_name, "../../../assets/img/" . $new_name);
            mysqli_query($koneksi, "UPDATE profil SET gambar='$new_name' WHERE jenis='struktur'");
        }
    } else {
        if ($jenis == 'visi_misi') {
            // Bersihkan Visi
            $visi_raw = $_POST['visi'] ?? [];
            $visi_clean = array_values(array_filter($visi_raw, function($val) { return trim($val) !== ''; }));

            // Bersihkan Misi
            $misi_raw = $_POST['misi'] ?? [];
            $misi_clean = array_values(array_filter($misi_raw, function($val) { return trim($val) !== ''; }));

            $data_json = json_encode([
                'visi' => $visi_clean,
                'misi' => $misi_clean
            ]);
            $konten = mysqli_real_escape_string($koneksi, $data_json);
        } else {
            $konten = mysqli_real_escape_string($koneksi, $_POST['konten']);
        }

        mysqli_query($koneksi, "UPDATE profil SET konten='$konten' WHERE jenis='$jenis'");
    }

    header("Location: index.php");
    exit;
}
?>