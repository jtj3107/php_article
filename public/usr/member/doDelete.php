<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

  $id = isset($_SESSION['loginedMemberId']) ? intval($_SESSION['loginedMemberId']) : 0; 
  
  if(!isset($id)){
    jsHistoryBackExit("로그인 후 사용가능합니다.");
  }
  $sql1 = DB__secSql();
  $sql1->add("SELECT *");
  $sql1->add("FROM `member`");
  $sql1->add("WHERE id = ?", $id);

  $member = DB__getRow($sql1);

  if($member == null){
    jsHistoryBackExit("잘못된 접근입니다.");
  }

  $sql2 = DB__secSql();
  $sql2->add("UPDATE `member`");
  $sql2->add("SET delStatus = 0");
  $sql2->add("WHERE id = ?", $id);
  
  DB__update($sql2);
  unset($_SESSION['loginedMemberId']);
  jsLocationReplaceExit("../article/list.php", "회원 탈퇴 되었습니다.");