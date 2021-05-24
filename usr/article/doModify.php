<?php 
  if(!isset($_GET['id'])){
    echo "id를 입력해주세요.";
    exit;
  }

  if( !isset($_GET['title'])){
    echo "title를 입력해주세요";
    exit;
  }

  if(!isset($_GET['body'])){
    echo "body를 입력해주세요.";
    exit;
  }

  $id = intval($_GET['id']);
  $title = $_GET['title'];
  $body = $_GET['body'];

?>
<?php 
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
<?php 
  $sql = "
  update article
  set updateDate = now(),
  title = '${title}',
  `body` = '${body}'
  ";

  $rs = mysqli_query($dbConn, $sql);
?>
<div><?=$id?>번 게시물이 수정 되었습니다.</div>
<div><a href="detail.php?id=<?=$id?>">상세페이지로 이동</a></div>
<div><a href="list.php">리스트로 이동</a></div>