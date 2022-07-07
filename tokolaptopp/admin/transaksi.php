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
            <h1>Halaman Tambah Barang</h1>
            <div class="row">
                <div class="col-2">
                    <div class="card">
                        <div class="card-header">
                            <a class="nav-link" href="<?= URL_UTAMA . '/admin/index.php' ?>">Dashboard</a>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a class="nav-link" href="<?= URL_UTAMA . '/admin/tambahkat.php' ?>">Kategori</a></li>
                            <li class="list-group-item"><a class="nav-link" href="<?= URL_UTAMA . '/admin/tambahbrg.php' ?>">Barang</a></li>
                            <li class="list-group-item active"><a class="nav-link" href="<?= URL_UTAMA . '/admin/transaksi.php' ?>">Transaksi</a></li>
                            <li class="list-group-item"><a class="nav-link" href="<?= URL_UTAMA . '/logout.php' ?>">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-10">
                <table class="table table-striped">
                        <thead class="table-dark"> 
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Email</th>
                                <th scope="col">Barang</th>
                                <th scope="col">Tanggal Transaksi</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>      
                            <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM transaksi");
                            $index = 1;
                            while ($data = mysqli_fetch_object($query)) { ?>
                                <tr>
                                    <th scope="row"><?= $index++; ?></th>
                                    <td><?= $data->nama_lengkap;  ?></td>
                                    <td><?= $data->email;  ?></td>
                                    <td><?= $data->id_barang;  ?></td>
                                    <td><?= $data->tgl_transaksi;  ?></td>
                                    <td><?= $data->total;  ?></td>
                                </tr>
                            <?php }
                            ?>                                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<?php 

?>
<?php include '../footer.php'; ?>