<?php 
usleep(500000);
require '../function.php';
$keyword = $_GET["keyword"];
$query = "SELECT * FROM buah
            WHERE
            nama LIKE  '%$keyword%' OR
            harga LIKE  '%$keyword%' OR
            stok LIKE  '%$keyword%' OR
            jenis LIKE  '%$keyword%'
            ";
$buah = query($query);

?>

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