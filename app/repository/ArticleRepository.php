<?php
class APP__ArticleRepository {
    public function getForPrintArticles(): array {
        $sql = DB__secSql();
        $sql->add("SELECT A.*");
        $sql->add(", IFNULL(M.nickname, '삭제된사용자') AS extra__writerName");
        $sql->add("FROM article AS A");
        $sql->add("LEFT JOIN `member` AS M");
        $sql->add("ON A.memberId = M.id");
        $sql->add("LEFT JOIN board AS B");
        $sql->add("ON A.boardId = B.id");
        $sql->add("ORDER BY A.id DESC");
        return DB__getRows($sql); 
    }

    public function getForPrintArticleById(int $id): array|null {
      $sql = DB__secSql();
      $sql->add("SELECT *");
      $sql->add(", IFNULL(M.nickname, '삭제된사용자') AS extra__writerName, B.id AS boardNo, B.name");
      $sql->add("FROM article AS A");
      $sql->add("LEFT JOIN `member` AS M");
      $sql->add("ON A.memberId = M.id");
      $sql->add("LEFT JOIN board AS B");
      $sql->add("ON A.boardId = B.id");
      $sql->add("WHERE A.id = ?", $id);
      return DB__getRow($sql); 
    }

    public function writeArticle(string $title, string $body, int $memberId, int $boardId): int {
      $sql = DB__secSql();
      $sql->add("INSERT INTO article");
      $sql->add("SET regDate = NOW()");
      $sql->add(", updateDate = NOW()");
      $sql->add(", title = ?", $title);
      $sql->add(", `body` = ?", $body);
      $sql->add(", memberId = ?", $memberId);
      $sql->add(", boardId = ?", $boardId);
      $sql->add(", like_count = 0");
      $sql->add(", hit = 0");
      $id = DB__insert($sql);

      return $id;
    }
    public function modifyArticle(int $id, string $title, string $body){
      $sql = DB__secSql();
      $sql->add("UPDATE article");
      $sql->add("SET updateDate = NOW()");
      $sql->add(", title = ?", $title);
      $sql->add(", `body` = ?", $body);
      $sql->add("WHERE id = ?", $id);

      DB__update($sql);
    }
    public function deleteArticle(int $id){
      $sql = DB__secSql();
      $sql->add("DELETE FROM article");
      $sql->add("WHERE id = ?", $id);
      DB__delete($sql);
    }

    public function articleHit(int $id){
      $sql = DB__secSql();
      $sql->add("UPDATE article");
      $sql->add("SET hit = hit + 1");
      $sql->add("WHERE id = ?", $id);
      
      DB__update($sql);
    }

    public function articleLikeDown(int $articleId){
      $sql = DB__secSql();
      $sql->add("UPDATE article");
      $sql->add("SET like_count = like_count - 1");
      $sql->add("WHERE id = ?", $articleId);
      DB__update($sql);
    }

    public function articleLikeUp(int $articleId){
      $sql = DB__secSql();
      $sql->add("UPDATE article");
      $sql->add("SET like_count = like_count + 1");
      $sql->add("WHERE id = ?", $articleId);
      DB__update($sql);
    }
}
?>


