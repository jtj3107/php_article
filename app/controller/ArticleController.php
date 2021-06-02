<?php 
    class APP__UsrArticleController {
        private APP__ArticleService $articleService;
      
        public function __construct(){
          global $App__articleService;
          $this->articleService = $App__articleService;
        }

        public function actionShowWrite() {
            require_once App__getViewPath("usr/article/write");
        }

        public function actionShowList() {
          $articles = $this->articleService->getForPrintArticles();
      
          require_once App__getViewPath("usr/article/list");
        }

        public function actionDoWrite(){
          $title = getStrValueOr($_GET['title'], "");
          $body = getStrValueOr($_GET['body'], "");
          $boardId = getIntValueOr($_GET['boardId'], 0);
          $memberId = getIntValueOr($_SESSION['loginedMemberId'], 0);
          if(empty($title)){
              jsHistoryBackExit("title를 입력헤주세요");
          }
          
          if(empty($body)){
              jsHistoryBackExit("title를 입력헤주세요");
          }
          
          if(empty($boardId)){
              jsHistoryBackExit("게시판을 선택 헤주세요");
          }

          if($boardId == 1 and $memberId != 1){
              jsHistoryBackExit("권한이 없습니다.");
          }
                                      
          if(!isset($memberId)){
              jsHistoryBackExit("로그인후 사용 가능합니다.");
          }
          $id = $this->articleService->writeArticle($title, $body, $memberId, $boardId);
          jsLocationReplaceExit("list.php","${id}번 게시물이 생성되었습니다.");
        }

        public function actionShowDetail(){
          $id = getIntValueOr($_GET['id'], 0);
      
          if($id == 0){
            jsHistoryBackExit("번호를 입력해주세요.");
          }
          $article = $this->articleService->getForPrintArticleById($id);
      
          if ($article == null){
            jsHistoryBackExit("${id}번 게시물은 존재하지 않습니다.");
          }
          require_once App__getViewPath("usr/article/detail");
        }
        public function actionShowModify(){
          $memberId = getIntValueOr($_SESSION['loginedMemberId'], 0);
          if(empty($memberId)){
            jsHistoryBackExit("로그인후 사용 가능합니다.");
          }
          
          $id = getIntValueOr($_GET['id'], 0);

          if(empty($id)){
            jsHistoryBackExit("id를 입력해주세요");
          }

          $article = $this->articleService->getForPrintArticleById($id);

          if($article == null){
            jsHistoryBackExit("${id}번 게시물은 존재하지 않습니다.");
          }
          if($memberId != 1 and $memberId != $article['memberId']){
            jsHistoryBackExit("해당 게시물 작성자만 수정 가능합니다.");
          } 
          require_once APP__getViewPath("usr/article/modify");
        }
    }
?>