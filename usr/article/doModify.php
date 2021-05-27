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
  $memberId = isset($_SESSION['loginedMemberId']) ? intval($_SESSION['loginedMemberId']) : 0;

  if(!isset($memberId)){
    echo "로그인후 사용가능합니다.";
    exit;
  }

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
  update article
  set updateDate = now(),
  title = '${title}',
  `body` = '${body}',
  memberId= '${memberId}',
  where id = '${id}'
  ";

  DB__modify($sql);
?>
<script>
alert('<?=$article['id']?>번 게시물이 수정되었습니다');
location.replace('detail.php?id=<?=$article['id']?>');
</script>