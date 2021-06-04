<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/../webInit.php';
  $pageTitle = "회원가입";
?>
<?php include_once __DIR__ . "/../head2.php" ?>
  <hr>
  <div class="container">
  <form class="form-signin" action="doJoin.php">
  <h2 class="form-signin-heading "  style="text-align: center;">Sing up</h2>
    <div style="padding-top: 20px;">
      <span>아이디</span>
      <input class="form-control" required type="text" name = "loginId" placeholder = '사용하실 아이디를 입력해주세요.'>
      <!-- <input type="text" name = "loginId" class="form-control" placeholder="아이디를 입력해주세요." required autofocus> -->
    </div>
    <div style="padding-top: 20px;">
      <span>비밀번호</span>
      <input class="form-control" required placeholder = '비밀번호' type="password" name = "loginPw">
      
    </div>
    <div style="padding-top: 20px;">
      <span>이름</span>
      <input  class="form-control" required type="text" name = "name" placeholder = '이름을 입력해주세요.'>
      
    </div>
    <div style="padding-top: 20px;">
      <span>닉네임</span>
      <input  class="form-control" required placeholder = '사용하실 별명 입력해주세요.' type="text" name = "nickname">
    </div>
    <div style="padding-top: 20px;">
      <span>휴대전화</span>
      <input  class="form-control" required placeholder = '휴대전화번호' type="text" name = "phoneNo">
    </div>
    <div style="padding-top: 20px;">
      <span>이메일</span>
      <input  class="form-control" required placeholder = '사용하실 아이디를 입력해주세요.' type="text" name = "email">
    </div>
    <div style="padding-top: 20px;">
      <input class="btn btn-lg btn-primary btn-block form-control" type="submit" value = "회원가입">
    </div>
  </form>
  </div>
<?php include_once __DIR__ . "/../foot.php" ?>