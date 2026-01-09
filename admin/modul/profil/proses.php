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

            // Hapus gambar lama
            $old = mysqli_query($koneksi, "SELECT gambar FROM profil WHERE jenis='struktur'");
            $row = mysqli_fetch_assoc($old);
            if (file_exists("../../../assets/img/" . $row['gambar'])) {
                unlink("../../../assets/img/" . $row['gambar']);
            }

            move_uploaded_file($tmp_name, "../../../assets/img/" . $new_name);
            mysqli_query($koneksi, "UPDATE profil SET gambar='$new_name' WHERE jenis='struktur'");
        }
    } else {
        // Logika Update Teks Visi-Misi / Sejarah
        $konten = mysqli_real_escape_string($koneksi, $_POST['konten']);
        mysqli_query($koneksi, "UPDATE profil SET konten='$konten' WHERE jenis='$jenis'");
    }

    header("Location: index.php");
}
?>