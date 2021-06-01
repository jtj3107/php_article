<?php 
  if(!isset($_GET['name'])){
    echo "이름을 입력해주세요.";
    exit;
  }

  if( !isset($_GET['nickname'])){
    echo "닉네임을 입력해주세요";
    exit;
  }

  if(!isset($_GET['email'])){
    echo "이메일를 입력해주세요.";
    exit;
  }

  if(!isset($_GET['phoneNo'])){
    echo "휴대전화번호를 입력해주세요.";
    exit;
  }

  $name = $_GET['name']; 
  $nickname = $_GET['nickname'];
  $email = $_GET['email'];
  $phoneNo = $_GET['phoneNo'];
  $id = intval($_GET['id']);

  if(!isset($id)){
    echo "로그인후 사용가능합니다.";
    exit;
  }

?>
<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

  $sql = DB__secSql();
  $sql->add("SELECT *");
  $sql->add("FROM `member`");
  $sql->add("WHERE id= ?", $id);
  $member = DB__getRow($sql);

  if(empty($member)){
    jsHistoryBackExit("잘못된 접근입니다.");
  }

  $sql = DB__secSql();
  $sql->add("UPDATE `member`");
  $sql->add("SET updateDate = NOW()");
  $sql->add(", `name` = ?", $name);
  $sql->add(",  nickname = ?", $nickname);
  $sql->add(", email = ?", $email);
  $sql->add(", phoneNo = ?", $phoneNo);
  $sql->add("WHERE id = ?", $id);
  
  DB__update($sql);
  jsLocationReplaceExit("../article/list.php", "회원정보가 수정되었습니다.");
