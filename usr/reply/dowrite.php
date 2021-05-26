<?php
  $dbConn = mysqli_connect("127.0.0.1", "geotjeoli", "gjl123414", "php_blog_2021") or die("DB CONNECTION ERROR");
  
  if(!isset($_GET['articleId'])){
    echo "게시물을 선택해주세요.";
    exit;
  }
  if(!isset($_GET['body'])){
    echo "댓글을 입력해주세요.";
    exit;
  }
  

  $body = $_GET['body'];
  $articleId = intval($_GET['articleId']);

  $articleSql = "
  select A.id
  from article as A
  where A.id = '${articleId}'
  ";
  $articleRs = mysqli_query($dbConn, $articleSql);
  $article = mysqli_fetch_assoc($articleRs);

  if($article == null){
    echo "존재하지 않는 게시물입니다.";
    exit;
  }
  
  $sql = "
  insert into reply
  set regDate = now(),
  updateDate = now(),
  body = '${body}',
  articleId = '$articleId'
  ";

  $rs = mysqli_query($dbConn, $sql);
  $id = mysqli_insert_id($dbConn);
?>
<script>
  alert('댓글이 등록 되었습니다.');
  location.replace('../article/detail.php?id=<?=$articleId?>');
</script>
