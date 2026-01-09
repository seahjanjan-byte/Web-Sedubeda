<?php
session_start();
include_once '../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file_name = $_FILES['brosur']['name'];
    $tmp_name  = $_FILES['brosur']['tmp_name'];

    if (!empty($file_name)) {
        $ext      = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_name = "brosur_ppdb." . $ext; // Nama tetap agar mudah dikelola

        // Ambil data lama untuk dihapus filenya
        $old = mysqli_query($koneksi, "SELECT brosur FROM ppdb LIMIT 1");
        $row = mysqli_fetch_assoc($old);
        if (file_exists("../../../assets/img/" . $row['brosur'])) {
            unlink("../../../assets/img/" . $row['brosur']);
        }

        if (move_uploaded_file($tmp_name, "../../../assets/img/" . $new_name)) {
            mysqli_query($koneksi, "UPDATE ppdb SET brosur='$new_name'");
        }
    }
    header("Location: index.php");
}
?>