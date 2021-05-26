<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

  if(!isset($_SESSION['loginedMemberId'])){
    echo "로그인후 사용 가능합니다.";
    exit;
  }
  
?>
<?php 
  $pageTitle = "게시물 작성";
?>
<?php include_once __DIR__ . "/../head.php" ?>
  <hr>

  <form action="doWrite.php">
    <div>
      <span>제목</span>
      <input require placeholder = '제목을 입력해주세요.' type="text" name = "title">
    </div>
    <div>
      <span>내용</span>
      <textarea required placeholder = '내용을 입력해주세요.' name="body"></textarea>
    </div>
    <div>
      <input type="submit" value = "글작성">
    </div>
  </form>
<?php include_once __DIR__ . "/../foot.php" ?>