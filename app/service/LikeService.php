<?php
    class APP__LikeService{
        private APP__LikeRepository $likeRepository;

        public function __construct() {
            global $App__likeRepository;
            $this->likeRepository = $App__likeRepository;
        }

        public function getForPrintLikeByArticleIdAndMemberId(int $articleId, int $App__loginedMemberId): array|null {
            return $this->likeRepository->getForPrintLikeByArticleIdAndMemberId($articleId, $App__loginedMemberId);
        }

        public function insertLike(int $articleId, int $App__loginedMemberId) {
            return $this->likeRepository->insertLike($articleId, $App__loginedMemberId);
        }

        public function deleteArticle(int $articleId, int $App__loginedMemberId){
            return $this->likeRepository->deleteArticle($articleId, $App__loginedMemberId);
        }

        public function deleteReply(int $replyId, int $App__loginedMemberId){
            return $this->likeRepository->deleteReply($replyId, $App__loginedMemberId);
        }

        public function getForPrintLikeByReplyAndMemberId(int $replyId, int $App__loginedMemberId){
            return $this->likeRepository->getForPrintLikeByReplyAndMemberId($replyId, $App__loginedMemberId);
        }

        public function insertReplyLike(int $replyId, int $App__loginedMemberId){
            return $this->likeRepository->insertReplyLike($replyId, $App__loginedMemberId);
        }
    }
?>
