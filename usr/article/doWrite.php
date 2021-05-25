<?php
  $dbConn = mysqli_connect("127.0.0.1", "geotjeoli", "gjl123414", "php_blog_2021") or die("DB CONNECTION ERROR");

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

  $rs = mysqli_query($dbConn, $sql);
  $id = mysqli_insert_id($dbConn);
?>
<script>
alert('<?=$id?>번 게시물이 생성되었습니다.');
location.replace('detail.php?id=<?=$id?>');
</script>