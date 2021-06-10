<?php
  class APP__ReplyService {
    private APP__ReplyRepository $replyRepository;
    
      public function __construct() {
          global $App__replyRepository;
          $this->replyRepository = $App__replyRepository;
      }

      public function getForPrintReplyById(int $id): array|null{
        return $this->replyRepository->getForPrintReplyById($id);
      }

      public function deleteReply(int $id){
        return $this->replyRepository->deleteReply($id);
      }

      public function getForPrintReplies(){
        return $this->replyRepository->getForPrintReplies();
      }

      public function modifyReply(int $id, string $body){
        return $this->replyRepository->modifyReply($id, $body);
      }

      public function writeReply(int $articleId, string $body, int $App__loginedMemberId) {
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
  }
?>