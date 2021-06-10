<button type="button" class="btn btn-primary btn-sm" onclick="location.href = '../like/like.php?articleId=<?=$article['id']?>'">좋아요</button>
    <hr>
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
      <?php foreach ($replies as $reply){ ?>
        댓글 : <?=$reply['body']?><br>
        좋아요 : <?=$reply['like_count']?><br>
        <button type="button" class="btn btn-primary btn-sm" onclick="location.href = '../like/replyLike.php?replyId=<?=$reply['id']?>&articleId=<?=$article['id']?>'">좋아요</button>
        <a href="../reply/modify.php?id=<?=$reply['id']?>"><button type="button" class="btn btn-primary btn-sm">수정</button></a>
        <a onclick = "if(!confirm('삭제 하시겠습니까?')){return false;}" href="../reply/doDelete.php?id=<?=$reply['id']?>"><button type="button" class="btn btn-primary btn-sm">삭제</button></a><br>
      <?php } ?> 
    </div>
