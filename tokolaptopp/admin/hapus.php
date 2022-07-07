<?php
include '../koneksi.php';
$id_barang = $_GET['barang'];
$querybarang = mysqli_query($koneksi,"DELETE FROM barang WHERE id_barang = $id_barang");
if (!$querybarang) {
    echo "gagal";
}else{
    header('location: ./tambahbrg.php');
}

$id_kat = $_GET['kategori'];
$querykategori = mysqli_query($koneksi,"DELETE FROM kategori WHERE id_kategori = $id_kat");
if (!$querykategori) {
    echo "gagal";
}else{
    header('location: ./tambahkat.php');
}


?>