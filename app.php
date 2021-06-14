<?php
  require_once __DIR__ . '/app/repository/MemberRepository.php';
  require_once __DIR__ . '/app/repository/BoardRepository.php';
  require_once __DIR__ . '/app/repository/ArticleRepository.php';
  require_once __DIR__ . '/app/repository/ReplyRepository.php';
  require_once __DIR__ . '/app/repository/LikeRepository.php';

  require_once __DIR__ . '/app/service/MemberService.php';
  require_once __DIR__ . '/app/service/BoardService.php';
  require_once __DIR__ . '/app/service/ArticleService.php';
  require_once __DIR__ . '/app/service/ReplyService.php';
  require_once __DIR__ . '/app/service/LikeService.php';
  
  require_once __DIR__ . '/app/controller/MemberController.php';
  require_once __DIR__ . '/app/controller/BoardController.php';
  require_once __DIR__ . '/app/controller/ArticleController.php';
  require_once __DIR__ . '/app/controller/ReplyController.php';
  require_once __DIR__ . '/app/controller/LikeController.php';

  function App__getViewPath($viewName) {
    return __DIR__ . '/public/' . $viewName . '.view.php';
  }

  require_once __DIR__ . '/app/global.php';

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
  function APP__runAction(string $action) {
    list($controllerTypeCode, $controllerName, $actionFuncName) = explode('/', $action);

    $controllerClassName = "APP__" . ucfirst($controllerTypeCode) . ucfirst($controllerName) . "Controller";
    $actionMethodName = "action";

    if ( str_starts_with($actionFuncName, "do")){
      $actionMethodName .= ucfirst($actionFuncName);
    }
    else {
      $actionMethodName .= "show" . ucfirst($actionFuncName);
    }
    $usrArticleConrtoller = new $controllerClassName();
    $usrArticleConrtoller-> $actionMethodName();
  }
  
  function APP__run(string $action){
    APP__runInterceptors($action);
    APP__runAction($action);
  }

