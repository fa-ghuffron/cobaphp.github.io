<?php
//ambil data database
$conn = mysqli_connect("localhost", "root", "", "belajar");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows=[];
    while( $row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data){
    global $conn;
    //ambil data tiap elemen di form
    $nama = htmlspecialchars($data["nama"]);
    $jenis = htmlspecialchars($data["jenis"]);
    $harga = htmlspecialchars($data["harga"]);
    $stok = htmlspecialchars($data["stok"]);

    $gambar = upload();
    if ( !$gambar ){
        return false;
        }
    
    //query insert data ke table
    $query = "INSERT INTO buah VALUES
    ('', '$nama', '$harga', '$jenis', '$stok', '$gambar')"; //harus sama dengan urutan table di database

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword){
    $query = "SELECT * FROM buah
             WHERE
             nama LIKE  '%$keyword%' OR
             harga LIKE  '%$keyword%' OR
             stok LIKE  '%$keyword%' OR
             jenis LIKE  '%$keyword%'
             ";
    return query($query);
}

function upload(){
    
    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmp = $_FILES['gambar']['tmp_name'];

    //apakah sudah memasukan gambar
    if ($error === 4){
        echo "<script>
            alert('anda tidak memasukan gambar >:I');
        </script>";
        return false;
    }

    //apakah yang di input adalah gambar
    $ekstensivalid = ['jpeg','png','jpg'];
    $ekstensiin = explode('.', $namafile);
    $ekstensiin = strtolower(end($ekstensiin));
    if ( !in_array($ekstensiin, $ekstensivalid)){
        echo "<script>
            alert('yang anda masukan bukan gambar >:I');
        </script>";
        return false;
    }

    //apakah gambar yang di input terlalu besar
    if($ukuranfile > 1000000){
        echo  "<script>
        alert('gambar terlalu besar ._.');
    </script>";
    return false;
    }

    //cek apakah nama file sama dengan yang sudah ada, jika iya akan di ubah
    $namafilebaru = uniqid().'.'.$ekstensiin;

    //lolos di cek, upload
    move_uploaded_file($tmp, 'buah/'.$namafilebaru);

    return $namafilebaru;

}












function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM buah WHERE id = $id");

    return mysqli_affected_rows($conn);
}









function ubah($data){
    global $conn;
    //ambil data tiap elemen di form
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $jenis = htmlspecialchars($data["jenis"]);
    $harga = htmlspecialchars($data["harga"]);
    $stok = htmlspecialchars($data["stok"]);
    $gambarlama  = htmlspecialchars($data["gambarlama"]);

    //apakah user merubah gambar atau tidak
    if( $_FILES['gambar']['error'] === 4){
        $gambar = $gambarlama;
    }
    else{
        $gambar = upload();
    }

    //query insert data ke table
    $query = "UPDATE buah SET
    nama = '$nama',
    harga = '$harga',
    jenis = '$jenis',
    stok = '$stok',
    gambar= '$gambar' 
    WHERE id = $id 
    ";
    //('', '$nama', '$harga', '$jenis', '$stok', '$gambar')"; //harus sama dengan urutan table di database

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function registrasi($data) {
    global $conn;

    $username = strtolower(stripcslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    //cek apakah username sudah di gunakan
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    if( mysqli_fetch_assoc($result) ){
        echo "<script>
            alert ('usename telah terdaftar! coba yang lain');
        </script>";
        return false;
    }

    
    //cek konfirmasi password
    if ($password !== $password2){
        echo "<script>
            alert ('konfirmasi tidak sesuai! coba lagi');
        </script>";
        return false;
    }

    //enkrisi password(mengamankan)
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    //tambahkan user ke database
    mysqli_query($conn, "INSERT INTO users VALUES ('','$username','$password')");

    return mysqli_affected_rows($conn);
}
?>