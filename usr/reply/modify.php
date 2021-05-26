<?php
  $dbConn = mysqli_connect("127.0.0.1", "geotjeoli", "gjl123414", "php_blog_2021") or die("DB CONNECTION ERROR");

  if(!isset($_GET['id'])){
    echo "id를 입력 해주세요.";
    exit;
  }

  $id = intval($_GET['id']);

  $sql = "
  select * 
  from reply as R
  where R.id = '${id}'
  ";

  $rs = mysqli_query($dbConn, $sql);
  $reply = mysqli_fetch_assoc($rs);

  if($reply == null){
    echo "존재하지 않는 댓글입니다.";
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>댓글 수정</title>
</head>
<body>
    <h1>댓글 수정</h1>
    <hr>
    <form action="doModify.php?id=<?=$reply['id']?>">
    <input type="hidden" name = "id" value = "<?=$reply['id']?>">
    <div>
      <span>내용</span>
      <textarea require placeholder = '내용을 입력해주세요.' name="body"><?=$reply['body']?></textarea>
    </div>
    <div>
      <input type="submit" value = "댓글 수정">
    </div>
    </form>
</body>
</html>