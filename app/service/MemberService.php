<?php
    class APP__MemberService {  
    private APP__MemberRepository $memberRepository;

    public function __construct() {
        global $App__memberRepository;
        $this->memberRepository = $App__memberRepository;
    }
    
    public function getForPrintMemberByLoginIdAndLoginPw(string $loginId, string $loginPw): array|null {
        return $this->memberRepository->getForPrintMemberByLoginIdAndLoginPw($loginId, $loginPw);
    }

    public function getForprintMemberByLoginId(string $loginId): array|null {   
        return $this->memberRepository->getForprintMemberByLoginId($loginId);
    }

    public function getForPrintMemberById(int $id):array|null {
        return $this->memberRepository->getForPrintMemberById($id);
    }

    public function joinMember(string $loginId, string $loginPw, string $name, string $nickname, string $email, string $phoneNo){
        return $this->memberRepository->joinMember($loginId, $loginPw, $name, $nickname, $email, $phoneNo);
    }
    public function deleteMember(int $id){
        return $this->memberRepository->deleteMember($id);
    }

    public function getForPrintMembers(): array {
        return $this->memberRepository->getForPrintMembers();
    }

    public function modifyMember(string $loginPw, string $name, string $nickname, string $email, string $phoneNo, int $App__loginedMemberId){
        return $this->memberRepository->modifyMember($loginPw, $name, $nickname, $email, $phoneNo, $App__loginedMemberId);
    }
}
?> 