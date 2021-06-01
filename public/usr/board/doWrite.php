<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
  $name = getStrValueOr($_GET['name'], 0);
  $code = getStrValueOr($_GET['code'], 0);
  $memberId = getIntValueOr($_SESSION['loginedMemberId'], 0);
  
  if(empty($name)){
    jsHistoryBackExit("이름을 입력해주세요.");
  }
  
  if(empty($code)){
    jsHistoryBackExit("코드를 입력해주세요.");
  }
                            
  if(empty($memberId)){
    jsHistoryBackExit("로그인 후 사용가능합니다.");
  }

  if($memberId != 1){
    jsHistoryBackExit("권한이 없습니다.");
  }

  $sql = DB__secSql();
  $sql->add("INSERT INTO board");
  $sql->add("SET regDate = NOW()");
  $sql->add(", updateDate = NOw()");
  $sql->add(", `name` = ?", $name);
  $sql->add(", `code` = ?", $code);
  $sql->add(", memberId = ?", $memberId);

  DB__query($sql);
  jsLocationReplaceExit("../article/list.php", "${name}게시판이 생성되었습니다.");

  