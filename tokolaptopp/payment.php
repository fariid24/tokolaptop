<?php
include 'header.php';
if (empty($_SESSION['level'] == "user")) {
    header("location: ./index.php");
}
?>
<div class="container d-flex justify-content-center mt-5">
    <div class="card w-50">
        <div class="card-body">
            <form action="payment.php" method="post" class="row g-2" >
                <div class="col-md-6">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email">
                </div>
                <div class="col-md-12">
                    <h4>Barang Belanja</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Barang</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga/unit</th>
                                <!-- <th scope="col">Harga total</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $data = $_SESSION["item_barang"]; 
                        $pjgData = count($data);
                        $index=1;
                        $katloop=0;
                        $total_price=0;
                        $total_quantity=0;
                        $brgloop=0;
                        foreach ($data as $key) {    
                            $item_price = $key["jumlahbrg"]*$key["harga_barang"];    
                        ?>
                        <tr>
                                <th scope="row"><?= $index++;?></th>
                                <input type="hidden" name="id_barang<?= $katloop++;?>" value="<?= $key["id_barang"]; ?>">
                                <td><?= $key["nama_barang"]; ?></td>
                                <input type="hidden" name="jumlahbrg" value="<?= $key["jumlahbrg"]; ?>">
                                <td><?= $key["jumlahbrg"]; ?></td>
                                <td><?= $key["harga_barang"]; ?></td>
                                <input type="hidden" name="harga_total<?= $brgloop++;?>" value="<?= $item_price; ?>">
                            </tr>
                        <?php 
                        $total_quantity += $key["jumlahbrg"]; 
                        $total_price += ($key["harga_barang"]*$key["jumlahbrg"]);
                        }
                        ?>  
                            <tr>
                                <td colspan="1"></td>
                                <td rowspan="1" colspan="2" ><strong>Total Biaya </strong></td>
                                <td colspan="2"><strong><?= $total_price; ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <button type="submit" name="bayar" class="btn btn-primary">Bayar Sekarang</button>
                    <a href="order.php" class="btn btn-light"><< Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST["bayar"])) {
    // AMBIL DATA DARI SUBMIT FORM
    $nama_lengkap   = $_POST['nama_lengkap'];
    $email          = $_POST['email'];
    $waktu          = date('Y-m-d H:i:s');

    // BIKIN ARRAY BARU UNTUK MENAMPUNG DARI FORM SBLM DI INSERT DATABASE
    $id_barang      = [];
    $harga_barang   = [];
    
    // LOOPING INSERT KE ARRAY BARU => id_barang & harga_barang
    $loopidbrg1 = 0;
    $loopidhrg1 = 0;
    for ($index=0; $index < $pjgData; $index++) { 
        array_push($id_barang,$_POST["id_barang".$loopidbrg1++]);
        array_push($harga_barang,$_POST["harga_total".$loopidhrg1++]);
    }

    // LOOPINNG INSERT DATABASE
    $loopidbrg2 = 0;
    $loopidhrg2 = 0;
    for ($index=0; $index < $pjgData; $index++) { 
        $query = "INSERT INTO transaksi (`nama_lengkap`, `email`, `id_barang`, `tgl_transaksi`, `total`) VALUES ('$nama_lengkap', '$email', '".$id_barang[$loopidbrg2++]."', '$waktu' ,'".$harga_barang[$loopidhrg2++]."');";
        if (mysqli_query($koneksi,$query)) {
            unset($_SESSION['item_barang']);
            echo '<script type="text/javascript">window.location.href= "index.php";</script>';
        }else{
            echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
    }
}
?>