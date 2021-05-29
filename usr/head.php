<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta n ame="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$pageTitle?></title>
  <link rel="stylesheet" href="/common.css">
</head>
<body>
  <h1><?=$pageTitle?></h1>
  <?php if(isset($_SESSION['loginedMemberId'])) { ?>
    <a href="/usr/member/doLogout.php">로그아웃</a>
    <a href="/usr/member/modify.php">회원수정</a>
    <a onclick = "if(!confirm('정말로 탈퇴하시겠습니까?')){return false;}" href="/usr/member/doDelete.php?id=<?=$_SESSION['loginedMemberId']?>">회원탈퇴</a>
  <?php } ?>
  <?php if(!isset($_SESSION['loginedMemberId'])) { ?>
    <a href="/usr/member/login.php">로그인</a>
    <a href="/usr/member/join.php">회원가입</a>
  <?php } ?>
  


  