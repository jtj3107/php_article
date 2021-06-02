<?php
class APP__ArticleRepository {
    public function getForPrintArticles(): array {
        $sql = DB__secSql();
        $sql->add("SELECT *");
        $sql->add("FROM article AS A");
        $sql->add("ORDER BY A.id DESC");
        return DB__getRows($sql); 
    }

    public function getForPrintArticleById(int $id): array|null {
      $sql = DB__secSql();
      $sql->add("SELECT *");
      $sql->add("FROM article AS A");
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
      $id = DB__insert($sql);

      return $id;
    }
}
?>