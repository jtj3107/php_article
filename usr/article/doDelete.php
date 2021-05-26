<?php
  if ( !isset($_GET['id'])){
    echo "id를 입력해주세요";
    exit;
  }

  $id = intval($_GET['id']);
?>
<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

  $sql = "
  select *
  from article
  where id = '${id}'
  ";

  $article = DB__getRow($sql);

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

  DB__delete($sql);
?>
<script>
alert('<?=$article['id']?>번 게시물이 삭제되었습니다.');
location.replace("list.php");
</script>