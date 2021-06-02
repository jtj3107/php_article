<?php 
    class APP__UsrMemberController {
        private APP__MemberService $memberService;
      
        public function __construct(){
          global $App__memberService;
          $this->memberService = $App__memberService;
        }

        public function actionShowLogin() {
            require_once App__getViewPath("usr/member/login");
        }

        public function actionDologin(){
          $loginId = $_GET['loginId'];
          $loginPw = $_GET['loginPw'];
          
          if(empty($loginId)){
            jsHistoryBackExit("loginId를 입력해주세요.");
          }
          
          if(empty($loginPw)){
            jsHistoryBackExit("loginPw를 입력해주세요.");
          }
      
          $member = $this->memberService->getForprintMemberByLoginIdAndLoginPw($loginId, $loginPw);
      
          if(empty($member)){
            jsHistoryBackExit("존재하지 않는 회원 정보 입니다.");
          }
          if(empty($member['delStatus'])){
            jsHistoryBackExit("탈퇴한 회원입니다.");
          }
        
          $_SESSION['loginedMemberId'] = $member['id'];
          jsLocationReplaceExit("../article/list.php", "{$member['nickname']}님 환영합니다.");
        }
        public function actionDoLogout(){
          unset($_SESSION['loginedMemberId']);
          jsLocationReplaceExit("../article/list.php", "로그아웃 되었습니다.");
        }
    }
?>