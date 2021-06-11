<?php 
    class APP__UsrArticleController {
        private APP__ArticleService $articleService;
      
        public function __construct(){
          global $App__articleService;
          $this->articleService = $App__articleService;
        }

        public function actionShowWrite() {
          
          if(!$_REQUEST['App__isLogined']){
            jsHistoryBackExit("로그인 후 사용가능합니다.");
          }

          global $App__boardService;
          $boards = $App__boardService->getForPrintBoards();
 
          require_once App__getViewPath("usr/article/write");
        }

        public function actionShowList() {      
          $articles = $this->articleService->getForPrintArticles();
          global $App__boardService;
          $boards = $App__boardService->getForPrintBoards();

          require_once App__getViewPath("usr/article/list");
        }

        public function actionDoWrite(){
          $title = getStrValueOr($_GET['title'], "");
          $body = getStrValueOr($_GET['body'], "");
          $boardId = getIntValueOr($_GET['boardId'], 0);
          if(empty($title)){
              jsHistoryBackExit("title를 입력헤주세요");
          }
          
          if(empty($body)){
              jsHistoryBackExit("title를 입력헤주세요");
          }
          
          if(empty($boardId)){
              jsHistoryBackExit("게시판을 선택 헤주세요");
          }

          if($boardId == 1 and $_REQUEST['App__loginedMemberId'] != 1){
              jsHistoryBackExit("권한이 없습니다.");
          }
                                     
          if(!$_REQUEST['App__isLogined']){
              jsHistoryBackExit("로그인후 사용 가능합니다.");
          }
          $id = $this->articleService->writeArticle($title, $body, $_REQUEST['App__loginedMemberId'], $boardId);
          jsLocationReplaceExit("list.php","${id}번 게시물이 생성되었습니다.");
        }
        
        public function actionShowDetail(){

          if(!$_REQUEST['App__isLogined']){
            jsHistoryBackExit("로그인 후 사용가능합니다.");
          }

          $id = getIntValueOr($_GET['id'], 0);
          
          if($id == 0){
            jsHistoryBackExit("번호를 입력해주세요.");
          }
          $article = $this->articleService->getForPrintArticleById($id);
          
          if ($article == null){
            jsHistoryBackExit("${id}번 게시물은 존재하지 않습니다.");
          }
          
          $this->articleService->articleHit($id);

          global $App__replyService;
          $replies = $App__replyService->getForPrintReplies($id);
          
          require_once App__getViewPath("usr/article/detail");
        }

        public function actionShowModify(){
          if(!$_REQUEST['App__isLogined']){
            jsHistoryBackExit("로그인 후 사용가능합니다.");
          }
          
          $id = getIntValueOr($_GET['id'], 0);

          if(empty($id)){
            jsHistoryBackExit("id를 입력해주세요");
          }

          $article = $this->articleService->getForPrintArticleById($id);

          if($article == null){
            jsHistoryBackExit("${id}번 게시물은 존재하지 않습니다.");
          }
          if($_REQUEST['App__loginedMemberId'] != 1 and $_REQUEST['App__loginedMemberId'] != $article['memberId']){
            jsHistoryBackExit("해당 게시물 작성자만 수정 가능합니다.");
          } 
          require_once APP__getViewPath("usr/article/modify");
        }
        
        public function actionDoModify(){
          $id = getIntValueOr($_GET['id'], 0);
          $title = getStrValueOr($_GET['title'], "");
          $body = getStrValueOr($_GET['body'], "");

          if( empty($id)){
            jsHistoryBackExit("id를 입력해주세요.");
          }

          if( empty($title)){
            jsHistoryBackExit("title를 입력해주세요.");
          }

          if( empty($body)){
            jsHistoryBackExit("body를 입력해주세요.");
          }

          if(!$_REQUEST['App__isLogined']){
            echo "로그인후 사용가능합니다.";
            exit;
          } 
          
          $article = $this->articleService->getForPrintArticleById($id);
          
          if(!isset($article)){
            jsHistoryBackExit("${id}번 게시물은 존재하지 않습니다.");
          } 
          
          $this->articleService->ModifyArticle($id, $title, $body);

          jsLocationReplaceExit("detail.php?id=${id}", "${id}번 게시물이 수정되었습니다.");
        }
        
        public function actionDoDelete(){
          $id = getIntValueOr($_GET['id'], 0);
           

          if(empty($id)){
            jsHistoryBackExit("게시물 번호를 입력해주세요.");
          }

          if(!$_REQUEST['App__isLogined']){
            jsHistoryBackExit("로그인후 사용 가능합니다.");
          }

          $article = $this->articleService->getForPrintArticleById($id);
            
          if(empty($article)){
            jsHistoryBackExit("${id}번 게시물은 존재하지 않습니다.");
          }
          
          if($_REQUEST['App__loginedMemberId'] != 1 and $_REQUEST['App__loginedMemberId'] != $article['memberId']){
            jsHistoryBackExit("해당 작성자만 삭제 가능합니다.");
          }

          $this->articleService->deleteArticle($id);

          jsLocationReplaceExit("list.php","${id}번 게시물이 삭제 되었습니다.");
        }
    }
?>

