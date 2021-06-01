<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
  $id = getIntValueOr($_GET['id'], 0);

  if(empty($id)){
    jsHistoryBackExit("게시물 번호를 입력해주세요.");
  }
  $sql = DB__secSql();
  $sql->add("SELECT *");
  $sql->add("FROM article");
  $sql->add("WHERE id = ?", $id);

  $article = DB__getRow($sql);
  $memberId = getIntValueOr($_SESSION['loginedMemberId'], 0);
  
  if(empty($memberId)){
    jsHistoryBackExit("로그인후 사용 가능합니다.");
  }

  
  if(empty($article)){
    jsHistoryBackExit("${id}번 게시물은 존재하지 않습니다.");
  }
  
  if($memberId != 1 and $memberId != $article['memberId']){
    jsHistoryBackExit("해당 작성자만 삭제 가능합니다.");
  }

  $sql = DB__secSql();
  $sql->add("DELETE FROM article");
  $sql->add("WHERE id = ?", $id);
  DB__delete($sql);

  jsLocationReplaceExit("list.php","${id}번 게시물이 삭제 되었습니다.");
  
