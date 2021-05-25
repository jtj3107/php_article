<?php 
  if(!isset($_GET['id'])){
    echo "id를 입력해주세요.";
    exit;
  }

  $id = intval($_GET['id']);

  $dbConn = mysqli_connect("127.0.0.1", "geotjeoli", "gjl123414", "php_blog_2021") or die("DB CONNECTION ERROR");

  $sql = "
  select *
  from article
  where id = '${id}'
  ";

  $rs = mysqli_query($dbConn, $sql);
  $article = mysqli_fetch_assoc($rs);

  if($article == null){
    echo "${id}번 게시물은 존재하지 않습니다.";
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$article['id']?>번 게시물 수정</title>
</head>
<body>
  <h1><?=$article['id']?>번 게시물 수정</h1>
  <a href="list.php">글 리스트</a>
  <a href="detail.php?id=<?=$article['id']?>">원문</a>
  <hr>

  <form action="domodify.php?id=<?=$article['id']?>">
  <input type="hidden" name = "id" value = "<?=$article['id']?>">
  <div>
  <span>번호</span>
  <span><?=$article['id']?></span>
  </div>
  <div>
  <span>제목</span>
  <input required placeholder = "제목을 입력해주세요." type="text" name = "title" value = "<?=$article['title']?>">
  </div>
  <div>
  <span>내용</span>
  <textarea required placeholder = "내용을 입력해주세요." name="body"><?=$article['body']?></textarea>
  </div>
  <div>
  <input type="submit" value = "글수정">
  </div>
  
  
  </form>
</body>
</html>