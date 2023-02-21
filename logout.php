<?php
session_start();
$_SESSION=[];
session_unset();
session_destroy();

setcookie('id', '', time()-8000);
setcookie('key', '', time()-8000);

header("location: login.php");
exit;
?>