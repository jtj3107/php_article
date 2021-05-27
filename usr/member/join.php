<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
  $pageTitle = "회원가입";
?>
<?php include_once __DIR__ . "/../head.php" ?>
  <hr>
  <form action="doJoin.php">
    <div>
      <span>아이디</span>
      <input required style="width: 202px;" type="text" name = "loginId" placeholder = '사용하실 아이디를 입력해주세요.'>
      
    </div>
    <div>
      <span>비밀번호</span>
      <input required placeholder = '비밀번호' type="password" name = "loginPw">
      
    </div>
    <div>
      <span>이름</span>
      <input required style="width: 202px;" type="text" name = "name" placeholder = '이름을 입력해주세요.'>
      
    </div>
    <div>
      <span>닉네임</span>
      <input required placeholder = '사용하실 별명 입력해주세요.' type="text" name = "nickname">
    </div>
    <div>
      <span>휴대전화</span>
      <input required placeholder = '휴대전화번호' type="text" name = "phoneNo">
    </div>
    <div>
      <span>이메일</span>
      <input required placeholder = '사용하실 아이디를 입력해주세요.' type="text" name = "email">
    </div>
    <div>
      <input type="submit" value = "회원가입">
    </div>
  </form>
<?php include_once __DIR__ . "/../foot.php" ?>