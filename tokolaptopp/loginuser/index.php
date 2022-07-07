<?php
session_start();
include '../koneksi.php';
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
    <div class="container d-flex justify-content-center" style="margin-top:150px">
        <div class="card">
            <h2 class="text-center mt-3">Login User</h2>
            <div class="card-body">
                <form action="" method="POST">
                <?php
                if (!empty($_GET['alert'])) { ?>
                    <div class="mb-3"> 
                    <div class="alert alert-danger" role="alert">
                        Username atau password salah !!
                    </div>
                </div>
                <?php }
                ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="username" class="form-control" name="username" id="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <button type="submit" name="submitlogin" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>
<?php
if (isset($_POST['submitlogin'])) {
    // var_dump($_POST);die;
    $nama = $_POST['username'];
    $pass = md5($_POST['password']);
    $cekUser = mysqli_query($koneksi, "SELECT * FROM users  WHERE username = '$nama' AND password = '$pass'");

    if (mysqli_num_rows($cekUser) > 0) {
        
        $data = mysqli_fetch_assoc($cekUser);

        if ($data['level'] == 'user') {
            $_SESSION['username']   = $data['username'];
            $_SESSION['level']      = "user";
            header("location: ../index.php");
            
        }else{
            header("location: ./index.php?alert=gagal");
        }
    }else{
        header("location: ./index.php?alert=gagal");
    }
}

?>
