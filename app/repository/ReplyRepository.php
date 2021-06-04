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
  }
?>