<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/../webInit.php';

  if(!isset($_SESSION['loginedMemberId'])){
    jsHistoryBackExit("로그인 후 사용가능합니다.");
  }
  
?>
<?php 
  $pageTitle = "게시판 생성";
?>
<?php include_once __DIR__ . "/../head2.php" ?>
  <hr>

  <form class="container" action="doWrite.php">
    <div class="form-group">
      <span>이름</span>
      <input class="form-control" require placeholder = '이름을 입력해주세요.' type="text" name = "name">
    </div>
    <div class="form-group">
      <span>코드</span>
      <textarea class="form-control" required placeholder = '코드 입력해주세요.' name="code"></textarea>
    </div>
    <div>
      <input class="btn btn-primary btn-sm" type="submit" value = "게시판 생성">
    </div>
  </form>
<?php include_once __DIR__ . "/../foot.php" ?>
