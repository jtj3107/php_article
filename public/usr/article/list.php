<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
  $boardId = isset($_GET['boardId']) ? $_GET['boardId'] : 0;
 
  $sql = DB__secSql();
  $sql->add("SELECT *");
  $sql->add("FROM article AS A");
  $sql->add("ORDER BY A.id DESC");
  $articles = DB__getRows($sql);

  $boardsql = DB__secSql();
  $boardsql->add("SELECT *");
  $boardsql->add("FROM board");

  $boards = DB__getRows($boardsql);
?>
<?php
  $pageTitle = "게시물 리스트";
?>
<?php include_once __DIR__ . "/../head.php"; ?>
<a href="write.php?boardId=<?=$boardId?>">글작성</a>
<hr>
<nav>
    <button onclick = "location.href = '../board/write.php' ">게시판 추가</button>
  <ul>  
    <?php foreach( $boards as $board ) { ?>
      <li style="display: inline-block;"><a href="list.php?boardId=<?=$board['id']?>"><?=$board['name']?></a></li>
    <?php } ?>
  </ul>
</nav>
<div>
  <?php foreach ($articles as $article){ ?>
    <?php 
      if ($article['boardId'] == $boardId or $boardId == 0) {?>
        <?php
        $memberId = $article['memberId'];
        $articleBoardId = $article['boardId'];
        ?>
        <?php 
         $memberSql = DB__secSql();
         $memberSql->add("SELECT *");
         $memberSql->add("FROM `member`");
         $memberSql->add("WHERE id = ?", $memberId);
       
         $member = DB__getRow($memberSql);
   
         $memberSql = DB__secSql();
         $memberSql->add("SELECT *");
         $memberSql->add("FROM board");
         $memberSql->add("WHERE id = ?", $articleBoardId);
       
         $board = DB__getRow($memberSql);
         $boardName = isset($board['name']) ? $board['name'] : "카테고리없음";

        ?>
        <div class = "board-list">
          <ul>
            <li>번호 : <?=$article['id']?></li>
            <li><a href="detail.php?id=<?=$article['id']?>">제목 : <?=$article['title']?></a> </li>
            <li>작성 : <?=$article['regDate']?></li>
            <li>작성자 : <?=$member['nickname']?></li>
            <li>좋아요 : <?=$article['like_count']?></li>
          </ul>
        </div> 
      <?php } ?>
  <?php } ?>
</div>
<?php include_once __DIR__ . "/../foot.php"; ?>

