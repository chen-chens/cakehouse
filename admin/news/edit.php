<?php require_once('../../connection/connection.php'); ?>
<?php
if(isset($_POST['EditForm']) && $_POST['EditForm'] == "EDIT"){

    //圖片上傳程式碼
  if(isset($_FILES['picture']['name'])){
    $filename = $_FILES['picture']['name'];
    $file_path = "../../uploads/news/".$_FILES['picture']['name'];
    unlink("../../uploads/news/".$_POST['old_picture']);
    move_uploaded_file($_FILES['picture']['tmp_name'], $file_path);
  }else{
    $filename = $_POST['old_picture']; //取得舊圖片檔名
  }
  $sql= "UPDATE news SET published_date=:published_date, picture=:picture, title=:title, description=:description, updated_at=:updated_at WHERE newsID=:newsID";
  
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":published_date", $_POST['published_date'], PDO::PARAM_STR);
  $sth ->bindParam(":picture", $filename, PDO::PARAM_STR);
  $sth ->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
  $sth ->bindParam(":description", $_POST['description'], PDO::PARAM_STR);
  $sth ->bindParam(":updated_at", $_POST['updated_at'], PDO::PARAM_STR);
  $sth ->bindParam(":newsID", $_POST['newsID'], PDO::PARAM_INT);
  $sth ->execute();

  header('Location: list.php?categoryID='.$_POST['news_categoryID']);
}else{
  $query = $db->query("SELECT * FROM news WHERE newsID=".$_GET['gnewsID']);
  $news = $query->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html>

<?php require_once('../functions/login_check.php'); ?>
<?php require_once('../layouts/head.php'); ?>

<body style="">
<?php require_once('../layouts/navbar.php'); ?>
  <div class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h1>最新消息管理</h1>
            </div>
            <div class="card-body">
              <ul class="breadcrumb mb-2">
                <li class="breadcrumb-item"> <a href="#">首頁</a> </li>
                <li class="breadcrumb-item"><a href="#">最新消息管理</a></li>
                <li class="breadcrumb-item active">新增一筆</li>
              </ul>
              <div class="row">
                <div class="col-md-12 my-3"><a class="btn btn-primary" href="list.php">回上一頁</a></div>
              </div>
              <form id="EditForm" class="text-right" method="post" action="edit.php" enctype="multipart/form-data">
                <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">圖片</label>
                  <div class="col-10">
                    <img src="img" alt="">
                    <input type="file" class="form-control" id="picture" name="picture"> 
                    <input type="hidden" name="old_picture" value="<?php echo $news['picture']; ?>">
                  </div>
                </div>
                <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">發佈日期</label>
                  <div class="col-10">
                    <input type="text" class="form-control" id="published_date" name="published_date" value="<?php echo $news['published_date']; ?>"> </div>
                </div>
                <div class="form-group row"> <label for="inputpasswordh" class="col-2 col-form-label" contenteditable="true">標題</label>
                  <div class="col-10">
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $news['title']; ?>"> </div>
                </div>
                <div class="form-group row"> <label for="inputpasswordh" class="col-2 col-form-label">內容</label>
                  <div class="col-10">
                    <textarea rows="5" class="form-control" name="description"><?php echo $news['description']; ?></textarea> </div>
                    <input type="hidden" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>">
                    <input type="hidden" name="EditForm" value="EDIT">
                    <input type="hidden" name="newsID" value="<?php echo $_GET['gnewsID']; ?>">
                    <input type="hidden" name="news_categoryID" value="<?php echo $_GET['categoryID']; ?>">
                </div>
                <button type="submit" class="btn mr-3 btn-primary">取消並回上一頁</button><button type="submit" class="btn btn-secondary">確定送出</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once('../layouts/footer.php'); ?>
  <script>
  $(function(){
    $( "#published_date" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
  });
  //套用ckeditor編輯器
  CKEDITOR.replace( 'description' );
  </script>
</body>

</html>