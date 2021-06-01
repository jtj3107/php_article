<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

  $memberId = getIntValueOr($_SESSION['loginedMemberId'], 0);
  if(empty($memberId)){
    jsHistoryBackExit("로그인 후 사용 가능합니다.");
  }
  
  $id = getIntValueOr($_GET['id'], 0);

  if(empty($id)){
    jsHistoryBackExit("id를 입력해주세요.");
  }

  $sql = DB__secSql();
  $sql->add("SELECT *");
  $sql->add("FROM reply AS R");
  $sql->add("WHERE R.id= ?", $id);

  $reply = DB__getRow($sql);

  if(empty($reply)){
    jsHistoryBackExit("존재하지 않는 댓글 입니다.");
  }

  if($memberId != 1 and $memberId != $reply['memberId']){
    jsHistoryBackExit("해당 댓글 작성자만 수정 가능합니다.");
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