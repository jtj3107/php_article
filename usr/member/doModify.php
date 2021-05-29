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

  $sql = "
  select *
  from `member`
  where id = '${id}'
  ";

  $member = DB__getRow($sql);

  if(empty($member)){
    jsHistoryBackExit("잘못된 접근입니다.");
  }
  
  $sql = "
  update `member`
  set updateDate = now(),
  name = '${name}',
  nickname = '${nickname}',
  email = '${email}',
  phoneNo = '${phoneNo}'
  where id = '${id}'
  ";

  DB__modify($sql);
  jsLocationReplaceExit("../article/list.php", "회원정보가 수정되었습니다.");
