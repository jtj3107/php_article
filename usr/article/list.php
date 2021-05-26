<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

  $sql = "
  select *
  from article as A
  order by A.id desc
  ";

  $articles = DB__getRows($sql);
  
?>
<?php
  $pageTitle = "게시물 리스트";
?>
<?php include_once __DIR__ . "/../head.php"; ?>
<a href="write.php">글작성</a>
<a href="../member/login.php">로그인</a>
<hr>
<div>
  <?php foreach ($articles as $article){ ?>
    번호 : <?=$article['id']?><br>
    작성 : <?=$article['regDate']?><br>
    수정 : <?=$article['updateDate']?><br>
    <a href="detail.php?id=<?=$article['id']?>">제목 : <?=$article['title']?><br></a> 
    <hr>
  <?php } ?>
</div>
<?php include_once __DIR__ . "/../foot.php"; ?>