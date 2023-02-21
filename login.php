<?php 
session_start();
require 'function.php';

//cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    //ambil username berdasar kan id
    $result = mysqli_query($conn, "SELECT username FROM users WHERE id = '$id' ");
    $row = mysqli_fetch_assoc($result);

    if($key === hash('sha256', $row['username'])){
        $_SESSION['login'] = true;
    }

}

if(isset($_SESSION["login"])){
    header("location: index.php");
    exit;
}

if(isset($_POST["login"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    //cek username 
    if(mysqli_num_rows($result) === 1 ){

        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])){
            //set session
            $_SESSION["login"] = true;



            if( isset($_POST['remember']) ){
                //buat cookie
                setcookie('id', $row['id'], time() + 60 * 60 * 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60 * 60 * 60);
            }


            header("Location: index.php");
            exit;
        }
    }

    $err = true;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
<h1>login</h1>

<?php if (isset($err)):?>

<p style="color: red; font-style: italic;">salah yo</p>

<?php endif;?>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">username :</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">password :</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me!</label>
            </li>
            <li>
                <button type="submit" name="login">sign in!</button>
            </li>
            <br>
            <li>
                <p>don't have account?<a href="register.php">sign up!</a></p>
            </li>
        </ul>
    </form>
</body>
</html>