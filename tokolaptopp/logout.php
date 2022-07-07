<?php
session_start();
if ($_SESSION['username']) {
    unset($_SESSION['username'],$_SESSION['level']);
    header("location: ./index.php");
}else{
    header("location: ./index.php");
}

?>