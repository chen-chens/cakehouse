<?php
session_start();
unset($_SESSION['Cart']);
$is_existed = "false";
//判斷商品購物車是否重覆點選(顧客可能會重覆點選-->)
if(isset($_SESSION['Cart']) && $_SESSION['Cart'] != null){             //判斷商品有無加進購物車
  for($i = 0 ; $i < count($_SESSION['Cart']); $i++){
    if($_POST['product_id'] == $_SESSION['Cart'][$i]['product_id']){
      $is_existed = "true";
      go_back($is_existed);
    }
  }
}
if($is_existed == "false"){
//將接收的商品資料存到$temp陣列
$temp['product_id']   = $_POST['product_id'];                                     
$temp['product_name'] = $_POST['product_name'];
$temp['pic']          = $_POST['pic'];
$temp['price']        = $_POST['price'];
$temp['quantity']     = $_POST['quantity'];
//將陣列資料加入到session Cart中
$_SESSION['Cart'][] = $temp;
print_r($_SESSION['Cart']);
go_back($is_existed);
}
                                                                //判斷商品如果重複加進購物車，回到上一頁(請客人去加購物數量)
function go_back($is_existed){
  $url= explode('?',$_SERVER['HTTP_REFERER']);
    $location = $url[0];
    $location.= "?productID=".$_POST['product_id'];
    $location.= "&Existed=".$is_existed;

    header(sprintf('Location: %s', $location));
}
?>