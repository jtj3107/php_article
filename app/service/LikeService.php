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
    }
?>