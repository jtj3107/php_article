<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
  if(!isset($_GET['title'])){
    echo "title를 입력헤주세요";
    exit;
  }
  
  if(!isset($_GET['body'])){
    echo "body를 입력헤주세요";
    exit;
  }

  $title = $_GET['title'];
  $body = $_GET['body'];

  $sql = "
  insert into article
  set regDate = now(),
  updateDate = now(),
  title = '${title}',
  `body` = '${body}'
  ";

  $id = DB__insertId($sql);
?>
<script>
alert('<?=$id?>번 게시물이 생성되었습니다.');
location.replace('detail.php?id=<?=$id?>');
</script>