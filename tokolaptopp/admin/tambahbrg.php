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
                                <!-- nama kategori -->
                                <div class="col-sm-12">
                                    <label for="kategori" class="form-label">Pilih Kategori</label>
                                    <select class="form-select" name="kategori" id="kategori" aria-label="Default select example">
                                        <option>Pilih Kategori</option>
                                        <?php 
                                        $query = mysqli_query($koneksi, "SELECT * FROM kategori");
                                        while ($data = mysqli_fetch_object($query)) { ?>
                                            <option value="<?= $data->id_kategori; ?>"><?= $data->nama_kategori; ?></option>
                                        <?php }
                                        ?>
                                        
                                    </select>
                                </div>
                                <!-- nama barang -->
                                <div class="col-md-12">
                                    <label for="nama_barang" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Laptop/Monitor">
                                </div>
                                <!-- harga barang -->
                                <div class="col-md-12">
                                    <label for="harga_barang" class="form-label">Harga Barang</label>
                                    <input type="number" class="form-control" name="harga_barang" id="harga_barang" placeholder="55000">
                                </div>
                                <!-- foto -->
                                <div class="col-md-12">
                                    <label for="gambar" class="form-label">Upload Gambar</label>
                                    <input class="form-control" type="file" name="file" id="gambar">
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" name="tambah" class="btn btn-pesan btn-success pt-2 pb-2 my-2">Tambah Barang</button>
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
if (isset($_POST['tambah'])) {
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
            $query =    mysqli_query($koneksi,"INSERT INTO barang (`id_kategori`, `code`, `nama_barang`, `harga_barang`, `gambar`) 
            VALUES ('$id_kategori','$randomCode', '$nama_barang','$harga_barang','$namaFoto')");
            if ($query) {
                echo '<script type="text/javascript">window.location.href= "tambahbrg.php";</script>';
            } else {
                echo 'Data gagal tersimpan';
            }
        }else{
            echo "gagal";
        }
        
    } else {
        echo '<script type="text/javascript">alert("Ukuran file terlalu besar");window.location.href= "index.php";</script>';
    }
}
?>