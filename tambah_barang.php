<?php include 'includes/cek_session.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>tambah barang - warung ABC</title>
</head>
<body>
    <h1>tambah barang</h1>
    <form action="proses_tambah_barang.php" method="POST">
        <table>
            <tr><td>kode barang</td><td>:</td>
                <td><input type="text" name="kode_barang" required</td></tr>
            <tr><td>nama barang</td><td>:</td> 
                <td><input type="text" name="nama_barang" required</td></tr>  
            <tr><td>harga satuan</td><td>:</td>
                <td><input type="text" name="harga_satuan" step="0.01" required</td></tr>
            <tr><td>stok</td><td>:</td>
                <td><input type="number" name="stok" required</td></tr>
            <tr><td>tanggal kadaluarsa</td><td>:</td>
                <td><input type="date" name="tanggal_kadaluarsa" required</td></tr>
            <tr><td colspan="3"><input type="submit" value="simpan"></td></tr>
        </table>
    </form>
    <p><a href="data_pelanggan.php">kembali</a></p>        
</body>
</html>