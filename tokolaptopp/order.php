<?php 
include 'header.php'; 
if (empty($_SESSION['level'] == "user")) {
    header("location: ./index.php");
}
if (!empty($_GET['hapus'])) {
    foreach($_SESSION["item_barang"] as $key => $val) {
        if($_GET["hapus"] == $key){
            unset($_SESSION["item_barang"][$key]);	
            header('location: order.php');			
        }
    }
}
if (empty($_SESSION["item_barang"])) {
    echo '<script type="text/javascript">alert("item kosong");window.location.href= "index.php";</script>';
}
?>


<div class="container">
    <h1 class="order">Order Detail</h1>
        <form action="" method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nomor</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Harga/Barang</th>
                        <th scope="col">Jumlah Unit</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $data = $_SESSION["item_barang"];
                    $total_quantity = 0;
                    $total_price = 0;
                    $index = 1;
                    foreach ($data as $key) { 
                        $item_price = $key["jumlahbrg"] * $key["harga_barang"]; ?>
                    <tr>
                        <th scope="row"><?= $index++; ?></th>
                        <td><?= $key['nama_barang']; ?></td>
                        <td><?= $key['harga_barang']; ?></td>
                        <td><?= $key['jumlahbrg']; ?></td>
                        <td><?= $item_price; ?></td>
                        <td><a href="order.php?hapus=<?= $key['code']; ?>" class="btn btn-danger btn-sm"> Hapus</a></td>
                    </tr>
                    <?php 
                        $total_quantity += $key["jumlahbrg"]; 
                        $total_price += ($key["harga_barang"]*$key["jumlahbrg"]);
                    }
                    if ($data) { ?>
                        <tr>
                            <td colspan="3">Total Pembayaran</td>
                            <td colspan="1"><strong><?= $total_quantity; ?> Unit</strong></td>
                            <td colspan="2"><strong>Rp. <?=$total_price;?> </strong></td>
                        </tr>
                    <?php }else{ ?>
                       <tr>
                           <td colspan="2"></td>
                           <td colspan="4">Tidak ada barang belanja</td></tr>
                    <?php }
                    ?>
                        
                </tbody>
            </table>
                <a class="btn btn-default" href="index.php" role="button"><i class="fa fa-arrow-left"></i> << Kembali Belanja</a>
                <?php 
                if ($data) {
                    echo '<a class="btn btn-success" href="payment.php" role="button">Bayar Pesanan<i class="fa fa-arrow-right"></i></a>';
                }else{
                    echo '<button class="btn btn-success" disabled>Bayar Pesanan</button>';
                }
                ?>
        </form>
</div>

<?php include 'footer.php'; ?>