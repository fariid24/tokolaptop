<?php
include 'koneksi.php';
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid bg-light">
        <header class="d-flex justify-content-center py-3">
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="index.php" class="nav-link active" aria-current="page">Home</a></li>
                <li class="nav-item"><a href="kategori.php" class="nav-link">Kategori</a></li>
                <li class="nav-item"><a href="order.php" class="nav-link">Keranjang Belanja</a></li>
                <?php 
                if (!empty($_SESSION['username'])) {
                  echo '<li class="nav-item"><a href="logout.php" class="nav-link"><h5><span class="badge bg-danger">Logout</span></h5></a></li>';
                }else{
                  echo '<li class="nav-item"><a href="/shop/loginuser/" class="nav-link"><h5><span class="badge bg-success">Login</span></h5></a></li>';
                }
                ?>
            </ul>
        </header>
    </div>