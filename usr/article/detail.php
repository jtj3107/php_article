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

  $re = "
  select *
  from reply as R
  where R.articleId = '${id}'
  order by R.id desc
  ";

  $rs = mysqli_query($dbConn, $sql);
  $rs1 = mysqli_query($dbConn, $re);

  $article = mysqli_fetch_assoc($rs);
  $replyes = [];

  while($reply = mysqli_fetch_assoc($rs1)){
    $replyes[] = $reply;
  }
 
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
  <meta n ame="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$id?>번 게시물 상세페이지</title>
</head>
<body>
  <h1><?=$id?>번 게시물 상세페이지</h1>
  <a href="list.php">글 리스트</a>
  <a href="modify.php?id=<?=$article['id']?>">수정</a>
  <a onclick = "if(!confirm('삭제 하시겠습니까?')){return false;}" href="doDelete.php?id=<?=$article['id']?>">삭제</a>
  <hr>
    <div>번호 : <?=$article['id']?></div>
    <div>작성 : <?=$article['regDate']?></div>
    <div>수정 : <?=$article['updateDate']?></div>
    <div>제목 : <?=$article['title']?></div>
    <div>내용 : <?=$article['body']?></div>
    <hr>
    <div>댓글 작성</div>
    <form action="../reply/doWrite.php?articleId=<?=$article['id']?>">
    <input type="hidden" name = "articleId" value = "<?=$article['id']?>">
    <div>
      <span>내용</span>
      <textarea required placeholder = '내용을 입력해주세요.' name="body"></textarea>
    </div>
    <div>
      <input type="submit" value = "댓글작성">
    </div>
  </form>
    <div>
      <?php foreach ($replyes as $reply){ ?>
        댓글 : <?=$reply['body']?><br>
        <a href="../reply/modify.php?id=<?=$reply['id']?>">수정</a>
        <a onclick = "if(!confirm('삭제 하시겠습니까?')){return false;}" href="../reply/doDelete.php?id=<?=$reply['id']?>">삭제</a>
      <?php } ?> 
    </div>
</body>
</html>
