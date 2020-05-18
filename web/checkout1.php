<?php
session_start();
require_once('../connection/connection.php');
//print_r($_SESSION['Receiver']);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Cake House 帶給你最天然健康的幸福滋味">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">

    <title>
        Cake House : 帶給你最天然健康的幸福滋味
    </title>

    <meta name="keywords" content="">

    <?php require_once('template/head_files.php'); ?>



</head>

<body>
<?php require_once('template/navbar.php'); ?>

    <!-- *** NAVBAR END *** -->

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">首頁</a>
                        </li>
                        <li>結帳 - 填寫收件者資料</li>
                    </ul>
                </div>

                <div class="col-md-9" id="checkout">

                    <div class="box">
                        <form method="post" action="checkout2.php">
                            <h1>結帳</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li class="active"><a href="#"><i class="fa fa-map-marker"></i><br>填寫收件者資料</a>
                                </li>
                                <li class="disabled"><a href="#"><i class="fa fa-truck"></i><br>選擇取貨方式</a>
                                </li>
                                <li class="disabled"><a href="#"><i class="fa fa-money"></i><br>選擇付款方式</a>
                                </li>
                                <li class="disabled"><a href="#"><i class="fa fa-eye"></i><br>訂單確認</a>
                                </li>
                            </ul>

                            <div class="content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="firstname">姓名</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $_SESSION['member']['name']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                  <div id="twzipcode">
                                    <div class="col-sm-6 col-md-2">
                                        <div class="form-group">
                                            <label for="zipcode">郵遞區號</label>
                                            <input type="text" class="form-control" id="zipcode" name="zipcode">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-2">
                                        <div class="form-group">
                                            <label for="county">縣市</label>
                                            <select class="form-control" id="county" name="county"></select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-2">
                                        <div class="form-group">
                                            <label for="district">區域</label>
                                            <select class="form-control" id="district" name="district"></select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="address">地址</label>
                                            <input type="text" class="form-control" id="address" name="address">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone">手機</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $_SESSION['member']['mobile']; ?>">
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- /.row -->
                            </div>

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="basket.html" class="btn btn-default"><i class="fa fa-chevron-left"></i>回購物車</a>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary">下一步<i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col-md-9 -->

                <div class="col-md-3">
                    <div class="box" id="order-summary">
                        <div class="box-header">
                            <h3>訂單總計</h3>
                        </div>
                        <p class="text-muted">購物滿2000免運費，只限台灣本島，離島需加上稅金與運費</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>商品總計</td>
                                        <th>$NT <?php echo $_SESSION['TotalPrice']; ?></th>
                                    </tr>
                                    <tr>
                                        <td>運費</td>
                                        <!--滿2000免運，再echo出運費前寫入判別式分辨總金額價位。-->
                                        <?php if ($_SESSION['TotalPrice'] > 2000){ ?>
                                            <th>$NT 0</th>
                                        <?php }else{ ?>
                                            <th class="shipping">$NT 0</th>                          
                                        <?php } ?>
                                    </tr>
                                    <tr class="total">
                                        <td>總金額</td>
                                        <th id="totalprice">$NT </th> <!--這個金額只是先隨便打，之後會改-->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

        <?php require_once('template/footer.php'); ?>
        <script src="../js/jquery.twzipcode.min.js"></script>                    
        <script>
        $(function(){
            // $zipcode = $('input[name="zipcode"]').text();
            // $county = $('select[name="county"]').text();
            // $district = $('select[name="county"]').value();
            // if($zipcode == null) $zipcode = '106';
            // if($county == null) $county = '臺北市';
            // if($district == null) $district = '大安區';
            $('#twzipcode').twzipcode({
                'zipcodeSel'  : '<?php echo $_SESSION['member']['zipcode']; ?>', // 此參數會優先於 countySel, districtSel
                'countySel'   : '<?php echo $_SESSION['member']['county']; ?>',
                'districtSel' : '<?php echo $_SESSION['member']['district']; ?>'
            });
            $('#twzipcode').find('select[name="county"]').eq(1).remove();
            $('#twzipcode').find('select[name="district"]').eq(1).remove();
            $('#twzipcode').find('input[name="zipcode"]').eq(1).remove();
        });
        
        </script>




</body>

</html>