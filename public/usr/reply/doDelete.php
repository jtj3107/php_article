<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

  $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
  $memberId = isset($_SESSION['loginedMemberId']) ? intval($_SESSION['loginedMemberId']) : 0;
  
  if (empty($id)){
    jsHistoryBackExit("로그인 후 사용 가능합니다.");
  }  

  $sql = DB__secSql();
  $sql->add("SELECT *");
  $sql->add("FROM reply AS R");
  $sql->add("WHERE R.id= ?", $id);

  $reply = DB__getRow($sql);

  if($memberId == 0){
    jsHistoryBackExit("잘못된 접근 입니다.");
  }
  
  if($reply == null){
    jsHistoryBackExit("잘못된 접근 입니다.");
  }

  if($meberId != 1 and $memberId != $reply['memberId']){
   jsHistoryBackExit("해당 댓글 작성자만 삭제 가능합니다.");
  }

  $sql = DB__secSql();
  $sql->add("DELETE FROM reply");
  $sql->add("WHERE id= ?", $id);

  DB__delete($sql);
  $replyArticleId = $reply['articleId'];
  jsLocationReplaceExit("../article/detail.php?id=$replyArticleId" , "댓글이 삭제되었습니다.");
