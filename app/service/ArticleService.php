<?php
      class APP__ArticleService {
        
      private APP__ArticleRepository $articleRepository;
    
      public function __construct() {
          global $App__articleRepository;
          $this->articleRepository = $App__articleRepository;
      }
      
      public function getForPrintArticles(): array {
          return $this->articleRepository->getForPrintArticles();
      }
      
      public function getForPrintArticleById(int $id): array|null {
          return $this->articleRepository->getForPrintArticleById($id);
      }
      public function writeArticle(string $title, string $body, int $memberId, int $boardId){
        return $this->articleRepository->writeArticle($title, $body, $memberId, $boardId);
      }

      public function modifyArticle(int $id, string $title, string $body){
        return $this->articleRepository->modifyArticle($id, $title, $body);
      }

      public function deleteArticle(int $id){
        return $this->articleRepository->deleteArticle($id);
      }
    }
?>