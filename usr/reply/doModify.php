<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

  $id = getIntValueOr($_GET['id'], 0);
  $body = getStrValueOr($_GET['body'], 0);

  if(empty($id)){
    jsHistoryBackExit("id를 입력해주세요.");
  }

  if(empty($body)){
    jsHistoryBackExit("body를 입력헤주세요.");
  }

  $sql = "
  select *
  from reply
  where id = '${id}'
  ";

  $reply = DB__getReply($sql);

  if(empty($reply)){
    jsHistoryBackExit("잘못된 접근입니다.");
  }

  $sql = "
  update reply
  set updateDate = now(),
  `body` = '${body}'
  where id = '${id}'
  ";

  DB__modifyReply($sql);
  $replyArticleId = $reply['articleId'];
  jsLocationReplaceExit("../article/detail.php?id=$replyArticleId" , "댓글이 수정되었습니다.");