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
          $loginId = getStrValueOr($_REQUEST['loginId'], "");
          $loginPw = getStrValueOr($_REQUEST['loginPw'], "");
          
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

        public function actionDoDelete(){
          $id = getIntValueOr($_SESSION['loginedMemberId'], 0);
  
          $member = $this->memberService->getForPrintMemberById($id);
  
          if($member == null){
              jsHistoryBackExit("잘못된 접근입니다.");
          }
          $this->memberService->deleteMember($id);
  
          jsLocationReplaceExit("../article/list.php", "회원 탈퇴 되었습니다.");
      }

      public function actionDoJoin(){
        $loginId = getStrValueOr($_GET['loginId'], "");
        $loginPw = getStrValueOr($_GET['loginPw'], "");
        $name = getStrValueOr($_GET['name'], "");
        $nickname = getStrValueOr($_GET['nickname'], "");
        $email = getStrValueOr($_GET['email'], "");
        $phoneNo = getStrValueOr($_GET['phoneNo'], "");

        if(empty($loginId)){
          jsHistoryBackExit("사용할 아이디를 입력헤주세요.");
        }
        
        if(empty($loginPw)){
          jsHistoryBackExit("사용하실 비밀번호를 입력해주세요.");
        }

        if(empty($name)){
          jsHistoryBackExit("이름을 입력해주세요.");
        }

        if(empty($nickname)){
          jsHistoryBackExit("사용하실 닉네임을 입력해주세요.");
        }
        
        if(empty($email)){
          jsHistoryBackExit("휴대전화번호를 입력해주세요.");
        }
        if(empty($phoneNo)){
          jsHistoryBackExit("이메일을 등록해주세요.");
        }

        $member = $this->memberService->getForprintMemberByLoginId($loginId);
        
        if(isset($member)){
          jsHistoryBackExit("${loginId}는 이미 사용중인 아이디입니다.");
        }

        $members = $this->memberService->getForPrintMembers();

        foreach($members as $member){
          if($member['name'] == $name and $member['email'] == $email){
            jsHistoryBackExit("이미 가입된 회원정보 입니다.");
          }
        }
        $this->memberService->joinMember($loginId, $loginPw, $name, $nickname, $email, $phoneNo);
        jsLocationReplaceExit("login.php", "회원가입 되었습니다.");
      }

      public function actionSHowJoin(){
        require_once App__getViewPath("usr/member/join");
      }

      public function actionShowModify(){
        $id = getIntValueOr($_SESSION['loginedMemberId'], 0);

        $member = $this->memberService->getForPrintMemberById($id);
      
        if(empty($member)){
         jsHistoryBackExit("잘못된 접근입니다.");
        }

        require_once APP__getViewPath("usr/member/modify");
      }
      
      public function actionDoModify(){
        $CurrentLoginPw = getStrValueOr($_GET['CurrentLoginPw'],"");
        $loginPw = getStrValueOr($_GET['loginPw'], "");
        $name = getStrValueOr($_GET['name'], ""); 
        $nickname = getStrValueOr($_GET['nickname'],"");
        $email = getStrValueOr($_GET['email'], "");
        $phoneNo = getStrValueOr($_GET['email'], "");
         

        if(empty($loginPw)){
          jsHistoryBackExit("비밃번호를 입력해주세요.");
        }

        if(empty($name)){
          jsHistoryBackExit("이름을 입력해주세요.");
        }
      
        if(empty($nickname)){
          jsHistoryBackExit("닉네임을 입력해주세요.");
        }
      
        if(empty($email)){
          jsHistoryBackExit("이메일를 입력해주세요.");
        }
      
        if(empty($phoneNo)){
          jsHistoryBackExit("휴대전화번호를 입력해주세요.");
        }

        $member = $this->memberService->getForPrintMemberById($_REQUEST['App__loginedMemberId']);
      
        if($member['loginPw'] != $CurrentLoginPw){
          jsHistoryBackExit("현재 비밀번호가 틀렸습니다.");
        }
        
        $this->memberService->modifyMember($loginPw, $name, $nickname, $email, $phoneNo, $_REQUEST['App__loginedMemberId']);
        jsLocationReplaceExit("../article/list.php", "회원정보가 수정되었습니다.");
      
      }
    }
?>