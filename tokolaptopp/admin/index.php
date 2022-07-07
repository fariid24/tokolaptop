<?php include '../koneksi.php'; 
session_start();
if (empty($_SESSION['level'] == "admin")) {
    header("location: ../loginadmin/");
}
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

    <div class="container-fluid mt-5">
        <h1>Halaman Dashboard</h1>
        <div class="row">
            <div class="col-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <a class="nav-link" href="<?= URL_UTAMA . '/admin/index.php' ?>">Dashboard</a>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a class="nav-link" href="<?= URL_UTAMA . '/admin/tambahkat.php' ?>">Kategori</a></li>
                        <li class="list-group-item"><a class="nav-link" href="<?= URL_UTAMA . '/admin/tambahbrg.php' ?>">Barang</a></li>
                        <li class="list-group-item"><a class="nav-link" href="<?= URL_UTAMA . '/admin/transaksi.php' ?>">Transaksi</a></li>
                        <li class="list-group-item"><a class="nav-link" href="<?= URL_UTAMA . '/logout.php' ?>">Logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10">
            <div class="card w-100" style="height:250px">
                <div class="card-body">
                    <h5 class="card-title">Selamat datang <i class="text-danger"><?= $_SESSION['username']; ?></i>  ,di halaman dashboard admin.</h5>
                </div>
            </div>
        </div>
    </div>


<?php include '../footer.php'; ?>