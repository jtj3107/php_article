<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
  $body = getStrValueOr($_GET['body'], "");
  $articleId = getIntValueOr($_GET['articleId'], 0);
  
  if(empty($articleId)){
    jsHistoryBackExit("게시물을 선택해주세요.");
  }
  if(empty($body)){
    jsHistoryBackExit("내용을 등록해주세요.");
  }

  $articleSql = DB__secSql();
  $articleSql->add("SELECT A.id");
  $articleSql->add("FROM article AS A");
  $articleSql->add("WHERE A.id= ?", $articleId);

  $article = DB__getRow($articleSql);

  if(empty($article)){
    jsHistoryBackExit("존재하지 않는 게시물 입니다.");
  }
  
  $memberId = getIntValueOr($_SESSION['loginedMemberId'], 0);

  if($memberId == 0){
    jsHistoryBackExit("로그인 후 작성 가능합니다.");
  }
  
  $sql = "
  
  articleId = '$articleId',
  memberId = '$memberId',
  like_count = 0
  ";
  $sql = DB__secSql();
  $sql->add("INSERT INTO reply");
  $sql->add("SET regDate = NOW()");
  $sql->add(", updateDate = NOW()");
  $sql->add(", `body` = ?", $body);
  $sql->add(", articleId = ?", $articleId);
  $sql->add(", memberId = ?", $memberId);
  $sql->add(", like_count = 0");
  
  DB__query($sql);
  jsLocationReplaceExit("../article/detail.php?id=$articleId", "댓글이 등록되었습니다.");
