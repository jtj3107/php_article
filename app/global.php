<?php  
  // 리포지터리
  $App__articleRepository = new APP__ArticleRepository();
  $App__memberRepository = new APP__MemberRepository();
  $App__boardRepository = new APP__boardRepository();
  $App__replyRepository = new APP__replyRepository();
  $App__likeRepository = new APP__likeRepository();

  // 서비스 전역변수
  $App__articleService = new APP__ArticleService();
  $App__memberService = new APP__MemberService();
  $App__boardService = new APP__boardService();
  $App__replyService = new APP__replyService();
  $App__likeService = new APP__likeService();
  
  // 뷰에서 사용할 이용자의 로그인 상태관련 전역변수
  $_REQUEST['App__isLogined'] = false;
  $_REQUEST['App__loginedMemberId'] = 0;
  $_REQUEST['App__loginedMember'] = null;

  $application = new App__Application();
?>