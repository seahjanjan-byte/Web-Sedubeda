<?php
include_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $telepon = mysqli_real_escape_string($koneksi, $_POST['telepon']); // Ambil telepon
    $subjek = mysqli_real_escape_string($koneksi, $_POST['subjek']);
    $isi_pesan = mysqli_real_escape_string($koneksi, $_POST['isi_pesan']);

    // Query diperbarui dengan menambahkan kolom 'telepon'
    $sql = "INSERT INTO pesan (nama, email, telepon, subjek, isi_pesan) VALUES ('$nama', '$email', '$telepon', '$subjek', '$isi_pesan')";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        echo "<script>alert('Pesan berhasil terkirim!'); window.location='../index.php';</script>";
    } else {
        echo "<script>alert('Gagal mengirim pesan'); window.location='../index.php';</script>";
    }
}
?>