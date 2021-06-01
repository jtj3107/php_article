<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/../webInit.php';

  $loginId = $_GET['loginId'];
  $loginPw = $_GET['loginPw'];
  
  if(empty($loginId)){
    jsHistoryBackExit("loginId를 입력해주세요.");
  }
  
  if(empty($loginPw)){
    jsHistoryBackExit("loginPw를 입력해주세요.");
  }

  $sql = DB__secSql();
  $sql->add("SELECT *");
  $sql->add("FROM `member` AS M");
  $sql->add("WHERE M.loginId = ?", $loginId);
  $sql->add("AND M.loginPw = ?", $loginPw);

  $member = DB__getRow($sql);

  if(empty($member)){
    jsHistoryBackExit("존재하지 않는 회원 정보 입니다.");
  }
  if(empty($member['delStatus'])){
    jsHistoryBackExit("탈퇴한 회원입니다.");
  }

  $_SESSION['loginedMemberId'] = $member['id'];
  $memberNickName = $member['nickname'];
  jsLocationReplaceExit("../article/list.php", "${memberNickName}님 환영합니다.");