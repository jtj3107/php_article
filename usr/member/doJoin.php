<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
  if(empty($_GET['loginId'])){
    echo "사용할 아이디를 입력헤주세요.\n";
    echo "<button onclick = \"location.href = 'join.php' \">회원가입으로 돌아가기</button>";
    exit;
  }
  
  if(empty($_GET['loginPw'])){
    echo "사용하실 비밀번호를 입력해주세요.\n";
    echo "<button onclick = \"location.href = 'join.php' \">회원가입으로 돌아가기</button>";
    exit;
  }

  if(empty($_GET['name'])){
    echo "이름을 입력해주세요.\n";
    echo "<button onclick = \"location.herf = 'join.php'\">회원가입으로 돌아가기</button>";
    exit;
  }

  if(empty($_GET['nickname'])){
    echo "사용하실 닉네임을 정해주세요.\n";
    echo "<button onclick = \"location.herf = 'join.php'\">회원가입으로 돌아가기</button>";
    exit;
  }
  
  if(empty($_GET['phoneNo'])){
    echo "휴대전화번호를 입력해주세요.\n";
    echo "<button onclick = \"location.herf = 'join.php'\">회원가입으로 돌아가기</button>";
    exit;
  }
  if(empty($_GET['email'])){
    echo "이메일을 등록해주세요.\n";
    echo "<button onclick = \"location.herf = 'join.php'\">회원가입으로 돌아가기</button>";
    exit;
  }

  $loginId = $_GET['loginId'];
  $loginPw = $_GET['loginPw'];
  $name = $_GET['name']; 
  $nickname = $_GET['nickname'];
  $email = $_GET['email'];
  $phoneNo = $_GET['phoneNo'];
                            
  $sql = "
  insert into `member`
  set regDate = now(),
  updateDate = now(),
  loginId = '${loginId}',
  loginPw = '${loginPw}',
  `name` = '${name}',
  nickname = '${nickname}',
  email = '${email}',
  phoneNo = '${phoneNo}'
  ";

  DB__query($sql);
?>
<script>
alert('회원가입이 완료 되었습니다.');
location.replace('../article/list.php');
</script>