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
  $memberId = isset($_SESSION['loginedMemberId']) ? intval($_SESSION['loginedMemberId']) : 0; 
  
  if(!isset($memberId)){
    echo "로그인후 사용가능합니다.";
    exit;
  }

  if($_SESSION['loginedMemberId'] != $article['memberId']){
    echo "해당 게시물 작성자만 삭제 가능합니다.";
    exit;
  }

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