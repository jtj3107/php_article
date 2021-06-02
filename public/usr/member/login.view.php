<?php 
  $pageTitle = "로그인";
?>
<?php include_once __DIR__ . "/../head.php" ?>
  <hr>

  <form action="doLogin.php">
    <div>
      <span>아이디</span>
      <input require placeholder = '아이디를 입력해주세요.' type="text" name = "loginId">
    </div>
    <div>
      <span>비밀번호</span>
      <input require placeholder = '비밀번호를 입력해주세요.' type="password" name = "loginPw">
    </div>
    </div>
    <div>
      <input type="submit" value = "로그인">
    </div>
  </form>
<?php include_once __DIR__ . "/../foot.php" ?>