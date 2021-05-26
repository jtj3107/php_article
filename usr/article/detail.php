<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
  if(!isset($_GET['id'])){
    echo "id를 입력해주세요";
    exit;
  }
  
  $id = intval($_GET['id']);
  
  $sql = "
  select *
  from article as A
  where A.id = '${id}'
  ";
  
  $article = DB__getRow($sql);
  
  if ($article == null){
    echo "${id}번 게시물은 존재하지 않습니다";
    exit;
  }

  $repliSql = "
  select *
  from reply as R
  where R.articleId = '${id}'
  order by R.id desc
  ";

  $replyes = DB__getReplies($repliSql);

?>
<?php
  $pageTitle = "게시물 상세내용, ${id}번 게시물";
?>
<?php require_once __DIR__ . "/../head.php"; ?>
  <div>
    <a href="list.php">글 리스트</a>
    <a href="modify.php?id=<?=$article['id']?>">수정</a>
    <a onclick = "if(!confirm('삭제 하시겠습니까?')){return false;}" href="doDelete.php?id=<?=$article['id']?>">삭제</a>
  </div>
  <hr>
    <div>번호 : <?=$article['id']?></div>
    <div>작성 : <?=$article['regDate']?></div>
    <div>수정 : <?=$article['updateDate']?></div>
    <div>제목 : <?=$article['title']?></div>
    <div>내용 : <?=$article['body']?></div>
    <hr>
    <div>댓글 작성</div>
    <form action="../reply/doWrite.php?articleId=<?=$article['id']?>">
    <input type="hidden" name = "articleId" value = "<?=$article['id']?>">
    <div>
      <span>내용</span>
      <textarea required placeholder = '내용을 입력해주세요.' name="body"></textarea>
    </div>
    <div>
      <input type="submit" value = "댓글작성">
    </div>
  </form>
    <div>
      <?php foreach ($replyes as $reply){ ?>
        댓글 : <?=$reply['body']?><br>
        <a href="../reply/modify.php?id=<?=$reply['id']?>">수정</a>
        <a onclick = "if(!confirm('삭제 하시겠습니까?')){return false;}" href="../reply/doDelete.php?id=<?=$reply['id']?>">삭제</a><br>
      <?php } ?> 
    </div>
  <?php require_once __DIR__ . "/../foot.php"; ?>

