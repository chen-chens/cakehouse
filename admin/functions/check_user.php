<?php
session_start();
require_once('../../connection/connection.php');
$query = $db->query("SELECT * FROM admins WHERE account= '".$_POST['account']."' AND password='".$_POST['password']."'");
$has_user = $query->fetch(PDO::FETCH_ASSOC);

if($has_user > 0){
    $_SESSION['user'] = $has_user['account'];
    header('Location: ../news/list.php');
}else{
    header('Location: ../login.php?Msg=Error');
}
?>