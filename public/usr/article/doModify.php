<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
  $id = getIntValueOr($_GET['id'], 0);

  if( empty($id)){
    jsHistoryBackExit("id를 입력해주세요.");
  }

  $title = getStrValueOr($_GET['title'], "");

  if( empty($title)){
    jsHistoryBackExit("title를 입력해주세요.");
  }

  $body = getStrValueOr($_GET['body'], "");

  if( empty($body)){
    jsHistoryBackExit("body를 입력해주세요.");
  }

  $memberId = getIntValueOr($_SESSION['loginedMemberId'], 0);

  if(!isset($memberId)){
    echo "로그인후 사용가능합니다.";
    exit;
  } 

  $sql = DB__secSql();
  $sql->add("SELECT *");
  $sql->add("FROM article");
  $sql->add("WHERE id = ?", $id);
  $article = DB__getRow($sql);

  if(!isset($article)){
    jsHistoryBackExit("${id}번 게시물은 존재하지 않습니다.");
  } 
  
  $updateSql = DB__secSql();
  $updateSql->add("UPDATE article");
  $updateSql->add("SET updateDate = NOW()");
  $updateSql->add(", title = ?", $title);
  $updateSql->add(", `body` = ?", $body);
  $updateSql->add(", memberId= ?", $memberId);
  $updateSql->add("WHERE id = ?", $id);

  DB__update($updateSql);
  jsLocationReplaceExit("detail.php?id=${id}", "${id}번 게시물이 수정되었습니다.");