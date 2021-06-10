<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>댓글 수정</title>
</head>
<body>
    <h1>댓글 수정</h1>
    <hr>
    <form action="doModify.php?id=<?=$reply['id']?>">
    <input type="hidden" name = "id" value = "<?=$reply['id']?>">
    <div>
      <span>내용</span>
      <textarea require placeholder = '내용을 입력해주세요.' name="body"><?=$reply['body']?></textarea>
    </div>
    <div>
      <input type="submit" value = "댓글 수정">
    </div>
    </form>
</body>
</html>