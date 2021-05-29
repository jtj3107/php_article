<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

  $id = isset($_SESSION['loginedMemberId']) ? intval($_SESSION['loginedMemberId']) : 0; 
  
  if(!isset($id)){
    jsHistoryBackExit("로그인 후 사용가능합니다.");
  }
  $sql = "
  select *
  from `member`
  where id = '${id}'
  ";

  $member = DB__getRow($sql);

  if($member == null){
    jsHistoryBackExit("잘못된 접근입니다.");
  }

  $sql = "
  update `member`
  set delStatus = 0
  where id = '${id}'
  ";
  
  DB__modify($sql);
  unset($_SESSION['loginedMemberId']);
  jsLocationReplaceExit("../article/list.php", "회원 탈퇴 되었습니다.");