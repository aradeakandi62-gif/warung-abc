<?php
//dashboard.php
include ('include/cek_session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard - warung ABC</title>
</head>
<body>
    <h1>selamat datang, <?php echo $_SESSION['nama_lengkap']; ?></h1>
    <p>anda login sebagai: <?php echo $_SESSION['role']; ?></p>

<ul>
    <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'gudang') { ?>
<li><a href="data_barang.php">Data Barang</a></li>
<li><a href="data_pelanggan.php">data Pelanggan</a></li>
<?php } ?>

<?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'kasir') { ?>
<li><a href="transaksi.php">transaksi kasir</a></li>
<li><a href="riwayat_transaksi.php">riwayat transaksi</a></li>
<?php } ?>
</ul>

<a href="logout.php">logout</a>
</body>
</html>