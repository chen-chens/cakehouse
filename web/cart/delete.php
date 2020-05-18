<?php
session_start();
$iu= $_GET['cart_id'];
unset($_SESSION['Cart'][$iu]);
$_SESSION['Cart'] = array_values($_SESSION['Cart']); //如果刪除後要重新計算array[]，避免刪除後array[0][1][2]沒接上造成錯誤。

header('Location: ../basket.php?Del=true');


?>