<?php 
  if(!isset($_GET['id'])){
    echo "id를 입력해주세요.";
    exit;
  }

  if(!isset($_GET['body'])){
    echo "body를 입력해주세요.";
    exit;
  }

  $id = intval($_GET['id']);
  $body = $_GET['body'];

?>
<?php 
  $dbConn = mysqli_connect("127.0.0.1", "geotjeoli", "gjl123414", "php_blog_2021") or die("DB CONNECTION ERROR");

  $sql = "
  select *
  from reply
  where id = '${id}'
  ";

  $rs = mysqli_query($dbConn, $sql);
  $reply = mysqli_fetch_assoc($rs);

  if($reply == null){
    echo "존재하지 않는 댓글입니다.";
    exit;
  }
?>
<?php 
  $sql = "
  update reply
  set updateDate = now(),
  `body` = '${body}'
  ";

  $rs = mysqli_query($dbConn, $sql);
?>
<script>
alert('댓글이 수정되었습니다');
location.replace('../article/detail.php?id=<?=$reply['articleId']?>');
</script>