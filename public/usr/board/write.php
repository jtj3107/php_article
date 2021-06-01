<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

  if(!isset($_SESSION['loginedMemberId'])){
    jsHistoryBackExit("로그인 후 사용가능합니다.");
  }
  
?>
<?php 
  $pageTitle = "게시판 생성";
?>
<?php include_once __DIR__ . "/../head.php" ?>
  <hr>

  <form action="doWrite.php">
    <div>
      <span>이름</span>
      <input require placeholder = '이름을 입력해주세요.' type="text" name = "name">
    </div>
    <div>
      <span>코드</span>
      <textarea required placeholder = '코드 입력해주세요.' name="code"></textarea>
    </div>
    <div>
      <input type="submit" value = "게시판 생성">
    </div>
  </form>
<?php include_once __DIR__ . "/../foot.php" ?>