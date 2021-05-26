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
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

  $sql = "
  select *
  from reply
  where id = '${id}'
  ";

  $reply = DB__getReply($sql);

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
  where id = '${id}'
  ";

  DB__modifyReply($sql);
?>
<script>
alert('댓글이 수정되었습니다');
location.replace('../article/detail.php?id=<?=$reply['articleId']?>');
</script>