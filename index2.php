<?php
session_start();
if ( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

// koneksi ke database
require 'function.php';

// pagination
// konfigurasi
    $jumlahdataperhalaman = 2;
    $jumlahdata = count(query("SELECT * FROM buah"));
    $jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
// round () membulatkan bilangan pecahan ke desimal terdekatnya & flour () membulatan nya ke bawah/lantai berapapun nilai pecahannya & ceil membulatkan bilangan ke atas atau langit-langit
    $halamanaktif = (isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
// halaman = 2, awaal data = 3
    $awaldata = ( $jumlahdataperhalaman * $halamanaktif ) - $jumlahdataperhalaman;

// ambil data dari tabel buah / query data buah
    $buah = query("SELECT * FROM buah LIMIT $awaldata,$jumlahdataperhalaman");

// tombol cari ditekan
if (isset($_POST["Serch"])) {
    $buah = Serch($_POST["keyword"]);
}

// ambil data (feth) buah dari objek result 
// mysqli_fetch_row() // mengembalikan array numerik,memakai angka[1];
// mysqli-fetch_assoc() // mengembalikan array associative memakai variable/stirng [""];
// mysqli_fetch_array() // bisa memakai angka atau variable/string ["sting"] [angka],kekurangan nya data yg disajikan double 
// mysqli_fetch_object() //

//  while ($mhs = mysqli_fetch_assoc($result) ) {
    // var_dump($mhs["nama"]);
//  }
// 
// ketika kita melakukan query mysql query akan mengembalikan 2 hal jika berhasil maka query akan dilakukan dan mengembalikan nilai true jika gagal maka fungsi ini tidak akan menjalankan query tapi mengembalikan nilai false

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hallo</title>
</head>
<body>

    <a href="logout.php">Logout</a>

    <h1>Daftar buah</h1>
    
    <a href="tambah.php">Tambah data buah</a>
    <br></br>

    <form action="" method="post">
    <input type="text" name="keyword" size="20" autofocus placeholder="Serch keyword.." autocomplete="off">
    <button type="submit" name="Serch">Serch</button>

    </form>
<br>
    <!-- navigasi -->

    <?php if($halamanaktif > 1) : ?>
    <a href="?halaman=<?= $halamanaktif - 1; ?>">&laquo;</a>
    <!-- &lt/&laquo singkatan lebih kecil dari -->
        <?php endif; ?>

<?php for($i = 1;$i <= $jumlahhalaman; $i++ ) : ?>
    <?php if ($i == $halamanaktif) : ?>
        <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
            <!-- a href bisa menggunakan index.php -->
                <?php else: ?>
                    <a href="?halaman=<?= $i; ?>"><?= $i; ?></a> 
    <?php endif; ?>
<?php endfor; ?> 

<?php if($halamanaktif < $jumlahhalaman ) : ?>
   <a href="?halaman=<?= $halamanaktif + 1; ?>">&raquo;</a>
   <!-- &gt/&raquo singkatan lebih besar dari atau gratedan -->
       <?php endif; ?>

    <br>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>NRP</th>
        <th>Nama</th>
        <th>Email</th>
        <th>jurusan</th>
    </tr>
    <?php $i =1; ?>
    <?php foreach($buah as $jad) : ?>
        <tr>
        <td><?= $jad ["id"]; ?></td>
        <td>
            <a href="ubah.php?id=<?= $jad["id"]; ?>">edit</a> | 
            <a href="hapus.php?id=<?= $jad["id"]; ?>" onclick="return confirm('yakin?')">delete</a>
        </td>
        <td><img src="img/<?= $jad ["gambar"]; ?>" width="70"></td>
        <td><?= $jad["nrp"]; ?></td>   
        <td><?= $jad ["nama"]; ?></td>
        <td><?= $jad ["email"]; ?></td>
        <td><?= $jad ["jurusan"]; ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
</table>
    
</body>
</html>