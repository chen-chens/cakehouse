<?php require_once('../functions/login_check.php'); ?>
<?php require_once('../../connection/connection.php'); ?>
<?php
if(isset($_POST['AddForm']) && $_POST['AddForm'] == "INSERT"){

    //判斷是否有資料夾
    if (!file_exists('../../uploads/news')) {
      mkdir('../../uploads/news', 0755, true);
    }
      //圖片上傳程式碼
  if(isset($_FILES['picture']['name'])){
    $filename = $_FILES['picture']['name'];
    $file_path = "../../uploads/news/".$_FILES['picture']['name'];
    move_uploaded_file($_FILES['picture']['tmp_name'], $file_path);
  }else{
    $filename = null;
  }
  //end 圖片上傳程式碼
  $sql= "INSERT INTO news  (news_categoryID, picture, published_date, title, description, created_at) VALUES (:news_categoryID,  :picture, :published_date, :title, :description, :created_at)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":news_categoryID", $_POST['news_categoryID'], PDO::PARAM_INT);
  $sth ->bindParam(":picture", $filename, PDO::PARAM_STR);
  $sth ->bindParam(":published_date", $_POST['published_date'], PDO::PARAM_STR);
  $sth ->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
  $sth ->bindParam(":description", $_POST['description'], PDO::PARAM_STR);
  $sth ->bindParam(":created_at", $_POST['created_at'], PDO::PARAM_STR);
  $sth ->execute();

  header('Location: list.php?categoryID='.$_POST['news_categoryID']);
}
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
              <h1>最新消息管理</h1>
            </div>
            <div class="card-body">
              <ul class="breadcrumb mb-2">
                <li class="breadcrumb-item"> <a href="#">首頁</a> </li>
                <li class="breadcrumb-item"><a href="#">最新消息管理</a></li>
                <li class="breadcrumb-item active">新增一筆</li>
              </ul>
              <div class="row">
                <div class="col-md-12 my-3"><a class="btn btn-primary" href="list.php?categoryID=<?php echo $_GET['categoryID']; ?>">回上一頁</a></div>
              </div>
              <form id="AddForm" class="text-right" method="post" action="create.php" enctype="multipart/form-data">

                <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">圖片</label>
                  <div class="col-10 text-left">
                    <img id="pic" src="" alt="" width="200" style="margin-bottom: 20px;">
                    <input type="file" class="form-control-file" id="picture" name="picture"> 
                  </div>
                </div>
                <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">發佈日期</label>
                  <div class="col-10">
                    <input type="text" class="form-control" id="published_date" name="published_date"> </div>
                </div>

                <div class="form-group row"> <label for="inputpasswordh" class="col-2 col-form-label" contenteditable="true">標題</label>
                  <div class="col-10">
                    <input type="text" class="form-control" id="title" name="title"> </div>
                </div>
                <div class="form-group row"> <label for="inputpasswordh" class="col-2 col-form-label">內容</label>
                  <div class="col-10">
                    <textarea rows="5" class="form-control" name="description"></textarea> </div>
                    <input type="hidden" name="news_categoryID" value="<?php echo $_GET['categoryID']; ?>">
                    <input type="hidden" name="created_at" value="<?php echo date('Y-m-d H:i:s'); ?>">
                    <input type="hidden" name="AddForm" value="INSERT">
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
  $('#picture').change(function() {
    var file = $('#picture')[0].files[0];
    var reader = new FileReader;
    reader.onload = function(e) {
      $('#pic').attr('src', e.target.result);
    };
    reader.readAsDataURL(file);
  });
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