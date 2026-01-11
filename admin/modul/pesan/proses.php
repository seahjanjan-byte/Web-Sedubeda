<?php
session_start();
include_once '../../../config/config.php';

$aksi = $_GET['aksi'];
$id = $_GET['id'];

if ($aksi == 'pin') {
    $set = $_GET['set'];
    mysqli_query($koneksi, "UPDATE pesan SET status_pin = $set WHERE id_pesan = '$id'");
}

if ($aksi == 'arsip') {
    $set = $_GET['set'];
    mysqli_query($koneksi, "UPDATE pesan SET status_arsip = $set WHERE id_pesan = '$id'");
}

if ($aksi == 'hapus') {
    $id = $_GET['id'];
    
    // Proses penghapusan data dari tabel pesan
    $query = mysqli_query($koneksi, "DELETE FROM pesan WHERE id_pesan = '$id'");

    if ($query) {
        // PENTING: Baris ini yang mengembalikan admin ke halaman kelola pesan
        header("Location: index.php");
        exit(); // Tambahkan exit agar kode di bawahnya tidak dieksekusi
    } else {
        echo "Gagal menghapus pesan: " . mysqli_error($koneksi);
    }
}

// AKSI BARU: Tandai Sudah Dibaca
if ($aksi == 'baca') {
    mysqli_query($koneksi, "UPDATE pesan SET status_baca = 1 WHERE id_pesan = '$id'");
    header("Location: index.php");
    exit;
}
