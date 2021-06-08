<?php
class APP__BoardRepository {
    public function writeBoard(string $name, string $code, int $App__loginedMemberId){
        $sql = DB__secSql();
        $sql->add("INSERT INTO board");
        $sql->add("SET regDate = NOW()");
        $sql->add(", updateDate = NOw()");
        $sql->add(", `name` = ?", $name);
        $sql->add(", `code` = ?", $code);
        $sql->add(", memberId = ?", $App__loginedMemberId);

        DB__query($sql);
    }

    public function getForPrintBoards(): array {
        $sql = DB__secSql();
        $sql->add("SELECT *");
        $sql->add("FROM board AS B");
        $sql->add("ORDER BY B.id DESC");
        return DB__getRows($sql); 
    }
}
?>