<?php
session_start();
if(!isset($_SESSION["login"])){
    header("location: login.php");
    exit;
}

require 'function.php';

if (isset($_POST["submit"])) {

//mengecek data berhasil di tambahkan atau tidak
if(tambah($_POST) > 0){
    echo "
    <script>
        alert('berhasil!');
        document.location.href ='index.php';
    </script>
    ";
}
else{
    echo "
    <script>
        alert('gagal :(');
        document.location.href ='index.php';
    </script>
    ";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah</title>
</head>
<body>
    <h1>tambah data</h1>

    
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama">nama :</label>
                <input type="text" name="nama" id="nama">
            </li>
            <li>
                <label for="jenis">jenis :</label>
                <input type="text" name="jenis" id="jenis">
            </li>
            <li>
                <label for="harga">harga :</label>
                <input type="text" name="harga" id="harga">
            </li>
            <li>
                <label for="stok">stok :</label>
                <input type="text" name="stok" id="stok">
            </li>
            <li>
                <label for="gambar">gambar :</label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit"> tambah data!</button>
            </li>
        </ul>
    </form>
</body>
</html>