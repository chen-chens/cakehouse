<nav class="navbar navbar-expand-md navbar-light">
    <div class="container"> <a class="navbar-brand text-primary" href="#">
        <i class="fa d-inline fa-lg fa-stop-circle"></i>
        <b> Cake House 後台管理系統</b></a> <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar4">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar4">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"> <a class="nav-link" href="#">頁面管理</a> </li>
          <li class="nav-item"> <a class="nav-link" href="../news_categories/list.php">最新消息管理</a> </li>
          <li class="nav-item"> <a class="nav-link" href="#">商品管理</a> </li>
          <li class="nav-item"> <a class="nav-link" href="#">會員管理</a> </li>
          <li class="nav-item"> <a class="nav-link" href="#">訂單管理</a> </li>
          <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">管理者 <?php echo $_SESSION['user']; ?></a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="ml-3" href="../functions/logout.php">登出</a></div>
          </li>
        </ul>
      </div>
    </div>
  </nav>