<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
  
    $id = getIntValueOr($_SESSION['loginedMemberId'], 0);

  if(empty($id)){
    jsHistoryBackExit("로그인 후 사용 가능합니다.");
  }

  $sql = DB__secSql();
  $sql->add("SELECT *");
  $sql->add("FROM `member` AS M");
  $sql->add("WHERE M.id= ?", $id);

  $member = DB__getRow($sql);

  if(empty($member)){
   jsHistoryBackExit("잘못된 접근입니다.");
  }
?>
<?php 
  $pageTitle = "회원수정"
?>
<?php include_once __DIR__ . "/../head.php" ?>
  <hr>
  <form action="doModify.php">
  <input type="hidden" name = "id" value = "<?=$member['id']?>">
    <div>
      <span>이름</span>
      <input required style="width: 202px;" type="text" name = "name" placeholder = '이름을 입력해주세요.' value = "<?=$member['name']?>">  
    </div>
    <div>
      <span>닉네임</span>
      <input required placeholder = '사용하실 별명 입력해주세요.' type="text" name = "nickname" value = "<?=$member['nickname']?>">
    </div>
    <div>
      <span>휴대전화</span>
      <input required placeholder = '휴대전화번호' type="text" name = "phoneNo" value = "<?=$member['phoneNo']?>">
    </div>
    <div>
      <span>이메일</span>
      <input required placeholder = '사용하실 아이디를 입력해주세요.' type="text" name = "email" value = "<?=$member['email']?>">
    </div>
    <div>
      <input type="submit" value = "회원수정">
    </div>
  </form>
<?php include_once __DIR__ . "/../foot.php" ?>