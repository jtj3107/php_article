<?php 
  $dbConn = mysqli_connect("127.0.0.1", "geotjeoli", "gjl123414", "php_blog_2021") or die("DB CONNECT ERROR");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>게시물 작성</title>
</head>
<body>
  <h1>게시물 작성</h1>
  <hr>

  <form action="doWrite.php">
    <div>
      <span>제목</span>
      <input require placeholder = '제목을 입력해주세요.' type="text" name = "title">
    </div>
    <div>
      <span>내용</span>
      <textarea required placeholder = '내용을 입력해주세요.' name="body"></textarea>
    </div>
    <div>
      <input type="submit" value = "글작성">
    </div>
  </form>
</body>
</html>