<?php
session_start();
include_once '../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_kepsek']);
    $isi  = mysqli_real_escape_string($koneksi, $_POST['isi_sambutan']);
    
    $file_name = $_FILES['foto']['name'];
    $tmp_name  = $_FILES['foto']['tmp_name'];

    if (!empty($file_name)) {
        // Logika Ganti Foto
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_name = "kepsek_" . time() . "." . $ext;
        
        // Hapus foto lama
        $old = mysqli_query($koneksi, "SELECT foto FROM sambutan LIMIT 1");
        $row = mysqli_fetch_assoc($old);
        if (file_exists("../../../assets/img/" . $row['foto'])) {
            unlink("../../../assets/img/" . $row['foto']);
        }

        move_uploaded_file($tmp_name, "../../../assets/img/" . $new_name);
        $sql = "UPDATE sambutan SET nama_kepsek='$nama', isi_sambutan='$isi', foto='$new_name'";
    } else {
        // Update tanpa ganti foto
        $sql = "UPDATE sambutan SET nama_kepsek='$nama', isi_sambutan='$isi'";
    }

    if (mysqli_query($koneksi, $sql)) {
        header("Location: index.php");
    }
}
?>