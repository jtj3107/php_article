<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

  if(!isset($_SESSION['loginedMemberId'])){
    echo "로그인후 사용 가능합니다.";
    exit;
  }

  if(!isset($_GET['id'])){
    echo "id를 입력 해주세요.";
    exit;
  }

  $id = intval($_GET['id']);

  $sql = "
  select * 
  from reply as R
  where R.id = '${id}'
  ";

  $reply = DB__getReply($sql);

  if($reply == null){
    echo "존재하지 않는 댓글입니다.";
    exit;
  }

  if($_SESSION['loginedMemberId'] != $reply['memberId']){
    echo "해당 댓글 작성자만 수정 가능합니다.";
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>댓글 수정</title>
</head>
<body>
    <h1>댓글 수정</h1>
    <hr>
    <form action="doModify.php?id=<?=$reply['id']?>">
    <input type="hidden" name = "id" value = "<?=$reply['id']?>">
    <div>
      <span>내용</span>
      <textarea require placeholder = '내용을 입력해주세요.' name="body"><?=$reply['body']?></textarea>
    </div>
    <div>
      <input type="submit" value = "댓글 수정">
    </div>
    </form>
</body>
</html>