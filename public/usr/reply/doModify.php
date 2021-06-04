<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/../webInit.php';

  $id = getIntValueOr($_GET['id'], 0);
  $body = getStrValueOr($_GET['body'], 0);

  if(empty($id)){
    jsHistoryBackExit("id를 입력해주세요.");
  }

  if(empty($body)){
    jsHistoryBackExit("body를 입력헤주세요.");
  }

  $sql1 = DB__secSql();
  $sql1->add("SELECT *");
  $sql1->add("FROM reply");
  $sql1->add("WHERE id= ?", $id);

  $reply = DB__getRow($sql1);

  if(empty($reply)){
    jsHistoryBackExit("잘못된 접근입니다.");
  }

  $sql2 = DB__secSql();
  $sql2->add("UPDATE reply");
  $sql2->add("SET updateDate = NOW()");
  $sql2->add(", `body` = ?", $body);
  $sql2->add("WHERE id= ?", $id);

  DB__update($sql2);
  $replyArticleId = $reply['articleId'];
  jsLocationReplaceExit("../article/detail.php?id=$replyArticleId" , "댓글이 수정되었습니다.");