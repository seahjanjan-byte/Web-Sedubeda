<?php
session_start();
include_once '../../../config/config.php';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

// --- TAMBAH FASILITAS ---
if ($aksi == 'tambah') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_fasilitas']);
    
    $file_name = $_FILES['gambar']['name'];
    $tmp_name  = $_FILES['gambar']['tmp_name'];
    $new_name  = "fasilitas_" . time() . "_" . $file_name;

    if (move_uploaded_file($tmp_name, "../../../assets/img/fasilitas/" . $new_name)) {
        mysqli_query($koneksi, "INSERT INTO fasilitas (nama_fasilitas, gambar) VALUES ('$nama', '$new_name')");
    }
    header("Location: index.php");
}

// --- EDIT FASILITAS ---
if ($aksi == 'edit') {
    $id   = $_POST['id_fasilitas']; // Diambil dari input hidden di form edit
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_fasilitas']);
    
    $file_name = $_FILES['gambar']['name'];
    $tmp_name  = $_FILES['gambar']['tmp_name'];

    // Jika user mengunggah gambar baru
    if (!empty($file_name)) {
        $new_name = "fasilitas_" . time() . "_" . $file_name;

        // 1. Hapus gambar lama dari folder
        $data = mysqli_query($koneksi, "SELECT gambar FROM fasilitas WHERE id_fasilitas='$id'");
        $row  = mysqli_fetch_assoc($data);
        if (file_exists("../../../assets/img/fasilitas/" . $row['gambar'])) {
            unlink("../../../assets/img/fasilitas/" . $row['gambar']);
        }

        // 2. Upload gambar baru & Update database
        if (move_uploaded_file($tmp_name, "../../../assets/img/fasilitas/" . $new_name)) {
            mysqli_query($koneksi, "UPDATE fasilitas SET nama_fasilitas='$nama', gambar='$new_name' WHERE id_fasilitas='$id'");
        }
    } else {
        // Jika user TIDAK mengunggah gambar baru, cukup update nama saja
        mysqli_query($koneksi, "UPDATE fasilitas SET nama_fasilitas='$nama' WHERE id_fasilitas='$id'");
    }
    
    header("Location: index.php");
}

// --- HAPUS FASILITAS ---
if ($aksi == 'hapus') {
    $id = $_GET['id'];
    $data = mysqli_query($koneksi, "SELECT gambar FROM fasilitas WHERE id_fasilitas='$id'");
    $row = mysqli_fetch_assoc($data);
    
    if (file_exists("../../../assets/img/fasilitas/" . $row['gambar'])) {
        unlink("../../../assets/img/fasilitas/" . $row['gambar']);
    }
    
    mysqli_query($koneksi, "DELETE FROM fasilitas WHERE id_fasilitas='$id'");
    header("Location: index.php");
}
?>