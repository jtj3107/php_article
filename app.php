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

  function APP__runBeforActionInterceptor(){
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

  function APP__runInterceptors(){
    APP__runBeforActionInterceptor();
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
    APP__runInterceptors();
    APP__runAction($action);
  }

