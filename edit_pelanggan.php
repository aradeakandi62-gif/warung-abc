<?php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$id = $_GET['id'];
$sql = "SELECT * FROM tbl_pelanggan WHERE id_pelanggan= '$id'";
$hasil = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($hasil);