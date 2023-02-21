<?php 
session_start();
if(!isset($_SESSION["login"])){
    header("location: index.php");
    exit;
}
require 'function.php'; 

$id = $_GET["id"];

if( hapus($id) > 0){
    echo"
    <script>
        alert(' berhasil di hapus :D ');
        document.location.href = 'index.php';
    </script>
    ";
}
else{
    echo"
    <script>
        alert(' gagal di hapus :( ');
        document.location.href = 'index.php';
    </script>
    ";
}
?>