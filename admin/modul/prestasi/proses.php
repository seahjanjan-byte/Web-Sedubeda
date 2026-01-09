<?php
session_start();
include_once '../../../config/config.php';

$aksi = $_GET['aksi'];

// --- TAMBAH PRESTASI ---
if ($aksi == 'tambah') {
    $nama_prestasi = mysqli_real_escape_string($koneksi, $_POST['nama_prestasi']);
    $pemenang      = mysqli_real_escape_string($koneksi, $_POST['pemenang']);
    $tahun         = $_POST['tahun'];
    $tingkat       = $_POST['tingkat'];

    $file_name = $_FILES['gambar']['name'];
    $tmp_name  = $_FILES['gambar']['tmp_name'];
    $ext       = pathinfo($file_name, PATHINFO_EXTENSION);
    $new_name  = "prestasi_" . time() . "." . $ext;

    if (move_uploaded_file($tmp_name, "../../../assets/img/prestasi/" . $new_name)) {
        mysqli_query($koneksi, "INSERT INTO prestasi (nama_prestasi, pemenang, tahun, tingkat, gambar) 
                               VALUES ('$nama_prestasi', '$pemenang', '$tahun', '$tingkat', '$new_name')");
        header("Location: index.php");
    }
}

// --- HAPUS PRESTASI ---
if ($aksi == 'hapus') {
    $id = $_GET['id'];
    $data = mysqli_query($koneksi, "SELECT gambar FROM prestasi WHERE id_prestasi='$id'");
    $row = mysqli_fetch_assoc($data);
    
    if (file_exists("../../../assets/img/prestasi/" . $row['gambar'])) {
        unlink("../../../assets/img/prestasi/" . $row['gambar']);
    }
    
    mysqli_query($koneksi, "DELETE FROM prestasi WHERE id_prestasi='$id'");
    header("Location: index.php");
}

// --- EDIT PRESTASI ---
if ($aksi == 'edit') {
    $id            = $_POST['id_prestasi'];
    $nama_prestasi = mysqli_real_escape_string($koneksi, $_POST['nama_prestasi']);
    $pemenang      = mysqli_real_escape_string($koneksi, $_POST['pemenang']);
    $tahun         = $_POST['tahun'];
    $tingkat       = $_POST['tingkat'];
    
    $file_name = $_FILES['gambar']['name'];
    $tmp_name  = $_FILES['gambar']['tmp_name'];

    if (!empty($file_name)) {
        $ext      = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_name = "prestasi_" . time() . "." . $ext;

        $old_data = mysqli_query($koneksi, "SELECT gambar FROM prestasi WHERE id_prestasi='$id'");
        $old_row  = mysqli_fetch_assoc($old_data);
        if (file_exists("../../../assets/img/prestasi/" . $old_row['gambar'])) {
            unlink("../../../assets/img/prestasi/" . $old_row['gambar']);
        }

        move_uploaded_file($tmp_name, "../../../assets/img/prestasi/" . $new_name);
        $query = "UPDATE prestasi SET nama_prestasi='$nama_prestasi', pemenang='$pemenang', tahun='$tahun', tingkat='$tingkat', gambar='$new_name' WHERE id_prestasi='$id'";
    } else {
        $query = "UPDATE prestasi SET nama_prestasi='$nama_prestasi', pemenang='$pemenang', tahun='$tahun', tingkat='$tingkat' WHERE id_prestasi='$id'";
    }

    mysqli_query($koneksi, $query);
    header("Location: index.php");
}
?>