<?php
  class APP__ReplyRepository {
    public function getForPrintReplyById(int $id):array|null{
      $sql = DB__secSql();
      $sql->add("SELECT *");
      $sql->add("FROM reply AS R");
      $sql->add("WHERE R.id= ?", $id);
      
      return DB__getRow($sql);    
    }

    public function deleteReply(int $id){
      $sql = DB__secSql();
      $sql->add("DELETE FROM reply");
      $sql->add("WHERE id= ?", $id);

      DB__delete($sql);
    }

    public function getForPrintReplies(int $articleId):array|null{
      $sql = DB__secSql();
      $sql->add("SELECT *");
      $sql->add("FROM reply AS R");
      $sql->add("WHERE articleId = ?", $articleId);
      $sql->add("ORDER BY R.id DESC");
      return DB__getRows($sql); 
    }

    public function modifyReply(int $id, string $body){
      $sql = DB__secSql();
      $sql->add("UPDATE reply");
      $sql->add("SET updateDate = NOW()");
      $sql->add(", `body` = ?", $body);
      $sql->add("WHERE id= ?", $id);
      DB__update($sql);
    }

    public function writeReply(int $articleId, string $body, int $App__loginedMemberId){
      $sql = DB__secSql();
      $sql->add("INSERT INTO reply");
      $sql->add("SET regDate = NOW()");
      $sql->add(", updateDate = NOW()");
      $sql->add(", `body` = ?", $body);
      $sql->add(", articleId = ?", $articleId);
      $sql->add(", memberId = ?", $App__loginedMemberId);
      $sql->add(", like_count = 0");
      
      DB__query($sql);
    }

    public function replyLikeUp(int $replyId){
      $sql3 = DB__secSql();
      $sql3->add("UPDATE reply");
      $sql3->add("SET like_count = like_count + 1 ");
      $sql3->add("WHERE id = ?", $replyId);
      DB__update($sql3);
    }

    public function replyLikeDown(int $replyId){
      $sql3 = DB__secSql();
      $sql3->add("UPDATE reply");
      $sql3->add("SET like_count = like_count - 1 ");
      $sql3->add("WHERE id = ?", $replyId);
      DB__update($sql3);
    }
  }
?>