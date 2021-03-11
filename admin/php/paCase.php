<?php
class paCase {
    private function getTotle($sql){
        global $pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $Totle = $stmt->rowCount();
        return $Totle;
    }
    private function page($sql,$start,$pn,$Totle){
        global $pdo;
        $sql2 = "$sql LIMIT $start,$pn";
        $stmt = $pdo->prepare($sql2);
        $res = $stmt->execute();
        $row = $stmt->fetchAll(2);
        if ( $stmt->rowCount() >= 1 ) {
            $Return = array( "Result"=>true, "Message"=>'', "Data"=>$row, "pageTotle"=>$Totle);
        }else{
            $Return = array( "Result"=>false, "Message"=>'', "Data"=>$row);
        }
        return $Return;
    }
    function isPorder($porder,$id=null){
        global $pdo;
        $sql="SELECT Porder FROM product WHERE Porder = :Porder";
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
    function paCase_add(){
        global $pdo;

        $this->isPorder($_POST['Porder']);

        //多張圖片
        $sqlColumn = $sqlData = '';
        $Cover = array('Cover0','Cover1');
        foreach( $Cover as $v ){
            if ( $_POST[$v] !='' ){
                $sqlColumn .= ','.$v;
                $sqlData .= ', :'.$v;
            }
        }

        $sql = "INSERT INTO product (Porder,Pname,Content,Url,Status". $sqlColumn .") VALUES (:Porder, :Pname, :Content, :Url, :Status". $sqlData .")";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':Porder', $_POST['Porder']);
        $stmt->bindValue(':Pname', $_POST['Pname']);
        $stmt->bindValue(':Content', $_POST['Content']);
        $stmt->bindValue(':Url', $_POST['Url']);
        $stmt->bindValue(':Status', $_POST['Status']);
        foreach( $Cover as $v ){
            if ( $_POST[$v] !='' ) {
                $stmt->bindValue(':' . $v, $_POST[$v]);
            }
        }
        $stmt->execute();

        if ( $stmt->rowCount() >= 1 || $stmt->errorCode() == '00000' ) {
            $Return = array( "Result"=>true, "Message"=>'success', "Data"=>'' );
        } else {
            $Return = array( "Result"=>false, "Message"=>'error', "Data"=>'' );
        }
        echo json_encode($Return);
    }
    function paCase_delete(){
        global $pdo;
        $sql = "DELETE FROM product WHERE id = :id";
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
    function paCase_seach(){
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

        $sql = "select * from product";
        $sql = "$sql ORDER BY $porder $order";
        $Totle = $this->getTotle($sql);

        //頁碼
        $pn =  $_POST['pn'];
        $p =  $_POST['p'];
        $start = ($p - 1) * $pn;
        $sql2 = "$sql LIMIT $start,$pn";
        $stmt = $pdo->prepare($sql2);
        $res = $stmt->execute();
        $row = $stmt->fetchAll(2);


        if ( $stmt->rowCount() >= 1 ) {
            $Return = array( "Result"=>true, "Message"=>'', "Data"=>$row, "pageTotle"=>$Totle);
        } else {
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
        $sql = "SELECT * FROM product WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
        $row = $stmt->fetch(2);
        $Return = array( "Result"=>true, "Message"=>'', "Data"=>$row );
        echo json_encode($Return);
    }
    function paCase_modify(){
        global $pdo;

        $this->isPorder($_POST['Porder'],$_GET['id']);

         //多張圖片
        $sqlColumn = '';
        $Cover = array('Cover0','Cover1');
        foreach( $Cover as $v ){
            if ( $_POST[$v] !='' ){
                $sqlColumn .= ','.$v.'=:'.$v;
            }
        }

        $sql = "UPDATE product SET Porder =:Porder, Pname = :Pname, Content=:Content, Url=:Url, Status=:Status". $sqlColumn ." WHERE id =:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':Porder', $_POST['Porder']);
        $stmt->bindValue(':Pname', $_POST['Pname']);
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->bindValue(':Content', $_POST['Content']);
        $stmt->bindValue(':Url', $_POST['Url']);
        $stmt->bindValue(':Status', $_POST['Status']);
        foreach( $Cover as $v ){
            if ( $_POST[$v] !='' ) {
                $stmt->bindValue(':' . $v, $_POST[$v]);
            }
        }
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
        $sql = "select Porder from product ORDER BY Porder DESC LIMIT 1";
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
    function paCase_seachBox(){
        global $pdo;
        //totle
        $sql = "select * from product WHERE Status = :Status";
        if(!empty($_POST['seachText'])){
            $seachText = "AND (Porder LIKE :seachText OR Pname LIKE :seachText OR Url LIKE :seachText OR Content LIKE :seachText)";
            $sql = "$sql $seachText ORDER BY Porder";
        }else{
            $sql = "$sql ORDER BY Porder";
        }
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':Status', $_POST['status']);
        if(!empty($_POST['seachText'])){
            $stmt->bindValue(':seachText', '%'.$_POST['seachText'].'%');
        }
        $stmt->execute();
        $totle = $stmt->rowCount();

        //頁碼
        $pn =  $_GET['pn'];
        $p =  $_GET['p'];
        $start = ($p - 1) * $pn;
        $sql = "$sql LIMIT $start,$pn";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':Status', $_POST['status']);
        if(!empty($_POST['seachText'])){
            $stmt->bindValue(':seachText', '%'.$_POST['seachText'].'%');
        }
        $stmt->execute();
        $row = $stmt->fetchAll(2);

        if ( $stmt->rowCount() >= 1 ) {
            $Return = array( "Result"=>true, "Message"=>'', "Data"=>$row, "pageTotle"=>$totle);
        } else {
            $Return = array( "Result"=>false, "Message"=>'', "Data"=>'' );
        }
        echo json_encode($Return);
    }
    function sort(){
        global $pdo;
        $sql = 'UPDATE product SET  Porder = :Porder WHERE id = :id';
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
