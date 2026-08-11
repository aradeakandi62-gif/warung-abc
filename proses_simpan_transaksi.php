<?php
session_start();

/* =========================================
   KONEKSI DATABASE
========================================= */

$koneksi = mysqli_connect(
    "localhost",
    "root",
    "",
    "warung_abc"
);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}


/* =========================================
   CEK LOGIN
========================================= */

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];


/* =========================================
   ID PELANGGAN
========================================= */

$id_pelanggan = $_POST['id_pelanggan'] ?? 1;

if (empty($id_pelanggan)) {
    $id_pelanggan = 1;
}


/* =========================================
   DATA TRANSAKSI
========================================= */

$no_transaksi = 'TRX-' . date('YmdHis');
$tanggal = date('Y-m-d H:i:s');


/* =========================================
   CEK KERANJANG
========================================= */

if (!isset($_SESSION['keranjang']) || empty($_SESSION['keranjang'])) {

    echo "<script>
        alert('Keranjang masih kosong!');
        window.location='transaksi.php';
    </script>";

    exit;
}


/* =========================================
   SIMPAN TRANSAKSI
========================================= */

/*
   tbl_transaksi hanya menggunakan:
   - no_transaksi
   - tanggal
   - id_pelanggan

   Tidak menggunakan:
   - id_user
   - total
*/

$sql = "INSERT INTO tbl_transaksi
        (no_transaksi, tanggal, id_pelanggan)
        VALUES
        ('$no_transaksi', '$tanggal', '$id_pelanggan')";


if (!mysqli_query($koneksi, $sql)) {

    die(
        "Gagal menyimpan transaksi: "
        . mysqli_error($koneksi)
    );

}


/* =========================================
   AMBIL ID TRANSAKSI
========================================= */

$id_transaksi = mysqli_insert_id($koneksi);


/* =========================================
   SIMPAN DETAIL TRANSAKSI
========================================= */

foreach ($_SESSION['keranjang'] as $item) {

    $id_barang = $item['id_barang'];
    $jumlah = $item['jumlah'];
    $subtotal = $item['subtotal'];


    $detail = "INSERT INTO tbl_detail_transaksi
               (id_transaksi, id_barang, jumlah, subtotal)
               VALUES
               ('$id_transaksi', '$id_barang', '$jumlah', '$subtotal')";


    if (!mysqli_query($koneksi, $detail)) {

        die(
            "Gagal menyimpan detail transaksi: "
            . mysqli_error($koneksi)
        );

    }


    /* =========================================
       UPDATE STOK BARANG
    ========================================= */

    $update_stok = "UPDATE tbl_barang
                    SET stok = stok - $jumlah
                    WHERE id_barang = '$id_barang'";


    if (!mysqli_query($koneksi, $update_stok)) {

        die(
            "Gagal mengupdate stok: "
            . mysqli_error($koneksi)
        );

    }
}


/* =========================================
   SIMPAN LOG
========================================= */

$waktu = date('Y-m-d H:i:s');

$aktivitas = "Transaksi: $no_transaksi";


$log = "INSERT INTO tbl_log
        (id_user, aktivitas, waktu)
        VALUES
        ('$id_user', '$aktivitas', '$waktu')";


mysqli_query($koneksi, $log);


/* =========================================
   HAPUS KERANJANG
========================================= */

unset($_SESSION['keranjang']);


/* =========================================
   SELESAI
========================================= */

echo "<script>
    alert('Transaksi berhasil disimpan!');
    window.location='transaksi.php';
</script>";

?>