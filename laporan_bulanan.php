<?php 
include 'includes/cek_session.php';
include 'config/koneksi.php';

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('Y-m');
$bulan = mysqli_real_escape_string($koneksi, $bulan);

$sql = "SELECT t. no_transaksi, t.tanggal, t.total_bayar, u.nama_lengkap AS nama_kasir";
$sql .= " FROM tbl_transaksi t JOIN tbl_user u ON t.id_kasir = u.id_user";
$sql .= " WHERE DATE_FORMAT(t.tanggal, '%Y-%m') = '$bulan' ORDER BY t.tanggal ASC";
$hasil = mysqli_query($koneksi, $bulan);

$sql = "SELECT t.no_transaksi, t.tanggal, t.total_bayar, u.nama_lengkap AS nama_kasir";
$sql .= "FROM tbl_transaksi t JOIN tbl_user u ON t.id_kasir= u.id_user";
$sql .= "WHERE DATE_FORMAT(t.tanggal, '%Y-%m') = '$bulan' ORDER BY t.tanggal ASC";
$hasil = mysqli_query($koneksi, $sql);

$total_bulanan = 0;
$jumlah_transaksi = 0;
?>