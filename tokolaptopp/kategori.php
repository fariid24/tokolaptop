<?php include 'header.php';?>

    <div class="container mt-5">
        <div class="row row-cols-1 row-cols-md-4 g-3">
        <?php 
            $query = mysqli_query($koneksi,"SELECT * FROM kategori");
            while ($data = mysqli_fetch_object($query)) { ?>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= $data->nama_kategori; ?></h5>
                    </div>
                </div>
            </div>
            <?php }
            ?>
            
        </div>
    </div>
    
<?php include 'footer.php'; ?>