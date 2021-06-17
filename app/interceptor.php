<?php
  function APP__runBeforActionInterceptor(string $action){
    global $App__memberService;

    $_REQUEST['App__isLogined'] = false;
    $_REQUEST['App__loginedMemberId'] = 0;
    $_REQUEST['App__loginedMember'] = null;

    if(isset($_SESSION['loginedMemberId'])){
      $_REQUEST['App__isLogined'] = true;
      $_REQUEST['App__loginedMemberId'] = intval($_SESSION['loginedMemberId']);
      $_REQUEST['App__loginedMember'] = $App__memberService->getForPrintMemberById($_REQUEST['App__loginedMemberId']);
    }
  }

  function APP__runNeedLoginInterceptor(string $action){
    switch ($action){
      case 'usr/member/login':
      case 'usr/member/doLogin':
      case 'usr/member/join':
      case 'usr/member/doJoin':
      case 'usr/article/list':
      case 'usr/article/detail':
        return;
        break;
    }

    if ($_REQUEST['App__isLogined'] == false){
      jsHistoryBackExit("로그인 후 사용 가능합니다.");
    }
  }

  function APP__runNeedLogoutInterceptor(string $action){
    switch ($action){
      case 'usr/member/login':
      case 'usr/member/doLogin':
      case 'usr/member/join':
      case 'usr/member/doJoin':
        break;
      default:
        return;
    }

    if ($_REQUEST['App__isLogined']){
      jsHistoryBackExit("로그아웃 후 사용 가능합니다.");
    }
  }

  function APP__runInterceptors(string $action){
    APP__runBeforActionInterceptor($action);
    APP__runNeedLoginInterceptor($action);
    APP__runNeedLogoutInterceptor($action);
  }