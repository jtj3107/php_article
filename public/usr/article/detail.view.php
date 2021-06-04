<?php 
  $pageTitle = "게시물 상세내용, ${id}번 게시물";
  $id = getIntValueOr($_GET['id'], 0);
?>
<?php include_once __DIR__ . "/../head2.php" ?>
  <div class="container">
    <a href="modify.php?id=<?=$article['id']?>"><button type="button" class="btn btn-primary">수정</button></a>
    <a onclick = "if(!confirm('삭제 하시겠습니까?')){return false;}" href="doDelete.php?id=<?=$article['id']?>"><button type="button" class="btn btn-primary">삭제</button></a>
  <hr>   
    <?php
    $memberId = $article['memberId'];
    $memberSql = DB__secSql();
    $memberSql->add("SELECT *");
    $memberSql->add("FROM `member`");
    $memberSql->add("WHERE id = ?", $memberId);
    $member = DB__getRow($memberSql);
    ?>
    <table class="board_view">
        <colgroup>
            <col width="15%">
            <col width="15%">
            <col width="30%">
            <col width="15%">
            <col width="*">
        </colgroup>
        <tbody>
            <tr>
                <th>번호</th>
                <td><?=$article['id']?></td>
                <th>좋아요</th>
                <td><?=$article['like_count']?></td>
            </tr>
            <tr>
                <th>제목</th>
                <td><?=$article['title']?></td>
                <th>조회수</th>
                <td><?=$article['hit']?></td>
            </tr>
            <tr>
                <th>작성자</th>
                <td><?=$member['nickname']?></td>
                <th>작성시간</th>
                <td><?=$article['regDate']?></td>
            </tr>
            <tr>
                <th>내용</th>
                <td><?=$article['body']?></td>
                <th>수정시간</th>
                <td><?=$article['updateDate']?></td>            
            </tr>
        </tbody>
        </table>
        <br>
    <button type="button" class="btn btn-primary btn-sm" onclick="location.href = '../like/like.php?articleId=<?=$article['id']?>'">좋아요</button>
    <hr>
    <?php
    $memberId = getIntValueOr($_SESSION['loginedMemberId'], 0);
    if(!isset($memberId)){
      echo "로그인후 사용가능합니다.";
      exit;
    }
    ?>
    </div>
    <form class="container" action="../reply/doWrite.php?articleId=<?=$article['id']?>">
    <input type="hidden" name = "articleId" value = "<?=$article['id']?>">
    <div>
      <textarea required placeholder = '내용을 입력해주세요.' name="body"></textarea>
    </div>
    <div>
      <input class="btn btn-primary" type="submit" value = "댓글작성">
    </div>
    </form>
    <div class="container">
    <?php
      $sql = DB__secSql();
      $sql->add("SELECT *");
      $sql->add("FROM reply as R");
      $sql->add("WHERE R.articleId = ?", $id);
      $sql->add("ORDER BY R.id DESC");

      $replyes = DB__getRows($sql);
    ?>
      <?php foreach ($replyes as $reply){ ?>
        댓글 : <?=$reply['body']?><br>
        좋아요 : <?=$reply['like_count']?><br>
        <button type="button" class="btn btn-primary btn-sm" onclick="location.href = '../like/replyLike.php?replyId=<?=$reply['id']?>&articleId=<?=$article['id']?>'">좋아요</button>
        <a href="../reply/modify.php?id=<?=$reply['id']?>"><button type="button" class="btn btn-primary btn-sm">수정</button></a>
        <a onclick = "if(!confirm('삭제 하시겠습니까?')){return false;}" href="../reply/doDelete.php?id=<?=$reply['id']?>"><button type="button" class="btn btn-primary btn-sm">삭제</button></a><br>
      <?php } ?> 
    </div>
  <?php require_once __DIR__ . "/../foot.php"; ?>
