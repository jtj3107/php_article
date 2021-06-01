<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

  $memberId = getIntValueOr($_SESSION['loginedMemberId'], 0);
  if(empty($memberId)){
    jsHistoryBackExit("로그인후 사용 가능합니다.");
  }
  
  $id = getIntValueOr($_GET['id'], 0);

  if(empty($id)){
    jsHistoryBackExit("id를 입력해주세요");
  }

  $sql = DB__secSql();
  $sql->add("SELECT *");
  $sql->add("FROM article AS A");
  $sql->add("WHERE A.id = ?", $id);

  $article = DB__getRow($sql);

  if(empty($article)){
    jsHistoryBackExit("${id}번 게시물은 존재하지 않습니다.");
  }
  if($memberId != 1 and $memberId != $article['memberId']){
    jsHistoryBackExit("해당 게시물 작성자만 수정 가능합니다.");
  } 
?>
<?php 
  $pageTitle = "${id}번 게시물 수정"
?>
<?php include_once __DIR__ . "/../head.php" ?>
  <hr>
  <form action="doModify.php?id=<?=$article['id']?>">
  <input type="hidden" name = "id" value = "<?=$article['id']?>">
  <div>
    <span>번호</span>
    <span><?=$article['id']?></span>
  </div>
  <div>
    <span>제목</span>
    <input require placeholder = '제목을 입력해주세요.' type="text" name = "title" value = "<?=$article['title']?>">
  </div>
  <div>
    <span>내용</span>
    <textarea require placeholder = '내용을 입력해주세요.' name="body"><?=$article['body']?></textarea>
  </div>
  <div>
    <input type="submit" value = "글수정">
  </div>
  </form>
<?php include_once __DIR__ . "/../foot.php" ?>