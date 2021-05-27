<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
    
  $boardsql = "
  select *
  from board
  ";

  $boards = DB__getRows($boardsql);
  
?>
<?php
  $pageTitle = "게시판 리스트";
?>
<?php include_once __DIR__ . "/../head.php"; ?>
  <span>게시판 이름</span>
  <span>게시판 코드</span>
    <hr>
  <?php foreach ($boards as $board) { ?> 
    <a href="../article/list.php?boardId=<?=$board['id']?>"><?=$board['name']?>게시판</a>&nbsp;&nbsp;
    <?=$board['code']?><br>
  <?php } ?>
<?php include_once __DIR__ . "/../foot.php"; ?>