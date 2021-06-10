<?php
class APP__LikeRepository {
    public function getForPrintLikeByArticleIdAndMemberId(int $articleId, int $App__loginedMemberId): array|null{
        $sql1 = DB__secSql();
        $sql1->add("SELECT *");
        $sql1->add("FROM `like`");
        $sql1->add("WHERE articleId = ?", $articleId);
        $sql1->add("AND memberId = ?", $App__loginedMemberId);
        return DB__getRow($sql1);
    }

    public function getForPrintLikeByReplyAndMemberId(int $replyId, int $App__loginedMemberId): array|null{
        $sql = DB__secSql();
        $sql->add("SELECT *");
        $sql->add("FROM `like`");
        $sql->add("WHERE replyId = ?", $replyId);
        $sql->add("AND memberId = ?", $App__loginedMemberId);
        return DB__getRow($sql);
    }

    public function insertLike(int $articleId, int $App__loginedMemberId) {
        $sql = DB__secSql();
        $sql->add("INSERT into `like`");
        $sql->add("SET `date` = NOW()");
        $sql->add(", articleId = ?", $articleId);
        $sql->add(", memberId = ?", $App__loginedMemberId);
        $sql->add(", is_like = 1");
        DB__query($sql);
    }

    public function insertReplyLike(int $replyId, int $App__loginedMemberId){
        $sql = DB__secSql();
        $sql->add("INSERT INTO `like`");
        $sql->add("SET `date` = NOW()");
        $sql->add(", replyId = ?", $replyId);
        $sql->add(", memberId = ?", $App__loginedMemberId);
        $sql->add(", is_like = 1");
        DB__query($sql);
    }

    public function deleteArticle(int $articleId, int $App__loginedMemberId){
        $sql = DB__secSql();
        $sql->add("DELETE FROM `like`");
        $sql->add("WHERE articleId = ?", $articleId);
        $sql->add("AND memberId = ?", $App__loginedMemberId);
        DB__delete($sql);
    }

    public function deleteReply(int $replyId, int $App__loginedMemberId){
        $sql = DB__secSql();
        $sql->add("DELETE FROM `like`");
        $sql->add("WHERE replyId = ?", $replyId);
        $sql->add("AND memberId = ?", $App__loginedMemberId);
        DB__delete($sql);
    }
}
?>

