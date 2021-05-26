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

  $reply = DB__getReply($sql);

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

  $rs = mysqli_query($dbConn, $sql);
?>
<script>
alert('댓글이 삭제되었습니다.');
location.replace("../article/detail.php?id=<?=$reply['articleId']?>");
</script>