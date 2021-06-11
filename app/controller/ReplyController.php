<?php
  class APP__UsrReplyController {
    private APP__ReplyService $replyService;

    public function __construct(){
      global $App__replyService;
      $this->replyService = $App__replyService;
    }
    public function actionDoDelete(){
      $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
      
      if (empty($id)){
        jsHistoryBackExit("없는 댓글 이거나 잘못된 접근 입니다.");
      }  
      if(!$_REQUEST['App__isLogined']){
        jsHistoryBackExit("로그인 후 사용 가능 합니다.");
      }

      $reply = $this->replyService->getForPrintReplyById($id);

      if($reply == null){
        jsHistoryBackExit("잘못된 접근 입니다.");
      }
      if($_REQUEST['App__loginedMemberId'] != 1 and $_REQUEST['App__loginedMemberId'] != $reply['memberId']){
       jsHistoryBackExit("해당 댓글 작성자만 삭제 가능합니다.");
      }

      $this->replyService->deleteReply($id);

      $replyArticleId = $reply['articleId'];
      jsLocationReplaceExit("../article/detail.php?id=$replyArticleId" , "댓글이 삭제되었습니다.");
    }

    public function actionDoModify(){

      if(!$_REQUEST['App__isLogined']){
        jsHistoryBackExit("로그인 후 사용가능합니다.");
      }

      $id = getIntValueOr($_GET['id'], 0);
      $body = getStrValueOr($_GET['body'], 0);
    
      if(empty($id)){
        jsHistoryBackExit("id를 입력해주세요.");
      }
    
      if(empty($body)){
        jsHistoryBackExit("body를 입력헤주세요.");
      }
       
      $reply = $this->replyService->getForPrintReplyById($id);
    
      if(empty($reply)){
        jsHistoryBackExit("잘못된 접근입니다.");
      }
     
      $this->replyService->modifyReply($id, $body);
      $replyArticleId = $reply['articleId'];
      jsLocationReplaceExit("../article/detail.php?id=$replyArticleId" , "댓글이 수정되었습니다.");
    }

    public function actionShowModify(){

      if(!$_REQUEST['App__isLogined']){
        jsHistoryBackExit("로그인 후 사용가능합니다.");
      }

      $id = getIntValueOr($_GET['id'], 0);

      if(empty($id)){
        jsHistoryBackExit("id를 입력해주세요.");
      }

      $reply = $this->replyService->getForPrintReplyById($id);

      if(empty($reply)){
        jsHistoryBackExit("존재하지 않는 댓글 입니다.");
      }

      if($_REQUEST['App__loginedMemberId'] != 1 and $_REQUEST['App__loginedMemberId'] != $reply['memberId']){
        jsHistoryBackExit("해당 댓글 작성자만 수정 가능합니다.");
      }

      require_once APP__getViewPath("usr/reply/modify");
    }

    public function actionDoWrite(){
      $body = getStrValueOr($_GET['body'], "");
      $articleId = getIntValueOr($_GET['articleId'], 0);   
      
      if(empty($articleId)){
        jsHistoryBackExit("게시물을 선택해주세요.");
      }
      if(empty($body)){
        jsHistoryBackExit("내용을 등록해주세요.");
      }

      if(!$_REQUEST['App__isLogined']){
        jsHistoryBackExit("로그인 후 사용가능합니다.");
      }

      global $App__articleService;
      $article = $App__articleService->getForPrintArticleById($articleId);

      if(empty($article)){
        jsHistoryBackExit("존재하지 않는 게시물 입니다.");
      }

      $this->replyService->writeReply($articleId, $body, $_REQUEST['App__loginedMemberId']);

      jsLocationReplaceExit("../article/detail.php?id=$articleId", "댓글이 등록되었습니다.");

    }
  }
?>

