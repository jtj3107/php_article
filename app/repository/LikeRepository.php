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
}
?>