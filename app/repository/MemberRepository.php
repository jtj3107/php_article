<?php
class APP__MemberRepository {
    public function getForprintMemberByLoginIdAndLoginPw(string $loginId, string $loginPw):array|null{         
      $sql = DB__secSql();
      $sql->add("SELECT *");
      $sql->add("FROM `member` AS M");
      $sql->add("WHERE M.loginId = ?", $loginId);
      $sql->add("AND M.loginPw = ?", $loginPw);

      return DB__getRow($sql);
    } 
    
    public function getForprintMemberById(int $id):array|null{
      $sql = DB__secSql();
      $sql->add("SELECT M.*");
      $sql->add("FROM `member` AS M");
      $sql->add("WHERE M.id = ?", $id);
      return DB__getRow($sql);
    }

    public function getForprintMemberByLoginId(string $loginId):array|null {
      $sql = DB__secSql();
      $sql->add("SELECT *");
      $sql->add("FROM `member`");
      $sql->add("WHERE loginId = ?", $loginId);
      return DB__getRow($sql); 
    } 

    public function deleteMember(int $id){
      $sql = DB__secSql();
      $sql->add("UPDATE `member`");
      $sql->add("SET delStatus = 0");
      $sql->add(", delDate = NOW()");
      $sql->add("WHERE id = ?", $id);
      DB__update($sql);
      unset($_SESSION['loginedMemberId']); 
    }
    
    public function getForPrintMembers(): array {
      $sql = DB__secSql();
      $sql->add("SELECT *");
      $sql->add("FROM `member` AS M");
      $sql->add("ORDER BY M.id DESC");
      return DB__getRows($sql); 
    }

    public function joinMember(string $loginId, string $loginPw, string $name, string $nickname, string $email, string $phoneNo){
      $sql = DB__secSql();
      $sql->add("INSERT INTO `member`");
      $sql->add("SET regDate = NOW()");
      $sql->add(", updateDate = NOW()");
      $sql->add(", loginId = ?", $loginId);
      $sql->add(", loginPw = ?", $loginPw);
      $sql->add(", `name` = ?", $name);
      $sql->add(",  nickname = ?", $nickname);
      $sql->add(", email = ?", $email);
      $sql->add(", phoneNo = ?", $phoneNo);
      $sql->add(", delStatus = 1");

      DB__query($sql);
    }

    public function modifyMember(string $loginPw, string $name, string $nickname, string $email, string $phoneNo, int $App__loginedMemberId){
      $sql = DB__secSql();
      $sql->add("UPDATE `member`");
      $sql->add("SET updateDate = NOW()");
      $sql->add(", loginPw = ?", $loginPw);
      $sql->add(", `name` = ?", $name);
      $sql->add(",  nickname = ?", $nickname);
      $sql->add(", email = ?", $email);
      $sql->add(", phoneNo = ?", $phoneNo);
      $sql->add("WHERE id = ?", $App__loginedMemberId);
      
      DB__update($sql);
    }
}
?>