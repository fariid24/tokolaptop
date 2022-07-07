<?php include '../koneksi.php';
session_start();
if (empty($_SESSION['level'] == "admin")) {
    header("location: ../loginadmin/");
}
if (empty($_GET['barang_id'])) {
    header('location: tambahbrg.php');	
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
        <h1>Halaman Edit Barang</h1>
        <div class="row">
            <div class="col-2">
                <div class="card">
                    <div class="card-header">
                        <a class="nav-link" href="<?= URL_UTAMA . '/admin/index.php' ?>">Dashboard</a>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a class="nav-link" href="<?= URL_UTAMA . '/admin/tambahkat.php' ?>">Kategori</a></li>
                        <li class="list-group-item active"><a class="nav-link" href="<?= URL_UTAMA . '/admin/tambahbrg.php' ?>">Barang</a></li>
                        <li class="list-group-item"><a class="nav-link" href="<?= URL_UTAMA . '/admin/transaksi.php' ?>">Transaksi</a></li>
                        <li class="list-group-item"><a class="nav-link" href="<?= URL_UTAMA . '/logout.php' ?>">Logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-4">
                <div class="card w-80" >
                    <div class="card-body">
                        <form class="row g-2" method="POST" action="" enctype="multipart/form-data">
                        <?php 
                        $id_barang = $_GET['barang_id'];
                        $queryBarang = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang = $id_barang");
                        while ($dataBarang = mysqli_fetch_object($queryBarang)) { ?>
                            
                            <input type="hidden" name="id_barang" value="<?= $dataBarang->id_barang; ?>">
                            <!-- nama kategori -->
                            <div class="col-sm-12">
                                <label for="kategori" class="form-label">Pilih Kategori</label>
                                <select class="form-select" name="kategori" id="kategori" aria-label="Default select example">
                                    <option>Pilih Kategori</option>
                                    <?php 
                                    $query = mysqli_query($koneksi, "SELECT * FROM kategori");
                                    while ($data = mysqli_fetch_object($query)) { ?>
                                        <?php 
                                        if ($dataBarang->id_kategori == $data->id_kategori) : ?>
                                            <option value="<?= $data->id_kategori; ?>" selected><?= $data->nama_kategori; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $data->id_kategori; ?>"><?= $data->nama_kategori; ?></option>
                                        <?php endif;?>
                                    <?php 
                                    } ?>
                                </select>
                            </div>

                            <!-- nama barang -->
                            <div class="col-md-12">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" id="nama_barang" value="<?= $dataBarang->nama_barang; ?>">
                            </div>
                            <!-- harga barang -->
                            <div class="col-md-12">
                                <label for="harga_barang" class="form-label">Harga Barang</label>
                                <input type="number" class="form-control" name="harga_barang" id="harga_barang" value="<?= $dataBarang->harga_barang; ?>">
                            </div>
                            <!-- foto -->
                            <div class="col-md-12">
                                <label for="gambar" class="form-label">Upload Gambar</label><br>
                                <img src="<?= URL_UTAMA . '/foto/'. $dataBarang->gambar; ?>" style="width:100px;height:100px;" class="rounded"><br><br>
                                <input class="form-control" type="file" name="file" id="gambar">
                            </div>

                            <?php } ?> 
                            
                            <div class="col-md-12">
                                <button type="submit" name="edit" class="btn btn-pesan btn-success pt-2 pb-2 my-2">Edit Barang</button>
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
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($koneksi,"SELECT b.id_barang,b.nama_barang,k.nama_kategori,b.harga_barang,b.gambar FROM barang as b
                                    INNER JOIN kategori as k ON k.id_kategori = b.id_kategori");
                                    $index = 1;
                                    while ($data = mysqli_fetch_object($query)) { ?>
                                        <tr>
                                            <td><?= $index++; ?></td>
                                            <td><?= $data->nama_barang; ?></td>
                                            <td><button class="btn btn-sm btn-primary"><?= $data->nama_kategori; ?></button></td>
                                            <td><?= $data->harga_barang; ?></td>
                                            <td>
                                                <img src="<?= URL_UTAMA . '/foto/'. $data->gambar; ?>" style="width:100px;height:100px;" class="rounded">
                                            </td>
                                            <td>
                                                <a href="editbrg.php?barang_id=<?= $data->id_barang; ?>" class="btn btn-warning btn-sm">Edit</a> | 
                                                <a href="hapus.php?barang=<?= $data->id_barang; ?>" class="btn btn-danger btn-sm"> Hapus</a>
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
<?php 

?>
<?php include '../footer.php'; ?>
<?php
if (isset($_POST['edit'])) {
    $id_barang        = $_POST['id_barang'];
    $id_kategori      = $_POST['kategori'];
    $nama_barang      = $_POST['nama_barang'];
    $harga_barang     = $_POST['harga_barang'];
    $randomCode       = bin2hex(random_bytes(3)); 

    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $namaFoto = $_FILES['file']['name'];
    $x = explode('.', $nama_barang);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    
    if ($ukuran < 1044070) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], '../foto/' . $_FILES["file"]["name"])) {
            $query =    mysqli_query($koneksi, "UPDATE barang SET id_kategori = '$id_kategori', 
                                        nama_barang = '$nama_barang', harga_barang = '$harga_barang', 
                                        gambar = '$namaFoto' WHERE id_barang = $id_barang");
            if ($query) {
                echo'<script type="text/javascript">window.location.href= "tambahbrg.php";</script>';
            } else {
                echo 'Data gagal tersimpan';
            }
        }else{
            echo "gagal upload file";
        }
        
    } else {
        echo '<script type="text/javascript">alert("Ukuran file terlalu besar");window.location.href= "index.php";</script>';
    }
}
?>