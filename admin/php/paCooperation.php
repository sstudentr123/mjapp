<?php
class paCooperation {
    function isPorder($porder,$id=null){
        global $pdo;
        $sql="SELECT Porder FROM cooperation WHERE Porder = :Porder";
        if($id){
            $sql = $sql.' AND id != :id';
        }
        $stmt= $pdo->prepare($sql);
        if($id){
            $stmt->bindValue(':id',$id);
        }
        $stmt->bindValue(':Porder',$porder);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            $Return = array("Result"=>false,"Message"=>'順序重複',"Data"=>'');
            echo json_encode($Return);
            exit();
        }
    }
    function porder(){
        global $pdo;
        //查詢Porder倒數第1筆
        $sql = "select Porder from cooperation ORDER BY Porder DESC LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $res = $stmt->execute();
        $row = $stmt->fetchAll(2);

        if ( $stmt->rowCount() >= 1 ) {
            $Return = array( "Result"=>true, "Message"=>'', "Data"=>$row );
        } else {
            $Return = array( "Result"=>false, "Message"=>'', "Data"=>'' );
        }
        echo json_encode($Return);
    }
    function paCooperation_add(){
        global $pdo;
        $this->isPorder($_POST['Porder']);
        $sql = "INSERT INTO cooperation (Porder,Content,Cover0,Status) VALUES (:Porder, :Content, :Cover0, :Status)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':Porder', $_POST['Porder']);
        $stmt->bindValue(':Content', $_POST['Content']);
        $stmt->bindValue(':Cover0', $_POST['Cover0']);
        $stmt->bindValue(':Status', $_POST['Status']);
        $stmt->execute();

        if ( $stmt->rowCount() >= 1 || $stmt->errorCode() == '00000' ) {
            $Return = array( "Result"=>true, "Message"=>'success', "Data"=>'' );
        } else {
            $Return = array( "Result"=>false, "Message"=>'error', "Data"=>'' );
        }
        echo json_encode($Return);
    }
    function paCooperation_delete(){
        global $pdo;
        $sql = "DELETE FROM cooperation WHERE id = :id";
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
    function paCooperation_seach(){
        global $pdo;
        //title
        $sql = "select * from cooperation_title";
        $stmt = $pdo->prepare($sql);
        $res = $stmt->execute();
        $title = $stmt->fetchAll(2);


        //搜詢
        $sql2 = "select * from cooperation ORDER BY Porder";
        $stmt = $pdo->prepare($sql2);
        $res = $stmt->execute();
        $Totle = $stmt->rowCount();


        //頁碼
        $pn =  $_POST['pn'];
        $p =  $_POST['p'];
        $start = ($p - 1) * $pn;
        $sql = "$sql2 LIMIT $start,$pn";
        $stmt = $pdo->prepare($sql);
        $res = $stmt->execute();
        $row = $stmt->fetchAll(2);


        if ( $stmt->rowCount() >= 1 ) {
            $Return = array( "Result"=>true, "Message"=>'', "Data"=>$row, "Title"=>$title ,"pageTotle"=>$Totle);
        } else {
            $start = 0;
            $sql = "$sql2 LIMIT $start,$pn";
            $stmt = $pdo->prepare($sql);
            $res = $stmt->execute();
            $row = $stmt->fetchAll(2);
            if ( $stmt->rowCount() >= 1 ) {
                $Return = array( "Result"=>true, "Message"=>'', "Data"=>$row, "Title"=>$title ,"pageTotle"=>$Totle);
            } else {
                $Return = array( "Result"=>false, "Message"=>'', "Data"=>'' );
            }
        }
        echo json_encode($Return);
    }
    function one(){
        global $pdo;
        $sql = "SELECT * FROM cooperation WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
        $row = $stmt->fetch(2);
        $Return = array( "Result"=>true, "Message"=>'', "Data"=>$row );
        echo json_encode($Return);
    }
    function paCooperation_modify(){
        global $pdo;

        $this->isPorder($_POST['Porder'],$_GET['id']);

        $sql = "UPDATE cooperation SET Porder =:Porder, Content=:Content, Status=:Status, Cover0=:Cover0 WHERE id =:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':Cover0', $_POST['Cover0']);
        $stmt->bindValue(':Porder', $_POST['Porder']);
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->bindValue(':Content', $_POST['Content']);
        $stmt->bindValue(':Status', $_POST['Status']);
        $stmt->execute();
        if ( $stmt->rowCount() >= 1 || $stmt->errorCode() == '00000') {
            $Return = array( "Result"=>true, "Message"=>'', "Data"=>'' );
        } else {
            $Return = array( "Result"=>false, "Message"=>'', "Data"=>'' );
        }
        echo json_encode($Return);
    }
    function title(){
        global $pdo;
        $sql = "SELECT * FROM cooperation_title WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
        $row = $stmt->fetch(2);
        $Return = array( "Result"=>true, "Message"=>'', "Data"=>$row );
        echo json_encode($Return);
    }
    function paCooperation_cootitle(){
        global $pdo;

        $sql = "UPDATE cooperation_title SET title =:title, subtitle=:subtitle WHERE id =:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':title', $_POST['title']);
        $stmt->bindValue(':subtitle', $_POST['subtitle']);
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
        if ( $stmt->rowCount() >= 1 || $stmt->errorCode() == '00000') {
            $Return = array( "Result"=>true, "Message"=>'', "Data"=>'' );
        } else {
            $Return = array( "Result"=>false, "Message"=>'', "Data"=>'' );
        }
        echo json_encode($Return);
    }
}
