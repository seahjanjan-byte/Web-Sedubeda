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
    mysqli_query($koneksi, "DELETE FROM pesan WHERE id_pesan = '$id'");
}

// AKSI BARU: Tandai Sudah Dibaca
if ($aksi == 'baca') {
    mysqli_query($koneksi, "UPDATE pesan SET status_baca = 1 WHERE id_pesan = '$id'");
    header("Location: index.php");
    exit;
}
