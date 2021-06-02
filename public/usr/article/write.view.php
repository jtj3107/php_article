<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/../webInit.php';

  if(!isset($_SESSION['loginedMemberId'])){
    jsHistoryBackExit("로그인 후 사용가능합니다.");
  }

  $sql = DB__secSql();
  $sql->add("SELECT *");
  $sql->add("FROM board");
  $sql->add("ORDER BY id ASC");
  $boards = db__getRows($sql);
  
?>
<?php 
  $pageTitle = "게시물 작성";
?>
<?php include_once __DIR__ . "/../head.php" ?>
  <hr>

  <form action="doWrite.php">
  <div>
    <select name="boardId" required>
      <option>게시판 선택</option>
      <?php foreach( $boards as $board ) { ?>
        <option value="<?=$board['id']?>"><?=$board['name']?></option>
      <?php } ?>
    </select>
    </div>
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