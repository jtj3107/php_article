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
  }
?>