<?php
  if ( !isset($_GET['id'])){
    echo "id를 입력해주세요";
    exit;
  }

  $id = intval($_GET['id']);
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
  delete from article
  where id = '${id}'
  ";

  $rs = mysqli_query($dbConn, $sql);
?>
<script>
alert('<?=$article['id']?>번 게시물이 삭제되었습니다.');
location.replace("list.php");
</script>