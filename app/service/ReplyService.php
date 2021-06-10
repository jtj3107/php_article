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

      public function getForPrintReplies(int $articleId){
        return $this->replyRepository->getForPrintReplies($articleId);
      }

      public function modifyReply(int $id, string $body){
        return $this->replyRepository->modifyReply($id, $body);
      }

      public function writeReply(int $articleId, string $body, int $App__loginedMemberId) {
        return $this->replyRepository->writeReply($articleId, $body, $App__loginedMemberId);
      }

      public function replyLikeUp(int $replyId){
        return $this->replyRepository->replyLikeUp($replyId);
      }

      public function replyLikeDown(int $replyId){
        return $this->replyRepository->replyLikeDown($replyId);
      }
  }
?>