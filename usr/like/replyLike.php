<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php'; // $mysqli 변수 포함
$memberId = getIntValueOr( $_SESSION['loginedMemberId'], 0); // 사용자의 IP주소 가져오기
$articleId = getIntValueOr($_GET['articleId'], 0);
$replyId = getIntValueOr($_GET['replyId'], 0); // 게시글 아이디
if(!empty($articleId)) {
    $sql1 = "
    SELECT * from `like` 
    WHERE articleId = '${replyId}' AND memberId = '${memberId}'
    ";
    $res1 = DB__getRow($sql1); // sql 의 행 갯수를 가져옴 
    if($res1 == null) {
        // 좋아요 기록이 없는 경우 -> 좋아요 등록
        $sql2 = "
        INSERT into `like` 
        set `date` = now(),
        articleId = '${replyId}',
        memberId = '${memberId}',
        is_like = 1
        ";
        $res2 = DB__query($sql2);
        // 게시판 테이블 업데이트
        $sql3 = "
        UPDATE reply
        SET like_count = like_count + 1 
        WHERE id = '${replyId}'
        ";
        $res3 = DB__modify($sql3);
        jsLocationReplaceExit("../article/detail.php?id=${articleId}", "댓글 좋아요");
    } else {
        // 이미 좋아요를 누른 경우 -> 좋아요 취소
        $sql2 = "
        DELETE from `like`
         WHERE articleId = '${replyId}' AND memberId = '${memberId}'
        ";
        $res2 = DB__delete($sql2);
        
        // 게시판 테이블 업데이트
        $sql3 = "
        UPDATE reply
        SET like_count = like_count - 1 
        WHERE id = ${replyId}
        ";
        $res3 = DB__modify($sql3);
        jsLocationReplaceExit("../article/detail.php?id=${articleId}", "댓글 좋아요취소");
    }
}
?>