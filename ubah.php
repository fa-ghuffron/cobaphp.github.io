<?php
require 'function.php';
session_start();
if(!isset($_SESSION["login"])){
    header("location: login.php");
    exit;
}

//ambil data di url
$id = $_GET["id"];

//query data buah berdasarkan id
$fruit = query("SELECT * FROM buah WHERE id = $id")[0];

//mengecek atakah tombol submit sudah di tekan
if (isset($_POST["submit"])) {

//mengecek data berhasil di tambahkan atau tidak
if(ubah($_POST) > 0){
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
    <title>ubah</title>
</head>
<body>
    <h1>ubah data</h1>

    
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $fruit["id"];?>">
        <input type="hidden" name="gambarlama" value="<?= $fruit["gambar"];?>">
        <ul>
            <li>
                <label for="nama">buah :</label>
                <input type="text" name="nama" id="nama" value="<?= $fruit["nama"];?>">
            </li>
            <li>
                <label for="jenis">jenis :</label>
                <input type="text" name="jenis" id="jenis" value="<?= $fruit["jenis"];?>" >
            </li>
            <li>
                <label for="harga">harga :</label>
                <input type="text" name="harga" id="harga" value="<?= $fruit["harga"];?>" >
            </li>
            <li>
                <label for="stok">stok :</label>
                <input type="text" name="stok" id="stok" value="<?= $fruit["stok"];?>" >
            </li>
            <li>
                <label for="gambar">gambar :</label>
                <br>
                <img src="buah/<?= $fruit["gambar"];?>" width="40">
                <br>
                <input type="file" name="gambar" id="gambar" >
            </li>
            <li>
                <button type="submit" name="submit"> ubah data!</button>
            </li>
        </ul>
    </form>
</body>
</html>