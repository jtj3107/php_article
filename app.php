<?php
class APP__ArticleRepository {
  public function getForPrintArticles(): array {
    $sql = DB__secSql();
    $sql->add("SELECT *");
    $sql->add("FROM article AS A");
    $sql->add("ORDER BY A.id DESC");
    return DB__getRows($sql); 
  }

  public function getForPrintArticleById(int $id): array {
    $sql = DB__secSql();
    $sql->add("SELECT *");
    $sql->add("FROM article AS A");
    $sql->add("WHERE A.id = ?", $id);
    return DB__getRow($sql); 
  }
}

class APP__ArticleService {
  private APP__ArticleRepository $articleRepository;

  public function __construct() {
    $this->articleRepository = new APP__ArticleRepository();
  }

  public function getForPrintArticles(): array {
    return $this->articleRepository->getForPrintArticles();
  }

  public function getForPrintArticleById(int $id): array {
    return $this->articleRepository->getForPrintArticleById($id);
  }
  
}

class APP__UsrArticleController {
  private APP__ArticleService $articleService;

  public static function getViewPath($viewName){
    return $_SERVER['DOCUMENT_ROOT'] . '/' . $viewName . '.view.php';
  }

  public function __construct(){
    $this->articleService = new APP__ArticleService();
  }

  public function actionShowList() {
    $articles = $this->articleService->getForPrintArticles();

    require_once static::getViewPath("usr/article/list");
  }
  public function actionShowDetail(){
    $id = getIntValueOr($_GET['id'], 0);

    if($id == 0){
      jsHistoryBackExit("번호를 입력해주세요.");
    }
    $article = $this->articleService->getForPrintArticleById($id);

    if ($article == null){
      jsHistoryBackExit("${id}번 게시물은 존재하지 않습니다.");
    }
    require_once static::getViewPath("usr/article/detail");
  }
}

function runApp($action) {
  list($controllerTypeCode, $controllerName, $actionFuncName) = explode('/', $action);

  $controllerClassName = "APP__" . ucfirst($controllerTypeCode) . ucfirst($controllerName) . "Controller";
  $actionMethodName = "action";

  if ( str_starts_with($actionFuncName, "do")){
    $actionMethodName .= ucfirst($actionFuncName);
  }
  else {
    $actionMethodName .= "show" . ucfirst($actionFuncName);
  }
  $usrArticleConrtoller = new $controllerClassName();
  $usrArticleConrtoller-> $actionMethodName();
}

