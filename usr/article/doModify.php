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

  $sql = "
  select *
  from article
  where id = '${id}'
  ";

  $article = DB__getRow($sql);

  if(!isset($article)){
    jsHistoryBackExit("${id}번 게시물은 존재하지 않습니다.");
  } 
  $updateSql = "
  update article
  set updateDate = now(),
  title = '${title}',
  `body` = '${body}',
  memberId= '${memberId}'
  where id = '${id}'
  ";

  DB__modify($updateSql);
  jsLocationReplaceExit("detail.php?id=${id}", "${id}번 게시물이 수정되었습니다.");