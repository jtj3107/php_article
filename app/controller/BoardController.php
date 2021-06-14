<?php
class APP__UsrBoardController {
    private APP__BoardService $boardService;
    
    public function __construct(){
        global $App__boardService;
        $this->boardService = $App__boardService;
    }
    public function actionDoWrite(){
        $name = getStrValueOr($_GET['name'], "");
        $code = getStrValueOr($_GET['code'], "");
         
        global $App__isLogined;  

        if(empty($name)){
            jsHistoryBackExit("이름을 입력해주세요.");
        }
        
        if(empty($code)){
            jsHistoryBackExit("코드를 입력해주세요.");
        }
                                    
        if($_REQUEST['App__loginedMemberId'] != 1){
            jsHistoryBackExit("권한이 없습니다.");
        }
        
        $this->boardService->writeBoard($name, $code, $_REQUEST['App__loginedMemberId']);
        jsLocationReplaceExit("../article/list.php", "${name}게시판이 생성되었습니다.");
    }

    public function actionShowWrite() {
        require_once App__getViewPath("usr/board/write");
    }

}   
?>
  