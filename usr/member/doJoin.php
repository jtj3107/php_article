<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
  
  $loginId = getStrValueOr($_GET['loginId'], "");
  $loginPw = getStrValueOr($_GET['loginPw'], "");
  $name = getStrValueOr($_GET['name'], "");
  $nickname = getStrValueOr($_GET['nickname'], "");
  $email = getStrValueOr($_GET['email'], "");
  $phoneNo = getStrValueOr($_GET['phoneNo'], "");

  if(empty($loginId)){
    jsHistoryBackExit("사용할 아이디를 입력헤주세요.");
  }
  
  if(empty($loginPw)){
    jsHistoryBackExit("사용하실 비밀번호를 입력해주세요.");
  }

  if(empty($name)){
    jsHistoryBackExit("이름을 입력해주세요.");
  }

  if(empty($nickname)){
    jsHistoryBackExit("사용하실 닉네임을 입력해주세요.");
  }
  
  if(empty($email)){
    jsHistoryBackExit("휴대전화번호를 입력해주세요.");
  }
  if(empty($phoneNo)){
    jsHistoryBackExit("이메일을 등록해주세요.");
  }

  $memberSql = "
  select * from `member`
  where loginId = '${loginId}'
  ";

  $member = DB__getRow($memberSql);
  
  if(isset($member)){
    jsHistoryBackExit("${loginId}는 이미 사용중인 아이디입니다.");
  }

  $membersSql = "
  select * from `member`
  ";
  $members = DB__getRows($membersSql);

  foreach($members as $member){
    if($member['name'] == $name and $member['email'] == $email){
      jsHistoryBackExit("이미 가입된 회원정보 입니다.");
    }
  }
  
  $sql = "
  insert into `member`
  set regDate = now(),
  updateDate = now(),
  loginId = '${loginId}',
  loginPw = '${loginPw}',
  `name` = '${name}',
  nickname = '${nickname}',
  email = '${email}',
  phoneNo = '${phoneNo}',
  delStatus = 1
  ";

  DB__query($sql);
  jsLocationReplaceExit("login.php", "회원가입 되었습니다.");