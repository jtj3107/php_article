<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
  
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

  $article = DB__getRow($articleSql);

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

  DB__query($sql);
?>
<script>
  alert('댓글이 등록 되었습니다.');
  location.replace('../article/detail.php?id=<?=$articleId?>');
</script>
