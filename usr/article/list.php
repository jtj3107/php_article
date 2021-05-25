<?php
  $dbConn = mysqli_connect("127.0.0.1", "geotjeoli", "gjl123414", "php_blog_2021") or die("DB CONNECTION ERROR");

  $sql = "
  select *
  from article as A
  order by A.id desc
  ";

  $rs = mysqli_query($dbConn, $sql);

  $articles = [];
  while ( $article = mysqli_fetch_assoc($rs)){
    $articles[] = $article;
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>게시물 리스트</title>
</head>
<body>
  <h1>게시물 리스트</h1>
  <a href="write.php">글작성</a>
  <hr>

  <div>
    <?php foreach ($articles as $article){ ?>
      번호 : <?=$article['id']?><br>
      작성 : <?=$article['regDate']?><br>
      수정 : <?=$article['updateDate']?><br>
      제목 : <?=$article['title']?><br>
      <a href="detail.php?id=<?=$article['id']?>">상세페이지</a>
      <hr>
    <?php } ?>
  </div>
</body>
</html>