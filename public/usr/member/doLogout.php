<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/../webInit.php';
  unset($_SESSION['loginedMemberId']);
  jsLocationReplaceExit("../article/list.php", "로그아웃 되었습니다.");