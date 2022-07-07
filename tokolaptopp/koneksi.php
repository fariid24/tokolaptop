<?php
$koneksi = mysqli_connect("localhost","root","","tokolaptop");

define("URL_UTAMA", "/shop"); // GANTI /SHOP sesuai yg anda mau

if (!$koneksi) {
    echo "gagal";
}

?>