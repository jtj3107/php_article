<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
  
  $boardId = isset($_GET['boardId']) ? intval($_GET['boardId']) : 0;
  
  $sql = "
  select *
  from article as A
  order by A.id desc
  ";

  $articles = DB__getRows($sql);

  $boardsql = "
  select *
  from board
  ";

  $boards = DB__getRows($boardsql);
?>
<?php
  $pageTitle = "게시물 리스트";
?>
<?php include_once __DIR__ . "/../head.php"; ?>
<a href="write.php?boardId=<?=$boardId?>">글작성</a>
<hr>
<nav>
  <ul>
    <?php foreach( $boards as $board ) { ?>
      <li style="display: inline-block;"><a href="./list.php?boardId=<?=$board['id']?>"><?=$board['name']?></a></li>
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
         $memberSql = "
         select *
         from member
         where id = '${memberId}'
         ";
       
         $member = DB__getRow($memberSql);
   
         $memberSql = "
         select *
         from board
         where id = '$articleBoardId'
         ";
       
         $board = DB__getRow($memberSql);
         $boardName = isset($board['name']) ? $board['name'] : "카테고리없음";
        ?>
        번호 : <?=$article['id']?><br>
        작성 : <?=$article['regDate']?><br>
        수정 : <?=$article['updateDate']?><br>
        작성자 : <?=$member['nickname']?><br>
        게시판 : <?=$boardName?><br>
        <a href="detail.php?id=<?=$article['id']?>">제목 : <?=$article['title']?><br></a> 
        <hr>
      <?php } ?>
  <?php } ?>
</div>
<?php include_once __DIR__ . "/../foot.php"; ?>