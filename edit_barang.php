<?php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$id = $_GET['id'];
$sql = "SELECT * FROM tbl_barang WHERE id_barang = '$id'";
$hasil = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($hasil);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>edit barang - warung ABC</title>
</head>
<body>
    <h1>edit barang</h1>
    <form action="proses_edit_barang.php" method="POST">
        <input type="hidden" name="id_barang" value="<?php echo $data['id_barang']; ?>">
        <table>
            <tr><td>kode barang</td>:</tr>
                <td><input type="text" name="kode_barang" 
                value="<?php echo $data['kode_barang']; ?>" required></td></tr>
            <tr><td>nama barang</td>:</tr>
                <td><input type="text" name="nama_barang" 
                value="<?php echo $data['nama_barang']; ?>" required></td></tr>
            <tr><td>harga satuan</td>:</tr>
                <td><input type="text" name="harga_satuan" step="0.01" 
                value="<?php echo $data['harga_satuan']; ?>" required></td></tr>
            <tr><td>stok</td>:</tr>
                <td><input type="text" name="stok" 
                value="<?php echo $data['stok']; ?>" required></td></tr>
            <tr><td>tanggal kadaluarsa</td>:</tr>
                <td><input type="text" name="tanggal_kadaluarsa" 
                value="<?php echo $data['tanggal_kadaluarsa']; ?>" required></td></tr>
            <tr><td colspan="3><input type="submit" value="update"></td></tr>    
        </table>
    </form>
    <p><a href="data_barang.php">kembali</a></p>    
</body>
</html>