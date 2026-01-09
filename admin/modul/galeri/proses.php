<?php
session_start();
include_once '../../../config/config.php';

$aksi = $_GET['aksi'];

if ($aksi == 'tambah') {
    $judul   = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $tanggal = $_POST['tanggal'];
    $link    = mysqli_real_escape_string($koneksi, $_POST['link_gdrive']);

    $file_name = $_FILES['gambar']['name'];
    $tmp_name  = $_FILES['gambar']['tmp_name'];
    $new_name  = "galeri_" . time() . "." . pathinfo($file_name, PATHINFO_EXTENSION);

    if (move_uploaded_file($tmp_name, "../../../assets/img/galeri/" . $new_name)) {
        mysqli_query($koneksi, "INSERT INTO galeri (judul, tanggal, gambar, link_gdrive) VALUES ('$judul', '$tanggal', '$new_name', '$link')");
        header("Location: index.php");
    }
}

if ($aksi == 'hapus') {
    $id = $_GET['id'];
    $data = mysqli_query($koneksi, "SELECT gambar FROM galeri WHERE id_galeri='$id'");
    $row = mysqli_fetch_assoc($data);
    if (file_exists("../../../assets/img/galeri/" . $row['gambar'])) {
        unlink("../../../assets/img/galeri/" . $row['gambar']);
    }
    mysqli_query($koneksi, "DELETE FROM galeri WHERE id_galeri='$id'");
    header("Location: index.php");
}
?>