<?php
  $dbConn = mysqli_connect("127.0.0.1", "geotjeoli", "gjl123414", "php_blog_2021") or die("DB CONNECTION ERROR");
  
  if(!isset($_GET['id'])){
    echo "id를 입력해주세요";
    exit;
  }
  
  $id = intval($_GET['id']);
  
  $sql = "
  select *
  from article as A
  where A.id = '${id}'
  ";

  $rs = mysqli_query($dbConn, $sql);

  $article = mysqli_fetch_assoc($rs);

  if ($article == null){
    echo "${id}번 게시물은 존재하지 않습니다";
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$id?>번 게시물 상세페이지</title>
</head>
<body>
  <h1><?=$id?>번 게시물 상세페이지</h1>
  <hr>
    <div>번호 : <?=$article['id']?></div>
    <div>작성 : <?=$article['regDate']?></div>
    <div>수정 : <?=$article['updateDate']?></div>
    <div>제목 : <?=$article['title']?></div>
    <div>내용 : <?=$article['body']?></div>
    <hr>
</body>
</html>
