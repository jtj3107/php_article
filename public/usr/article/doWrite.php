<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/../webInit.php';
  $title = getStrValueOr($_GET['title'], "");
  $body = getStrValueOr($_GET['body'], "");
  $boardId = getIntValueOr($_GET['boardId'], 0);
  $memberId = getIntValueOr($_SESSION['loginedMemberId'], 0);
  if(empty($title)){
    jsHistoryBackExit("title를 입력헤주세요");
  }
  
  if(empty($body)){
    jsHistoryBackExit("title를 입력헤주세요");
  }
  
  if(empty($boardId)){
    jsHistoryBackExit("게시판을 선택 헤주세요");
  }

  if($boardId == 1 and $meberId != 1){
    jsHistoryBackExit("권한이 없습니다.");
  }
                            
  if(!isset($memberId)){
    jsHistoryBackExit("로그인후 사용 가능합니다.");
  }

  $sql = DB__secSql();
  $sql->add("INSERT INTO article");
  $sql->add("SET regDate = NOW()");
  $sql->add(", updateDate = NOW()");
  $sql->add(", title = ?", $title);
  $sql->add(", `body` = ?", $body);
  $sql->add(", memberId = ?", $memberId);
  $sql->add(", boardId = ?", $boardId);

  $id = DB__insert($sql);
  jsLocationReplaceExit("list.php","${id}번 게시물이 생성되었습니다.");