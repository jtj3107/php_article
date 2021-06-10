<?php
class APP__UsrLikeController {
    private APP__LikeService $likeService;
    
    public function __construct(){
        global $App__likeService;
        $this->likeService = $App__likeService;
    }

    public function actionDoLike(){
        global $App__loginedMemberId; // 사용자의 IP주소 가져오기
        $articleId = getIntValueOr($_GET['articleId'], 0); // 게시글 아이디

        if(!empty($articleId)) {
            $res1 = $this->likeService->getForPrintLikeByArticleIdAndMemberId($articleId, $App__loginedMemberId);// sql 의 행 갯수를 가져옴     
        if($res1== null) {
            // 좋아요 기록이 없는 경우 -> 좋아요 등록
            $sql2 = DB__secSql();
            $sql2->add("INSERT into `like`");
            $sql2->add("SET `date` = NOW()");
            $sql2->add(", articleId = ?", $articleId);
            $sql2->add(", memberId = ?", $App__loginedMemberId);
            $sql2->add(", is_like = 1");
            $res2 = DB__query($sql2);
            // 게시판 테이블 업데이트
            
            $sql3 = DB__secSql();
            $sql3->add("UPDATE article");
            $sql3->add("SET like_count = like_count + 1");
            $sql3->add("WHERE id = ?", $articleId);
            DB__update($sql3);
            jsLocationReplaceExit("../article/detail.php?id=${articleId}", "좋아요");
        } else {
            // 이미 좋아요를 누른 경우 -> 좋아요 취소
            $sql2 = DB__secSql();
            $sql2->add("DELETE FROM `like`");
            $sql2->add("WHERE articleId = ?", $articleId);
            $sql2->add("AND memberId = ?", $App__loginedMemberId);
            DB__delete($sql2);
            
            // 게시판 테이블 업데이트
            $sql3 = DB__secSql();
            $sql3->add("UPDATE article");
            $sql3->add("SET like_count = like_count - 1");
            $sql3->add("WHERE id = ?", $articleId);
            DB__update($sql3);
            jsLocationReplaceExit("../article/detail.php?id=${articleId}", "좋아요취소");
        }
        }

    }
}
?>