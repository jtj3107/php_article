<?php
class APP__LikeRepository {
    public function getForPrintLikeByArticleIdAndMemberId(int $articleId, int $App__loginedMemberId){
        $sql1 = DB__secSql();
        $sql1->add("SELECT *");
        $sql1->add("FROM `like`");
        $sql1->add("WHERE articleId = ?", $articleId);
        $sql1->add("AND memberId = ?", $App__loginedMemberId);
        return DB__getRow($sql1);
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
}
?>