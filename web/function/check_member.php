<?php
session_start();
require_once('../../connection/connection.php');
$query = $db->query("SELECT * FROM members WHERE account= '".$_POST['account']."' AND password='".$_POST['password']."'");
$has_user = $query->fetch(PDO::FETCH_ASSOC);

if($has_user > 0){
    $_SESSION['member'] = $has_user;
    header('Location: ../customer-account.php');
}else{
    header('Location: ../login_error.php?Msg=Error');
}
?>