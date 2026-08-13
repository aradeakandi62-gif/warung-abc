<?php 
include 'includes/cek_session.php';
include 'config/koneksi.php';

$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
$tanggal = mysqli_real_escape_string($koneksi, $tanggal);

$sql = "SELECT t.no_transaksi, t.tanggal, t.total_bayar, u.nama_lengkap AS nama_kasir";
$sql .= "FROM tbl_transaksi t JOIN tbl_user u ON t.id_kasir = u.id_user";
$sql .= " WHERE DATE(t.tanggal) = '$tanggal' ORDER BY t.tanggal ASC";
$hasil = mysqli_query($koneksi, $sql);

$total_harian = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>laporan transaksi harian</title>
</head>
<body>
    <h1>laporan transaksi harian</h1>
    <form method="GET">
        tanggal: <input type="date" name="tanggal" value="<?php echo $tanggal; ?>">
        <input type="submit" value="tampilkan">
    </form>
    <table border="1" cellpadding="6">
        <tr><th>no. transaksi</th><th>waktu</th><th>kasir</th><th>total bayar</th></tr>
        <?php while ($row = mysqli_fetch_assoc($hasil)) {
            $total_harian += $row['total_bayar'];
        ?>
        <tr>
            <td><?php echo $row['no_transaksi']; ?></td>
            <td><?php echo $row['tanggal']; ?></td>
            <td><?php echo $row['nama_kasir']; ?></td>
            <td><?php echo number_format($row['total_bayar'], 0, ',', '.'); ?></td>
        </tr>
        <?php } ?>
        <tr><td colspan="3">total pendapatan hari ini</td>
            <td><?php echo number_format($total_harian, 0, ',', '.'); ?></td></tr>
    </table>
    <p><a href="dashboard.php">kembali ke dashboard</a></p>
</body>
</html>