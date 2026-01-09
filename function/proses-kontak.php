<?php
// Panggil koneksi dari folder config
include_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dan amankan dari SQL Injection
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $subjek = mysqli_real_escape_string($koneksi, $_POST['subjek']);
    $isi_pesan = mysqli_real_escape_string($koneksi, $_POST['isi_pesan']);

    // Query Input
    $sql = "INSERT INTO pesan (nama, email, subjek, isi_pesan) VALUES ('$nama', '$email', '$subjek', '$isi_pesan')";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        echo "<script>alert('Pesan berhasil terkirim!'); window.location='../index.php';</script>";
    } else {
        echo "<script>alert('Gagal mengirim pesan: " . mysqli_error($koneksi) . "'); window.location='../index.php';</script>";
    }
} else {
    // Jika diakses langsung tanpa POST, kembalikan ke index
    header("Location: ../index.php");
}
?>