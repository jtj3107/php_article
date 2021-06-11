<?php
class APP__UsrLikeController {
    private APP__LikeService $likeService;
    private APP__ArticleService $articleService;
    private APP__ReplyService $replyService;
    
    public function __construct(){
        global $App__likeService;
        $this->likeService = $App__likeService;
        global $App__articleService;
        $this->articleService = $App__articleService;
        global $App__replyService;
        $this->replyService = $App__replyService;
    }

    public function actionDoLike(){
          // 사용자의 IP주소 가져오기
        $articleId = getIntValueOr($_GET['articleId'], 0); // 게시글 아이디

        if(!empty($articleId)) {
            $res1 = $this->likeService->getForPrintLikeByArticleIdAndMemberId($articleId, $_REQUEST['App__loginedMemberId']);// sql 의 행 갯수를 가져옴     
        if($res1== null) {
            // 좋아요 기록이 없는 경우 -> 좋아요 등록
            $this->likeService->insertLike($articleId, $_REQUEST['App__loginedMemberId']);
            
            // 게시판 테이블 업데이트
            $this->articleService->articleLikeUp($articleId);
            jsLocationReplaceExit("../article/detail.php?id=${articleId}", "좋아요");
        } else {
            // 이미 좋아요를 누른 경우 -> 좋아요 취소
            $this->likeService->deleteArticle($articleId, $_REQUEST['App__loginedMemberId']);

            // 게시판 테이블 업데이트
            $this->articleService->articleLikeDown($articleId);
            jsLocationReplaceExit("../article/detail.php?id=${articleId}", "좋아요취소");
        }
        }
    }

    public function actionDoReplyLike(){
          // 사용자의 IP주소 가져오기
        $articleId = getIntValueOr($_GET['articleId'], 0); //게시물 아이디
        $replyId = getIntValueOr($_GET['replyId'], 0); // 댓글 아이디
        if(!empty($articleId)) {
            $res1 = $this->likeService->getForPrintLikeByReplyAndMemberId($replyId, $_REQUEST['App__loginedMemberId']); // sql 의 행 갯수를 가져옴 
            
        if($res1 == null) {
            // 좋아요 기록이 없는 경우 -> 좋아요 등록
            $this->likeService->insertReplyLike($replyId, $_REQUEST['App__loginedMemberId']);

            // 게시판 테이블 업데이트
            $this->replyService->replyLikeUp($replyId);
            jsLocationReplaceExit("../article/detail.php?id=${articleId}", "댓글 좋아요");
        } else {
            // 이미 좋아요를 누른 경우 -> 좋아요 취소
            $this->likeService->deleteReply($replyId, $_REQUEST['App__loginedMemberId']);
            
            // 게시판 테이블 업데이트
            $this->replyService->replyLIkeDown($replyId);
            jsLocationReplaceExit("../article/detail.php?id=${articleId}", "댓글 좋아요취소");
        }
    }
  }
}
?>
