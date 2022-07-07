<?php 
include 'header.php';
if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":
            if(!empty($_POST["jumlahbrg"])) {
                $dataBarangById = mysqli_query($koneksi,"SELECT * FROM barang WHERE code = '" . $_GET['code'] . "'");
                $listBarang = [];
                while ($data = mysqli_fetch_assoc($dataBarangById)) {
                    $listBarang[] = $data;
                }
                $itemBarang = array($listBarang[0]["code"]=>
                    array(
                        'id_barang'     =>  $listBarang[0]["id_barang"],
                        'code'          =>  $listBarang[0]["code"], 
                        'nama_barang'   =>  $listBarang[0]["nama_barang"], 
                        'jumlahbrg'     =>  $_POST["jumlahbrg"], 
                        'harga_barang'  =>  $listBarang[0]["harga_barang"], 
                        'gambar'        =>  $listBarang[0]["gambar"])
                    );
                    // var_dump($itemBarang);
                if(!empty($_SESSION["item_barang"])) {
                    if(in_array($listBarang[0]["code"],array_keys($_SESSION["item_barang"]))) {
                        foreach($_SESSION["item_barang"] as $key => $value) {
                                if($listBarang[0]["code"] == $key) {
                                    if(empty($_SESSION["item_barang"][$key]["jumlahbrg"])) {
                                        $_SESSION["item_barang"][$key]["jumlahbrg"] = 0;
                                    }
                                    $_SESSION["item_barang"][$key]["jumlahbrg"] += $_POST["jumlahbrg"];
                                }
                        }
                    } else {
                        $_SESSION["item_barang"] = array_merge($_SESSION["item_barang"],$itemBarang);
                    }
                } else {
                    $_SESSION["item_barang"] = $itemBarang;
                }
            }
        break;
        case "remove":
            if(!empty($_SESSION["item_barang"])) {
                foreach($_SESSION["item_barang"] as $k => $v) {
                        if($_GET["code"] == $k)
                            unset($_SESSION["item_barang"][$k]);				
                        if(empty($_SESSION["item_barang"]))
                            unset($_SESSION["item_barang"]);
                }
            }
        break;
        case "empty":
            unset($_SESSION["item_barang"]);
        break;	
    }
}
?>
    <div class="container mt-5">
        <div class="row">
            <!-- KATEGORI -->
            <div class="col-md-3">
                <div class="card border-0">
                    <div class="card-body">
                        <?php
                        if (!empty($_SESSION['username'])) { ?>
                            <div class="alert alert-info" role="alert">
                                Selamat Datang <strong><?= $_SESSION['username']; ?> !!</strong>
                            </div>
                        <?php }
                        ?>
                        <ul class="list-group">
                            <li class="list-group-item bg-success text-white" aria-current="true">Kategori Barang</li>
                            <?php 
                            $query = mysqli_query($koneksi,"SELECT * FROM kategori");
                            while ($data = mysqli_fetch_object($query)) { ?>
                            <li class="list-group-item"><?= $data->nama_kategori; ?></li>
                            <?php }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- SEMUA BARANG -->
            <div class="col-md-9">
                <div class="card border-0">
                    <div class="card-body">
                        <h3>List Barang</h3>
                        <div class="row row-cols-1 row-cols-md-3 g-3">
                        <?php
                            $listBarang = [];
                            $query = mysqli_query($koneksi,"SELECT * FROM barang");
                            while ($data = mysqli_fetch_assoc($query)) {
                            $listBarang[] = $data;
                            }
                            foreach ($listBarang as $key => $value) { ?>
                            <form action="index.php?action=add&code=<?= $listBarang[$key]["code"]; ?>" method="post">
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="<?= URL_UTAMA . '/foto/'.$listBarang[$key]["gambar"]; ?>" class="card-img-top" style="height:250px;">
                                        <div class="card-body">
                                            <input type="hidden" name="id_barang" value="<?= $listBarang[$key]["id_barang"]; ?>">
                                            <h5 class="card-title"><?= $listBarang[$key]["nama_barang"]; ?></h5>
                                                <div class="row mt-2 mb-2">
                                                    <div class="col-sm-6">
                                                        <label for="rupiah" class="col-form-label">Rp. <?= $listBarang[$key]["harga_barang"]; ?></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="number" name="jumlahbrg" min="1" value="1" id="jumlahbrg" class="form-control" aria-describedby="jumlahbrg">
                                                    </div>
                                                </div>
                                                <?php
                                                if (empty($_SESSION['username'])) {
                                                    echo '<input type="submit" value="Login Untuk Belanja!" class="btn btn-primary" disabled>';
                                                }else{
                                                    echo '<input type="submit" value="Add to cart" class="btn btn-primary">';
                                                }
                                                ?>
                                        </div>
                                    </div>                         
                                </div>
                            </form>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php include 'footer.php'; ?>