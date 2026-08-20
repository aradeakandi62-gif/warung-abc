<?php
include 'config/koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pelanggan - Warung ABC</title>
</head>
<body>

<h1>Tambah Pelanggan</h1>

<form action="proses_tambah_pelanggan.php" method="POST">

    <label>Nama Pelanggan</label><br>
    <input type="text" name="nama_pelanggan" required>
    <br><br>

    <label>No. Telepon</label><br>
    <input type="text" name="no_telepon" required>
    <br><br>

    <label>Alamat</label><br>
    <textarea name="alamat" required></textarea>
    <br><br>

    <button type="submit">Simpan</button>
    <a href="data_pelanggan.php">Kembali</a>

</form>

</body>
</html>