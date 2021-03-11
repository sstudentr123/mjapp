<?php
class paTeam {
    private function getTotle($sql){
        global $pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $Totle = $stmt->rowCount();
        return $Totle;
    }
    function isPorder($porder,$id=null){
        global $pdo;
        $sql="SELECT Porder FROM team WHERE Porder = :Porder";
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
    function paTeam_add(){
        global $pdo;
        $this->isPorder($_POST['Porder']);

        $sql = "INSERT INTO team (Porder,title,subtitle,Content,Cover0,status) VALUES (:Porder, :title, :subtitle, :Content, :Cover0, :status)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':Porder', $_POST['Porder']);
        $stmt->bindValue(':title', $_POST['title']);
        $stmt->bindValue(':subtitle', $_POST['subtitle']);
        $stmt->bindValue(':Content', $_POST['Content']);
        $stmt->bindValue(':Cover0', $_POST['Cover0']);
        $stmt->bindValue(':status', $_POST['status']);
        $stmt->execute();

        if ( $stmt->rowCount() >= 1 || $stmt->errorCode() == '00000' ) {
            $Return = array( "Result"=>true, "Message"=>'success', "Data"=>'' );
        } else {
            $Return = array( "Result"=>false, "Message"=>'error', "Data"=>'' );
        }
        echo json_encode($Return);
    }
    function paTeam_delete(){
        global $pdo;
        $sql = "DELETE FROM team WHERE id = :id";
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
    function paTeam_seach(){
        global $pdo;
        $porder = 'Porder';
        $order = 'ASC';
        //搜詢
        if(!empty($_POST['e'])){
            $order = $_POST['e'];
        }
        if(!empty($_POST['o'])){
            $porder = $_POST['o'];
        }

        $sql = "select * from team";
        $sql = "$sql ORDER BY $porder $order";
        $Totle = $this->getTotle($sql);

        $pn =  $_POST['pn'];
        $p =  $_POST['p'];
        $start = ($p - 1) * $pn;
        $sql2 = "$sql LIMIT $start,$pn";
        $stmt = $pdo->prepare($sql2);
        $res = $stmt->execute();
        $row = $stmt->fetchAll(2);

        if ( $stmt->rowCount() >= 1 ) {
            $Return = array( "Result"=>true, "Message"=>'', "Data"=>$row ,"pageTotle"=>$Totle);
        } else {
//            $Return = array( "Result"=>false, "Message"=>'', "Data"=>'' );
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
        $sql = "SELECT * FROM team WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
        $row = $stmt->fetch(2);
        $Return = array( "Result"=>true, "Message"=>'', "Data"=>$row );
        echo json_encode($Return);
    }
    function paTeam_modify(){
        global $pdo;
        $this->isPorder($_POST['Porder'],$_GET['id']);
        $sql = "UPDATE team SET Porder =:Porder, title = :title, Content=:Content, subtitle=:subtitle, status=:status, Cover0=:Cover0 WHERE id =:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':Cover0', $_POST['Cover0']);
        $stmt->bindValue(':Porder', $_POST['Porder']);
        $stmt->bindValue(':title', $_POST['title']);
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->bindValue(':Content', $_POST['Content']);
        $stmt->bindValue(':subtitle', $_POST['subtitle']);
        $stmt->bindValue(':status', $_POST['status']);
        $stmt->execute();
        if ( $stmt->rowCount() >= 1 || $stmt->errorCode() == '00000') {
            $Return = array( "Result"=>true, "Message"=>'', "Data"=>'' );
        } else {
            $Return = array( "Result"=>false, "Message"=>'', "Data"=>'' );
        }
        echo json_encode($Return);
    }
    function porder(){
        global $pdo;
        //查詢Porder倒數第1筆
        $sql = "select Porder from team ORDER BY Porder DESC LIMIT 1";
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
    function sort(){
        global $pdo;
        $sql = 'UPDATE team SET  Porder = :Porder WHERE id = :id';
        $stmt = $pdo->prepare($sql);

        // 更新所有資料排序
        foreach ($_REQUEST['data'] as $key => $value) {
            echo $value;
            $stmt->execute(array(
                'Porder'  => ($key+1),
                'id'    => $value
            ));
        }
    }
}
