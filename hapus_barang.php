<?php
// hapus_barang.php
session_start();

include 'includes/cek_session.php';
include 'config/koneksi.php';

$id = $_GET['id'];

// Ambil nama barang sebelum dihapus
$cek = mysqli_query($koneksi, "SELECT nama_barang FROM tbl_barang WHERE id_barang = '$id'");
$data = mysqli_fetch_assoc($cek);

// Hapus barang
$sql = "DELETE FROM tbl_barang WHERE id_barang = '$id'";

if (mysqli_query($koneksi, $sql)) {

    // Simpan log aktivitas
    $id_user = $_SESSION['id_user'];
    $waktu = date('Y-m-d H:i:s');

    $aktivitas = "hapus barang: " . $data['nama_barang'];

    $log = "INSERT INTO tbl_log (id_user, aktivitas, waktu)
            VALUES ('$id_user', '$aktivitas', '$waktu')";

    mysqli_query($koneksi, $log);
}

header('Location: data_barang.php');
exit;
?>