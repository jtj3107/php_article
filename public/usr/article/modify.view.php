<?php 
  $pageTitle = "${id}번 게시물 수정";
?>
<?php include_once __DIR__ . "/../head2.php" ?>
  <hr>
  <form class="container" action="doModify.php?id=<?=$article['articleNo']?>">
  <input type="hidden" name = "id" value = "<?=$article['articleNo']?>">
  <div class="form-group">
    <span>번호</span>
    <span><?=$article['articleNo']?></span>
  </div>
  <div>
    <span>제목</span>
    <input class="form-control mt-4 mb-2 ms-20" require placeholder='제목을 입력해주세요.' type="text" name = "title" value = "<?=$article['title']?>"
	>
  </div>
  <div class="form-group">
    <span>내용</span>
    <textarea class="form-control" rows="10" require placeholder='내용을 입력해주세요.' name="body"><?=$article['body']?></textarea>
  </div>
  <div>
    <input class="btn btn-primary btn-sm" type="submit" value = "글수정">
  </div>
  </form>
<?php include_once __DIR__ . "/../foot.php" ?>