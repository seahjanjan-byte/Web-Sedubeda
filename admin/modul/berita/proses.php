<?php
session_start();
include_once '../../../config/config.php';

$aksi = $_GET['aksi'];

// --- LOGIKA TAMBAH ---
if ($aksi == 'tambah') {
    $judul   = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $isi     = mysqli_real_escape_string($koneksi, $_POST['isi']);
    $tanggal = $_POST['tanggal'];
    $slug    = strtolower(str_replace(' ', '-', $judul));

    $nama_file = $_FILES['gambar']['name'];
    $tmp_file  = $_FILES['gambar']['tmp_name'];
    $ekstensi  = pathinfo($nama_file, PATHINFO_EXTENSION);
    $nama_baru = time() . '.' . $ekstensi;

    if (move_uploaded_file($tmp_file, "../../../assets/img/berita/" . $nama_baru)) {
        mysqli_query($koneksi, "INSERT INTO berita (judul, slug, isi, tanggal, gambar, status) 
                               VALUES ('$judul', '$slug', '$isi', '$tanggal', '$nama_baru', 'tampil')");
        header("Location: index.php");
    }
}

// --- LOGIKA HAPUS ---
if ($aksi == 'hapus') {
    $id = $_GET['id'];
    $data = mysqli_query($koneksi, "SELECT gambar FROM berita WHERE id_berita='$id'");
    $row = mysqli_fetch_assoc($data);
    
    // Hapus file fisik
    if (file_exists("../../../assets/img/berita/" . $row['gambar'])) {
        unlink("../../../assets/img/berita/" . $row['gambar']);
    }
    
    mysqli_query($koneksi, "DELETE FROM berita WHERE id_berita='$id'");
    header("Location: index.php");
}

// --- LOGIKA STATUS (ARSIP/TAYANG) ---
if ($aksi == 'status') {
    $id = $_GET['id'];
    $set = $_GET['set'];
    mysqli_query($koneksi, "UPDATE berita SET status='$set' WHERE id_berita='$id'");
    header("Location: index.php");
}

// --- Tambahkan ini di bawah logika hapus di proses.php ---

if ($aksi == 'edit') {
    $id      = $_POST['id_berita'];
    $judul   = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $isi     = mysqli_real_escape_string($koneksi, $_POST['isi']);
    $tanggal = $_POST['tanggal'];
    $slug    = strtolower(str_replace(' ', '-', $judul));

    $nama_file = $_FILES['gambar']['name'];
    $tmp_file  = $_FILES['gambar']['tmp_name'];

    // Jika user mengupload gambar baru
    if (!empty($nama_file)) {
        $ekstensi  = pathinfo($nama_file, PATHINFO_EXTENSION);
        $nama_baru = time() . '.' . $ekstensi;

        // Ambil nama gambar lama untuk dihapus
        $data = mysqli_query($koneksi, "SELECT gambar FROM berita WHERE id_berita='$id'");
        $row = mysqli_fetch_assoc($data);
        if (file_exists("../../../assets/img/berita/" . $row['gambar'])) {
            unlink("../../../assets/img/berita/" . $row['gambar']);
        }

        move_uploaded_file($tmp_file, "../../../assets/img/berita/" . $nama_baru);
        
        $query = "UPDATE berita SET judul='$judul', slug='$slug', isi='$isi', tanggal='$tanggal', gambar='$nama_baru' WHERE id_berita='$id'";
    } else {
        // Jika tidak ganti gambar
        $query = "UPDATE berita SET judul='$judul', slug='$slug', isi='$isi', tanggal='$tanggal' WHERE id_berita='$id'";
    }

    mysqli_query($koneksi, $query);
    header("Location: index.php");
}
?>