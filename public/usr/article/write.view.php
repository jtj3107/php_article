<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/../webInit.php';
?>
<?php 
  $pageTitle = "게시물 작성";
?>
<?php include_once __DIR__ . "/../head2.php" ?>
  <hr>
  <form class="container" action="doWrite.php">
  <div>
    <select name="boardId" required>
    <div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    게시판 선택
    </button>
    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
    <?php foreach( $boards as $board ) { ?>
        <option class="dropdown-item" value="<?=$board['id']?>"><?=$board['name']?></option>
      <?php } ?>
    </ul>
  </div>
    </select>
    </div>
    <div class="form-group">
      <span>제목</span>
      <input class="form-control" require placeholder = '제목을 입력해주세요.' type="text" name = "title">
    </div>
    <div class="form-group">
      <span>내용</span>
      <textarea class="form-control" required placeholder = '내용을 입력해주세요.' name="body"></textarea>
    </div>
    <div>
      <input class="btn btn-primary btn-sm" type="submit" value = "글작성">
    </div>
  </form>
<?php include_once __DIR__ . "/../foot.php" ?>