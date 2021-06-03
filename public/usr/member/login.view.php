<?php 
  $pageTitle = "로그인";
?>
<?php include_once __DIR__ . "/../head2.php" ?>
  <hr>
  <div class="container" style="text-align: center;">
    <form class="form-signin" action="doLogin.php">
    <h2 class="form-signin-heading">Sign in</h2>
      <div style="padding-top: 20px;"> 
        <input type="text" name = "loginId" class="form-control" placeholder="아이디를 입력해주세요." required autofocus>
      </div>
      <div style="padding-top: 20px;">
        <input type="password" name = "loginPw" class="form-control" placeholder="비밀번호를 입력해주세요." required>
      </div>
      <div style="padding-top: 20px;">
        <input class="btn btn-lg btn-primary btn-block form-control" type="submit" value = "로그인">
      </div>
    </form>
  </div>
  
<?php include_once __DIR__ . "/../foot.php" ?>
