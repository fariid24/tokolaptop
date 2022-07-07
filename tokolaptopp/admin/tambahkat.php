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
            <h1>Halaman Tambah Rute</h1>
            <div class="row">
                <div class="col-2">
                    <div class="card">
                        <div class="card-header">
                            <a class="nav-link" href="<?= URL_UTAMA . '/admin/index.php' ?>">Dashboard</a>
                        </div>
                        <ul class="list-group list-group-flush">
                        <li class="list-group-item active"><a class="nav-link" href="<?= URL_UTAMA . '/admin/tambahkat.php' ?>">Kategori</a></li>
                            <li class="list-group-item"><a class="nav-link" href="<?= URL_UTAMA . '/admin/tambahbrg.php' ?>">Barang</a></li>
                            <li class="list-group-item"><a class="nav-link" href="<?= URL_UTAMA . '/admin/transaksi.php' ?>">Transaksi</a></li>
                            <li class="list-group-item"><a class="nav-link" href="<?= URL_UTAMA . '/logout.php' ?>">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card w-80" >
                        <div class="card-body">
                            <form class="row g-2" method="POST" action="<?= URL_UTAMA . '/admin/tambahkat.php'; ?>">
                                <!-- nama Kategori -->
                                <div class="col-md-12">
                                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                    <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" placeholder="Laptop/Monitor">
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" name="tambah" class="btn btn-pesan btn-success pt-2 pb-2 my-2">Tambah Kategori</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card w-100">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nomor</th>
                                        <th scope="col">Nama Kategori</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($koneksi,"SELECT * FROM kategori");
                                    $index = 1;
                                    while ($data = mysqli_fetch_object($query)) { ?>
                                        <tr>
                                            <td><?= $index++; ?></td>
                                            <td><?= $data->nama_kategori; ?></td>
                                            <td>
                                                <a href="hapus.php?kategori=<?= $data->id_kategori; ?>" class="btn btn-danger btn-sm"> Hapus</a>
                                            </td> 
                                        </tr>
                                    <?php }
                                    ?>                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include '../footer.php'; ?>
<?php
if (isset($_POST['tambah'])) {

    $nama_kategori  = $_POST['nama_kategori'];

    $query =    mysqli_query($koneksi,"INSERT INTO `kategori` (`nama_kategori`) VALUES ('$nama_kategori')");
    if ($query) {
        echo '<script type="text/javascript">window.location.href= "tambahkat.php";</script>';
    } else {
        echo 'Data gagal tersimpan';
    }
}
?>