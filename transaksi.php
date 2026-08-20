<?php
session_start();
include 'include/cek_session.php';
include 'config/koneksi.php';

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = array();
}

$sql_pelanggan = "SELECT * FROM tbl_pelanggan ORDER BY nama_pelanggan ASC";
$hasil_pelanggan = mysqli_query($koneksi, $sql_pelanggan);
$daftar_barang = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE stok > 0");
$total = 0;
foreach ($_SESSION['keranjang']as $item) {
} 
?>

    <form action="proses_simpan_transaksi.php" method="POST">
        pelanggan:
        <select name="id_pelanggan">
            <option value="">-- pelanggan umum --</option>
            <?php while ($p = mysqli_fetch_assoc($hasil_pelanggan)) { ?>
        <option value="<?php echo $p['id_pelanggan']; ?>"> 
            <?php echo $p['nama_pelanggan']; ?></option>
        <?php } ?>
        </select>
        <input type="submit" value="simpan transaksi">
    </form>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>transaksi - warung ABC</title>
</head>
<body>
    <h1>transaksi penjualan</h1>
    
    <?php if (isset($_SESSION['pesan_error'])) {
        echo '<p>' . $_SESSION['pesan_error'] . '</p>';
        unset($_SESSION['pesan_error']);
    } ?>

    <h3>pilih barang</h3>
    <form action="proses_tambah_keranjang.php" method="POST">
        <select name="id_barang" required>
            <?php while ($b = mysqli_fetch_assoc($daftar_barang)) { ?>
        <option value="<?php echo $b['id_barang']; ?> ">
            <?php echo $b['nama_barang'] . '(stok: ' . $b['stok'] . ')'; ?>
        </option>
        <?php } ?>
        </select>
        jumlah: <input type="number" name="jumlah" min="1" required>
        <input type="submit" value="tambah ke keranjang">
    </form>

    <h3>keranjang</h3>
    <table border="1" cellpadding="6">
        <tr><th>nama barang</th><th>harga</th><th>jumlah</th><th>subtotal</th><th>aksi</th></tr>
        <?php foreach ($_SESSION['keranjang'] as $id_barang => $item) { ?>
    <tr>
        <td><?php echo $item['nama_barang']; ?></td>
        <td><?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
        <td><?php echo $item['jumlah']; ?></td>
        <td><?php echo number_format($item['subtotal'], 0, ',', '.'); ?></td
        <td><a href="hapus_keranjang.php?id=<?php echo $id_barang; ?>">hapus</a></td>
    </tr>
    <?php } ?>
    <tr><td colspan="3">total</td>
        <td colspan="2"><?php echo number_format($total, 0, ',', '.'); ?></td></tr>
    </table>

    <form action="proses_simpan_transaksi.php" method="POST">
        <input type="submit" value="simpan transaksi">
    </form>
    <p><a href="dashboard.php">kembali ke dashboard</a></p>
</body>
</html>