<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
  if(!isset($_GET['name'])){
    echo "이름을 입력헤주세요";
    exit;
  }
  
  if(!isset($_GET['code'])){
    echo "코드를 입력헤주세요";
    exit;
  }

  $name = $_GET['name'];
  $code = $_GET['code'];
  $memberId = isset($_SESSION['loginedMemberId']) ? intval($_SESSION['loginedMemberId']) : 0;
                            
  if(!isset($memberId)){
    echo "로그인후 사용가능합니다.";
    exit;
  }

  $sql = "
  insert into board
  set regDate = now(),
  updateDate = now(),
  `name` = '${name}',
  `code` = '${code}',
  memberId = '${memberId}'
  ";

  $id = DB__insertId($sql);
?>
<script>
alert('<?=$id?>번 게시판이 생성되었습니다.');
location.replace('../article/list.php');
</script>