<?php
session_start();
include_once '../../../config/config.php';

$aksi = $_GET['aksi'];

// --- TAMBAH GURU ---
if ($aksi == 'tambah') {
    $nama    = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);

    $file_name = $_FILES['foto']['name'];
    $tmp_name  = $_FILES['foto']['tmp_name'];
    $ext       = pathinfo($file_name, PATHINFO_EXTENSION);
    $new_name  = "guru_" . time() . "." . $ext;

    if (move_uploaded_file($tmp_name, "../../../assets/img/guru/" . $new_name)) {
        mysqli_query($koneksi, "INSERT INTO guru (nama, jabatan, foto) VALUES ('$nama', '$jabatan', '$new_name')");
        header("Location: index.php");
    }
}

// --- HAPUS GURU ---
if ($aksi == 'hapus') {
    $id = $_GET['id'];
    $data = mysqli_query($koneksi, "SELECT foto FROM guru WHERE id_guru='$id'");
    $row = mysqli_fetch_assoc($data);
    
    if (file_exists("../../../assets/img/guru/" . $row['foto'])) {
        unlink("../../../assets/img/guru/" . $row['foto']);
    }
    
    mysqli_query($koneksi, "DELETE FROM guru WHERE id_guru='$id'");
    header("Location: index.php");
}

// --- EDIT GURU ---
if ($aksi == 'edit') {
    $id      = $_POST['id_guru'];
    $nama    = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    
    $file_name = $_FILES['foto']['name'];
    $tmp_name  = $_FILES['foto']['tmp_name'];

    if (!empty($file_name)) {
        $ext      = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_name = "guru_" . time() . "." . $ext;

        $old_data = mysqli_query($koneksi, "SELECT foto FROM guru WHERE id_guru='$id'");
        $old_row  = mysqli_fetch_assoc($old_data);
        if (file_exists("../../../assets/img/guru/" . $old_row['foto'])) {
            unlink("../../../assets/img/guru/" . $old_row['foto']);
        }

        move_uploaded_file($tmp_name, "../../../assets/img/guru/" . $new_name);
        $query = "UPDATE guru SET nama='$nama', jabatan='$jabatan', foto='$new_name' WHERE id_guru='$id'";
    } else {
        $query = "UPDATE guru SET nama='$nama', jabatan='$jabatan' WHERE id_guru='$id'";
    }

    mysqli_query($koneksi, $query);
    header("Location: index.php");
}
?>