<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
  
  $loginId = getStrValueOr($_GET['loginId'], "");
  $loginPw = getStrValueOr($_GET['loginPw'], "");
  
  if(empty($loginId)){
    jsHistoryBackExit("loginId를 입력해주세요.");
  }
  
  if(empty($loginPw)){
    jsHistoryBackExit("loginPw를 입력해주세요.");
  }

  $sql = "
  select *
  from `member` as M
  where M.loginId = '${loginId}'
  ";

  $member = DB__getRow($sql);

  if(empty($member)){
    jsHistoryBackExit("존재하지 않는 회원 정보 입니다.");
  }
  if(empty($member['delStatus'])){
    jsHistoryBackExit("탈퇴한 회원입니다.");
  }

  if($member['loginPw'] != $loginPw){
    jsHistoryBackExit("비밀번호가 일치하지 않습니다.");
  }
  $_SESSION['loginedMemberId'] = $member['id'];
  $memberNickName = $member['nickname'];
  jsLocationReplaceExit("../article/list.php", "${memberNickName}님 환영합니다.");