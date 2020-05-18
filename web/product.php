<?php 
session_start();
require_once('../connection/connection.php');  
unset($_SESSION['Cart']);

$query = $db->query("SELECT * FROM products WHERE productID=".$_GET['productID']);
$product = $query->fetch(PDO::FETCH_ASSOC);

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


    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">首頁</a>
                        </li>
                        <li><a href="#">Ladies</a>
                        </li>
                        <li><a href="#">Tops</a>
                        </li>
                        <li>White Blouse Armani</li>
                    </ul>

                </div>

                <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">產品分類</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked category-menu">
                            <?php foreach($product_categories as $category){ ?> 
                                <li>
                                    <a href="product_list.php?categoryID=<?php echo $category['product_categoryID']; ?>"><?php echo $category['category']; ?> <span class="badge pull-right">10</span></a>
                                    
                                </li>
                            <?php } ?>
                            </ul>

                        </div>
                    </div>

                    
                    

                    <!-- *** MENUS AND FILTERS END *** -->

                    <div class="banner">
                        <a href="#">
                            <img src="../images/ad-banner.jpg" alt="sales 2014" class="img-responsive">
                        </a>
                    </div>
                </div>

                <div class="col-md-9">

                    <div class="row" id="productMain">
                        <div class="col-sm-6">
                            <div id="mainImage">
                                <img src="../uploads/products/<?php echo $product['picture']; ?>" alt="" class="img-responsive">
                            </div>
                                    <div class="ribbon new">
                                        <div class="theribbon">NEW</div>
                                        <div class="ribbon-background"></div>
                                    </div>
                             
                                <!-- /.ribbon -->
                                    <div class="ribbon sale">
                                        <div class="theribbon">SALE</div>
                                        <div class="ribbon-background"></div>
                                    </div>
                               

                        </div>
                        <div class="col-sm-6">
                            <form action="cart/add_cart1.php" method="post">
                                <div class="box">
                                    <h1 class="text-center"><?php echo $product['name']; ?></h1>
                                    <p class="goToDescription"><a href="#details" class="scroll-to">詳細介紹</a>
                                    </p>
                                    <p class="quantity"><input type="number" min="1" value="1" name="quantity" class="form-control"></p>
                                    <p class="price">$NT <?php echo $product['price']; ?></p>
                                    
                                    <p class="text-center buttons">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> 加入購物車</button> 
                                        <!-- <button type="submit" class="btn btn-default"><i class="fa fa-heart"></i> 加入願望清單</button> -->
                                    </p>
                                    <input type="hidden" name="pic" value="<?php echo $product['picture']; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                                    <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                                    <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                                </div>
                            </form>
                            <div class="row" id="thumbs">
                                <div class="col-xs-4">
                                    <a href="../uploads/products/<?php echo $product['picture']; ?>" class="thumb">
                                        <img src="../uploads/products/<?php echo $product['picture']; ?>" alt="" class="img-responsive">
                                    </a>
                                </div>
                                <div class="col-xs-4">
                                    <a href="../uploads/products/<?php echo $product['picture']; ?>" class="thumb">
                                        <img src="../uploads/products/<?php echo $product['picture']; ?>" alt="" class="img-responsive">
                                    </a>
                                </div>
                                <div class="col-xs-4">
                                    <a href="../uploads/products/<?php echo $product['picture']; ?>" class="thumb">
                                        <img src="../uploads/products/<?php echo $product['picture']; ?>" alt="" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="box" id="details">
                        <p>
                            <h4>商品介紹</h4>
                            <?php echo $product['description']; ?>
                            <blockquote>
                                <p><em>麵包與蛋糕均為當天現做，收到商品後請盡早食用完畢。</em>
                                </p>
                            </blockquote>

                            <hr>
                            <div class="social">
                                <h4>Show it to your friends</h4>
                                <p>
                                    <a href="#" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                                    <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                                    <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                                    <a href="#" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                                </p>
                            </div>
                    </div>

                    

                    

                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


       <?php require_once('template/footer.php'); ?>

<div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-labelledby="info" aria-hidden="true">
    <div class="modal-dialog modal-sm">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">訊息</h4>
            </div>
            <div class="modal-body text-center">
                <p class="text-center text-muted">成功更新數量!</p>
                <button type="button" class="btn btn-primary" data-dismiss="modal">確定</button>
            </div>
        </div>
    </div>
</div>      


<?php
  if(isset($_GET['Existed']) && $_GET['Existed'] != null){                              //判斷式:如果$_GET['Existed']存在且不為空值
    if($_GET['Existed'] == 'true'){ ?>                                                  <!--如果判斷式成立，執行以下動作:-->
     <script>
        $(function(){
            $('.modal-body>p').html('此商品已存在購物車，請至「我的購物車」修改數量。');  
            //在class="modal-body"內的第一個p標籤寫入html('字串')
            //$('.modal-body>p')指的是class="modal-body"第一個p標籤，如果變數寫$('.modal-body p')將會在class="modal-body"內所有p標籤全部執行動作。
            $('#info-modal').modal();        //modal是bootstrap的彈出試窗    
        });
     </script> 
    <?php }else{ ?>
     <script>
        $(function(){
            $('.modal-body>p').html('成功加入購物車!');
            $('#info-modal').modal();  
            // 2秒後視窗自動消失   
            setTimeout(function() {
                $('#info-modal').modal('hide');
            }, 2000);       
        });
     </script> 
   
<?php }  //End if isset
    }    //End if Existed ?>  

</body>

</html>