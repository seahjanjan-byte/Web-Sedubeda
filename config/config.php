<?php
// 1. Pengaturan Dasar
$base_url = "http://localhost/sdn-dukuhbenda02/";

// 2. Koneksi Database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_sdn_dukuhbenda02";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// 3. Logika Visitor Counter
$ip = $_SERVER['REMOTE_ADDR'];
$tanggal = date("Y-m-d");

// Cek apakah IP ini sudah berkunjung hari ini
$cek_visitor = mysqli_query($koneksi, "SELECT * FROM visitor WHERE ip_address='$ip' AND tanggal='$tanggal'");
if (mysqli_num_rows($cek_visitor) == 0) {
    mysqli_query($koneksi, "INSERT INTO visitor (ip_address, tanggal) VALUES ('$ip', '$tanggal')");
}

// Ambil total pengunjung untuk ditampilkan nanti
$res_total = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM visitor");
$data_visitor = mysqli_fetch_assoc($res_total);
$total_visitor = $data_visitor['total'];
?>