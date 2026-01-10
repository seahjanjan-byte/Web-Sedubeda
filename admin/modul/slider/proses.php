<?php
session_start();
include_once '../../../config/config.php';

$aksi = $_GET['aksi'];

// --- TAMBAH SLIDER ---
if ($aksi == 'tambah') {
    $judul     = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    $file_name = $_FILES['gambar']['name'];
    $tmp_name  = $_FILES['gambar']['tmp_name'];
    $ext       = pathinfo($file_name, PATHINFO_EXTENSION);
    $new_name  = "slide_" . time() . "." . $ext;

    if (move_uploaded_file($tmp_name, "../../../assets/img/slider/" . $new_name)) {
        mysqli_query($koneksi, "INSERT INTO slider (judul, deskripsi, gambar) VALUES ('$judul', '$deskripsi', '$new_name')");
        header("Location: index.php");
    }
}

// --- HAPUS SLIDER ---
if ($aksi == 'hapus') {
    $id = $_GET['id'];
    $data = mysqli_query($koneksi, "SELECT gambar FROM slider WHERE id_slider='$id'");
    $row = mysqli_fetch_assoc($data);
    
    if (file_exists("../../../assets/img/slider/" . $row['gambar'])) {
        unlink("../../../assets/img/slider/" . $row['gambar']);
    }
    
    mysqli_query($koneksi, "DELETE FROM slider WHERE id_slider='$id'");
    header("Location: index.php");
}

// --- EDIT SLIDER ---
if ($aksi == 'edit') {
    $id        = $_POST['id_slider'];
    $judul     = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    
    $file_name = $_FILES['gambar']['name'];
    $tmp_name  = $_FILES['gambar']['tmp_name'];

    if (!empty($file_name)) {
        $ext      = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_name = "slide_" . time() . "." . $ext;

        // Hapus foto lama
        $old_data = mysqli_query($koneksi, "SELECT gambar FROM slider WHERE id_slider='$id'");
        $old_row  = mysqli_fetch_assoc($old_data);
        if (file_exists("../../../assets/img/slider/" . $old_row['gambar'])) {
            unlink("../../../assets/img/slider/" . $old_row['gambar']);
        }

        move_uploaded_file($tmp_name, "../../../assets/img/slider/" . $new_name);
        $query = "UPDATE slider SET judul='$judul', deskripsi='$deskripsi', gambar='$new_name' WHERE id_slider='$id'";
    } else {
        $query = "UPDATE slider SET judul='$judul', deskripsi='$deskripsi' WHERE id_slider='$id'";
    }

    mysqli_query($koneksi, $query);
    header("Location: index.php");
}
?>