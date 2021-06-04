<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/../webInit.php'; // $mysqli 변수 포함
$memberId = getIntValueOr( $_SESSION['loginedMemberId'], 0); // 사용자의 IP주소 가져오기
$articleId = getIntValueOr($_GET['articleId'], 0);
$replyId = getIntValueOr($_GET['replyId'], 0); // 게시글 아이디
    if(!empty($articleId)) {
        $sql1 = DB__secSql();
        $sql1->add("SELECT *");
        $sql1->add("FROM `like`");
        $sql1->add("WHERE replyId = ?", $replyId);
        $sql1->add("AND memberId = ?", $memberId);
        $res1 = DB__getRow($sql1); // sql 의 행 갯수를 가져옴 
    if($res1 == null) {
        // 좋아요 기록이 없는 경우 -> 좋아요 등록
        $sql2 = DB__secSql();
        $sql2->add("INSERT INTO `like`");
        $sql2->add("SET `date` = NOW()");
        $sql2->add(", replyId = ?", $replyId);
        $sql2->add(", memberId = ?", $memberId);
        $sql2->add(", is_like = 1");
        DB__query($sql2);
        // 게시판 테이블 업데이트
        $sql3 = DB__secSql();
        $sql3->add("UPDATE reply");
        $sql3->add("SET like_count = like_count + 1 ");
        $sql3->add("WHERE id = ?", $replyId);
        DB__update($sql3);
        jsLocationReplaceExit("../article/detail.php?id=${articleId}", "댓글 좋아요");
    } else {
        // 이미 좋아요를 누른 경우 -> 좋아요 취소
        $sql2 = DB__secSql();
        $sql2->add("DELETE FROM `like`");
        $sql2->add("WHERE replyId = ?", $replyId);
        $sql2->add("AND memberId = ?", $memberId);
        $res2 = DB__delete($sql2);
        
        // 게시판 테이블 업데이트
        $sql3 = DB__secSql();
        $sql3->add("UPDATE reply");
        $sql3->add("SET like_count = like_count - 1 ");
        $sql3->add("WHERE id = ?", $replyId);
        DB__update($sql3);
        jsLocationReplaceExit("../article/detail.php?id=${articleId}", "댓글 좋아요취소");
    }
}
?>