<?php
  class APP__UsrReplyController {
    private APP__ReplyService $replyService;

    public function __construct(){
      global $App__replyService;
      $this->replyService = $App__replyService;
    }
    public function actionDoDelete(){
      $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
      global $App__isLogined;
      global $App__loginedMemberId;
      
      if (empty($id)){
        jsHistoryBackExit("없는 댓글 이거나 잘못된 접근 입니다.");
      }  
      if(!$App__isLogined){
        jsHistoryBackExit("로그인 후 사용 가능 합니다.");
      }

      $reply = $this->replyService->getForPrintReplyById($id);

      if($reply == null){
        jsHistoryBackExit("잘못된 접근 입니다.");
      }
      if($App__loginedMemberId != 1 and $App__loginedMemberId != $reply['memberId']){
       jsHistoryBackExit("해당 댓글 작성자만 삭제 가능합니다.");
      }

      $this->replyService->deleteReply($id);

      $replyArticleId = $reply['articleId'];
      jsLocationReplaceExit("../article/detail.php?id=$replyArticleId" , "댓글이 삭제되었습니다.");
    }
  }
  
?>

