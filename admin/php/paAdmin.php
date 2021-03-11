<?php
class paAdmin {
    function isAccount($id=null){
        global $pdo;
        //判斷帳號
        $sql = "SELECT DISTINCT * FROM admin WHERE account = :account";
        if($id){
            $sql = $sql.' AND id != :id';
        }
        $pre = $pdo->prepare($sql);
        if($id){
            $pre->bindValue(':id', $_GET['id']);
        }
        $pre->bindValue(':account', $_POST['account']);
        $pre->execute();
        if ( $pre->rowCount() >= 1 ) {
            $Return = array( "Result"=>false, "Message"=>'帳號重複', "Data"=>'' );
            echo json_encode($Return);
            exit;
        }
    }
    function isEmail($id=null){
        global $pdo;
       //判斷信箱
        $sql = "SELECT DISTINCT * FROM admin WHERE email = :email";
        if($id){
            $sql = $sql.' AND id != :id';
        }
        $pre = $pdo->prepare($sql);
        if($id){
            $pre->bindValue(':id', $_GET['id']);
        }
        $pre->bindValue(':email', $_POST['email']);
        $pre->execute();
        if ( $pre->rowCount() >= 1 ) {
            $Return = array( "Result"=>false, "Message"=>'信箱重複', "Data"=>'' );
            echo json_encode($Return);
            exit;
        }
    }
    function paAdmin_delete(){
        global $pdo;
        $sql = "DELETE FROM admin WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
        if ( $stmt->rowCount() >= 1 || $stmt->errorCode() == '00000') {
            $Return = array( "Result"=>true, "Message"=>'', "Data"=>'' );
        } else {
            $Return = array( "Result"=>false, "Message"=>'', "Data"=>'' );
        }
        echo json_encode($Return);
    }
    function paAdmin_add(){
        global $pdo;

        $this->isAccount();
        $this->isEmail();
        

        $sql = "INSERT INTO admin (account,name,email,password,Cover0) VALUES (:account, :name, :email, :password, :Cover0)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':account', $_POST['account']);
        $stmt->bindValue(':name', $_POST['name']);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->bindValue(':Cover0', $_POST['Cover0']);
        $stmt->bindValue(':password', md5('@#mj' . $_POST['password'] . 'app!'));
        $stmt->execute();

        if ( $stmt->rowCount() >= 1 || $stmt->errorCode() == '00000' ) {
            $Return = array( "Result"=>true, "Message"=>'success', "Data"=>'' );
        } else {
            $Return = array( "Result"=>false, "Message"=>'error', "Data"=>'' );
        }
        echo json_encode($Return);
    }
    function paAdmin_seach(){
        global $pdo;
        //搜詢
        $sql = "select * from admin";
        $stmt = $pdo->prepare($sql);
        $res = $stmt->execute();
        $row = $stmt->fetchAll(2);
        $res = $stmt->execute();
        $Totle = $stmt->rowCount();

        //頁碼
        $pn = $_POST['pn'];
        $p = $_POST['p'];
        $start = ($p - 1) * $pn;
        $sql2 = "$sql LIMIT $start,$pn";
        $stmt = $pdo->prepare($sql2);
        $res = $stmt->execute();
        $row = $stmt->fetchAll(2);

        if ($stmt->rowCount() >= 1) {
            $Return = array("Result" => true, "Message" => '', "Data" => $row, "pageTotle" => $Totle);
        } else {
//            $Return = array("Result" => false, "Message" => '', "Data" => '');
            $start = 0;
            $sql = "$sql LIMIT $start,$pn";
            $stmt = $pdo->prepare($sql);
            $res = $stmt->execute();
            $row = $stmt->fetchAll(2);
            if ( $stmt->rowCount() >= 1 ) {
                $Return = array( "Result"=>true, "Message"=>'', "Data"=>$row ,"pageTotle"=>$Totle);
            } else {
                $Return = array( "Result"=>false, "Message"=>'', "Data"=>'' );
            }
        }
        echo json_encode($Return);
    }
    function one(){
        global $pdo;
        $sql = "SELECT * FROM admin WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
        $row = $stmt->fetch(2);
        $Return = array( "Result"=>true, "Message"=>'', "Data"=>$row );
        echo json_encode($Return);
    }
    function paAdmin_modify(){
        global $pdo;
        
        $this->isAccount($_GET['id']);
        $this->isEmail($_GET['id']);


        $sql = "UPDATE admin SET Cover0 =:Cover0, name = :name, email=:email ,account=:account WHERE id =:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':account', $_POST['account']);
        $stmt->bindValue(':Cover0', $_POST['Cover0']);
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->bindValue(':name', $_POST['name']);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->execute();
        if ( $stmt->rowCount() >= 1 || $stmt->errorCode() == '00000') {
            $Return = array( "Result"=>true, "Message"=>'', "Data"=>'' );
        } else {
            $Return = array( "Result"=>false, "Message"=>'', "Data"=>'' );
        }
        echo json_encode($Return);
    }
    function paAdmin_passwordBox(){
        global $pdo;
        $sql = " UPDATE admin SET password=:password WHERE id=:id ";
        $pre = $pdo->prepare($sql);
        $pre->bindValue(':password', md5('@#mj' . $_POST['password'] . 'app!'));
        $pre->bindValue(':id', $_GET['id']);
        $pre->execute();
        if ($pre->rowCount() >= 1 || $pre->errorCode() == '00000') {
            $Return = array("Result" => true, 'Message' => '');
        }else {
            $Return = array("Result"=>false, "Message" => '更新失敗,請重設密碼');
        }
        echo json_encode($Return);
    }
}
