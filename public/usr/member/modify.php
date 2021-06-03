<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/../webInit.php';
  
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
  $pageTitle = "회원수정";
?>
<?php include_once __DIR__ . "/../head2.php" ?>
  <hr>
  <div class="container">
    <form class="form-signin" action="doModify.php">
      <h2 class="form-signin-heading" style="text-align: center;">회원정보 수정</h2>
    <input type="hidden" name = "id" value = "<?=$member['id']?>">
      <div style="padding-top: 20px;">
        <span>이름</span>
        <input class="form-control" required type="text" name = "name" placeholder = '이름을 입력해주세요.' value = "<?=$member['name']?>">  
      </div>
      <div style="padding-top: 20px;">
        <span>닉네임</span>
        <input class="form-control" required placeholder = '사용하실 별명 입력해주세요.' type="text" name = "nickname" value = "<?=$member['nickname']?>">
      </div>
      <div style="padding-top: 20px;">
        <span>휴대전화</span>
        <input class="form-control" required placeholder = '휴대전화번호' type="text" name = "phoneNo" value = "<?=$member['phoneNo']?>">
      </div>
      <div style="padding-top: 20px;">
        <span>이메일</span>
        <input class="form-control" required placeholder = '사용하실 아이디를 입력해주세요.' type="text" name = "email" value = "<?=$member['email']?>">
      </div>
      <div style="padding-top: 20px;">
        <input class="btn btn-lg btn-primary btn-block form-control" type="submit" value = "회원수정">
      </div>
    </form>
  </div>
<?php include_once __DIR__ . "/../foot.php" ?>