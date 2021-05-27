<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

  $id = isset($_SESSION['loginedMemberId']) ? intval($_SESSION['loginedMemberId']) : 0; 
  
  if(!isset($id)){
    echo "로그인후 사용가능합니다.";
    exit;
  }
  $sql = "
  select *
  from `member`
  where id = '${id}'
  ";

  $member = DB__getRow($sql);

  if($member == null){
    echo "잘못된 접근입니다.";
    exit;
  }

?>
<?php 
  $sql = "
  select * from `member`
  ";
  delStatus
  DB__delete($sql);
?>
<script>
alert('<?=$article['id']?>번 게시물이 삭제되었습니다.');
location.replace("list.php");
</script>