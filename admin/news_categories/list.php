<?php require_once('../functions/login_check.php'); ?>
<?php require_once('../../connection/connection.php'); ?>
<?php
$limit = 5;
if(isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page =1;
}

$start_from = ($page-1) * $limit;
$query = $db->query("SELECT * FROM news_categories LIMIT ".$start_from.",".$limit);
$all_news_category = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<?php require_once('../layouts/head.php'); ?>
<body style="">
<?php require_once('../layouts/navbar.php'); ?>
  <div class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h1>最新消息分類管理</h1>
            </div>
            <div class="card-body">
              <ul class="breadcrumb mb-2">
                <li class="breadcrumb-item"> <a href="#">首頁</a> </li>
                <li class="breadcrumb-item active">最新消息分類管理</li>
              </ul>
              <div class="row">
                <div class="col-md-12 my-3"><a class="btn btn-primary" href="create.php">新增一筆</a></div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">分類名稱</th>
                      <th scope="col" width="20%">操作</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($all_news_category as $news_category){ ?>
                    <tr>

                      <td>
                      <a href="../news/list.php?categoryID=<?php echo $news_category['news_categoryID']; ?>">
                      <?php echo $news_category['category']; ?>
                      </a>
                      </td>
                      <td>
                        <a class="btn btn-secondary" href="edit.php?gnews_categoryID=<?php echo $news_category['news_categoryID']; ?>"><i class="fa fa-pencil-square-o fa-fw"></i>&nbsp;編輯</a>
                        <a class="btn btn-secondary ml-2" onclick="if(!confirm('是否確定刪除此筆資料?刪除後無法回復')){return false;};" href="delete.php?gnews_categoryID=<?php echo $news_category['news_categoryID']; ?>"><i class="fa fa-fw fa-trash-o"></i>&nbsp;刪除</a>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
              <?php
                $query2 = $db->query("SELECT * FROM news_categories");
                $data = $query2->fetchAll(PDO::FETCH_ASSOC);
                $total_pages = ceil(count($data)/ $limit);
              ?>
                  <ul class="pagination my-3 justify-content-center">
                    <li class="page-item"> <a class="page-link" href="list.php?page=<?php echo $page-1; ?>"> <span>«</span></a> </li>
                    <?php for ($i = 1; $i <= $total_pages; $i++){?>
                    <!-- 判斷目前是否在此頁 -->
                    <?php   if($page == $i){ ?>
                      <li class="page-item active"> 
                    <?php }else{ ?>
                      <li class="page-item"> 
                    <?php } ?>
                    <a class="page-link" href="list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a> </li>
                    <?php } ?>
                   
                    <li class="page-item"> <a class="page-link" href="list.php?page=<?php echo $page+1; ?>"> <span>»</span></a> </li>
                  </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once('../layouts/footer.php'); ?>
</body>

</html>