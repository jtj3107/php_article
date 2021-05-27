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
  from reply as R
  where R.id = '${id}'
  ";

  $memberId = intval($_SESSION['loginedMemberId']);

  if(!isset($memberId)){
    echo "로그인후 사용가능합니다.";
    exit;
  }
  
  $reply = DB__getRow($sql);

  if($_SESSION['loginedMemberId'] != $reply['memberId']){
    echo "해당 댓글 작성자만 삭제 가능합니다.";
    exit;
  }

  if($reply == null){
    echo "${id}번 댓글은 존재하지 않습니다.";
    exit;
  }

?>
<?php 
  $sql = "
  delete from reply
  where id = '${id}'
  ";

  DB__delete($sql);
?>
<script>
alert('댓글이 삭제되었습니다.');
location.replace("../article/detail.php?id=<?=$reply['articleId']?>");
</script>