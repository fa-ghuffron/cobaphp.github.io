<?php
require 'function.php';
session_start();


// //pagination
// //configuration
// $jumlahdataperhalaman = 2;
// $jumlahdata = count(query("SELECT * FROM buah"));
// $jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
// $halamanaktif = (isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
// $awaldata = ( $jumlahdataperhalaman * $halamanaktif ) - $jumlahdataperhalaman;

// // // ambil data dari tabel buah / query data buah
// $buah = query("SELECT * FROM buah LIMIT $awaldata,$jumlahdataperhalaman");


if( !isset($_SESSION["login"])){
    header("location: login.php");
    exit;
}
//ambil data table dari database
$buah = query("SELECT * FROM buah ");

//logika tombol pencarian 
if (isset($_POST["cari"]) ) {
    $buah = cari($_POST["keyword"]);    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .loader{
            width: 100px;
            position: absolute;
            top: 100px;
            z-index: -1;
            left: 305px;
            display: none;
        }
    </style>
</head>
<body>

<a href="logout.php">logout</a>
<br>
<h1>jenis buah</h1>

<a href="tambah.php" name="logout">tambah data buah</a>

<br>
<form action="" method="post">
    <input type="text" name ="keyword" size="40" autofocus placeholder="masukan keyword pencarian" autocomplete="off" id="keyword">
    <button type="submit" name="cari" id="tombol_S">cari!</button>

    <img src="img/loader.gif" class="loader">
</form>


<br>

<div id="container">

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>no</th>
        <th>aksi</th>
        <th>gambar</th>
        <th>buah</th>
        <th>janis buah</th>
        <th>harga</th>
        <th>stok</th>
    </tr>
    <?php $i = 1;?>
    <?php foreach($buah as $row):?>
    <tr>
        <td><?= $i;?></td>
        <td>
            <a href="ubah.php?id=<?= $row["id"];?>">ubah</a>|
            <a href="hapus.php?id=<?= $row["id"];?>" onclick="return confirm('yakin?')">hapus</a>
        </td>
        <td> <img src="buah/<?= $row["gambar"];?>" width="50"></td>
        <td><?= $row["nama"];?></td>
        <td><?= $row["harga"];?></td>
        <td><?= $row["jenis"];?></td>
        <td><?= $row["stok"];?></td>
    </tr>
    <?php $i++;?>
    <?php endforeach;?>
</table>
</div>
<script src="js/jquery-3.6.3.min.js"></script>
<script src="js/script.js"></script>
    
</body>
</html>