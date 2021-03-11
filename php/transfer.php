<?php
require('./config.php');


if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = 0;
}
if(isset($_GET['act'])){
    $act = $_GET['act'];
    $act($id);
}
if(isset($_POST['act'])){
    $act = $_POST['act'];
}


function dream(){
    global $pdo;
    $sql = "SELECT id,Cover0,Pname,Content,Url from product WHERE Status LIKE 'Y' ORDER BY Porder";
    $stmt = $pdo->prepare($sql);
    $res = $stmt->execute();
    $row = $stmt->fetchAll(2);

    $sql = "SELECT Cover0,Content from cooperation WHERE Status LIKE 'Y' ORDER BY Porder";
    $stmt = $pdo->prepare($sql);
    $res = $stmt->execute();
    $row3 = $stmt->fetchAll(2);

    $sql = "SELECT title,subtitle from cooperation_title";
    $stmt = $pdo->prepare($sql);
    $res = $stmt->execute();
    $row4 = $stmt->fetchAll(2);

    $sql = "SELECT Cover0,title,subtitle,Content from team WHERE Status LIKE 'Y' ORDER BY Porder";
    $stmt = $pdo->prepare($sql);
    $res = $stmt->execute();
    $row2 = $stmt->fetchAll(2);


    if ( $stmt->rowCount() >= 1 ) {
        $Return = array( "Result"=>true, "product"=>$row, "team"=>$row2, "cooperation"=>$row3, "cooperation_title"=>$row4);
    } else {
        $Return = array( "Result"=>false, "Message"=>'', "Data"=>'' );
    }

    //post   
    // echo json_encode($Return);

    //get  
    echo $_GET['callback'].'('.json_encode($Return).')';

}

function caseOne(){
    global $pdo;
    $sql = "SELECT Cover0,Pname,Content from product WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id',$_GET['id']);
    $stmt->execute();
    $row = $stmt->fetchAll(2);

    if ( $stmt->rowCount() >= 1 ) {
        $Return = array( "Result"=>true, "Message"=>'', "Data"=>$row);
    } else {
        $Return = array( "Result"=>false, "Message"=>'', "Data"=>'' );
    }

    //get  
    echo $_GET['callback'].'('.json_encode($Return).')';
}


function ifCaptcha(){
    //post  
    // if(($_POST['userNumber']!=$_SESSION["security_code"]) && empty($_POST["security_code"])){
    //     $Return = array( "Result"=>false, "Message"=>'驗證碼錯誤', "Data"=>'' );
    // }else{
    //     $Return = array( "Result"=>true, "Message"=>'', "Data"=>'' );
    // }

    // echo json_encode($Return);


    //get  
    if($_GET['userNumber']!=$_SESSION["security_code"]){
        $Return = array( "Result"=>false, "Message"=>'驗證碼錯誤', "Data"=>'');
    }else{
        $Return = array( "Result"=>true, "Message"=>'', "Data"=>'' );
    }

    echo $_GET['callback'].'('.json_encode($Return).')';
}

function FormEmail(){
    require_once('./PHPMailer-master/PHPMailerAutoload.php'); //引入phpMailer

    //google
//    $mail= new PHPMailer(); //初始化一個PHPMailer物件
//    $mail->Host = "smtp.gmail.com"; //SMTP主機 (這邊以gmail為例，所以填寫gmail stmp)
//    $mail->IsSMTP(); //設定使用SMTP方式寄信
//    $mail->SMTPAuth = true; //啟用SMTP驗證模式(需打入Username,Password)
//    $mail->Username = "sstudentr123900700@gmail.com"; //您的 gamil 帳號
//    $mail->Password = "494b24240501google"; //您的 gmail 密碼
//    $mail->SMTPSecure = "ssl"; // SSL連線 (要使用gmail stmp需要設定ssl模式)
//    $mail->Port = 465; //Gamil的SMTP主機的port(Gmail為465)。
//    $mail->CharSet = "utf-8"; //郵件編碼
//    $mail->From = $_POST['Yemail']; //寄件者信箱
//    $mail->FromName = $_POST['Yname']; //寄件者姓名
//    $mail->AddAddress("sstudentr900@gmail.com", "我"); //收件人郵件和名稱
//    //$mail->AddBCC('cc@example.com'); //設定 密件副本收件人
//    $mail->IsHTML(true); //郵件內容為html
//    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); //添加附件(若不需要則註解掉就好)
//    $mail->Subject = $_POST['Yname']."從官網寄信給你"; //郵件標題
//    $mail->Body = $_POST['Ycontent']; //郵件內容
//    //$mail->addAttachment('../uploadfile/file/dirname.png','new.jpg'); //附件，改以新的檔名寄出
//    //$mail->AltBody = '當收件人的電子信箱不支援html時，會顯示這串~~';
//    if(!$mail->send()) {
//        $Return = array( "Result"=>false, "Message"=>$mail->ErrorInfo , "Data"=>'e');
//    } else {
//        $Return = array( "Result"=>true, "Message"=>'', "Data"=>'a' );
//    }
//    echo json_encode($Return);



//     if(empty($_POST['userMail'])||empty($_POST['userName'])||empty($_POST['userText'])||empty($_POST['userPhone'])){
//         $Return = array( "Result"=>false, "Message"=>'', "Data"=>'' );
//         echo json_encode($Return);
//         exit();
//     }    
//     //伺服器
//     $mail= new PHPMailer(); //初始化一個PHPMailer物件
//     $mail->Host = "localhost"; //SMTP主機
//     $mail->IsSMTP(); //設定使用SMTP方式寄信
// //    $mail->SMTPDebug= 2; // 打開顯示寄信過程
//     $mail->Port = 25;
//     $mail->CharSet = "UTF-8"; //郵件編碼
//     $mail->From = $_POST['userMail']; //寄件者信箱
//     $mail->FromName = $_POST['userName']; //寄件者姓名
//     $mail->AddAddress("sstudentr900@gmail.com"); //收件人郵件和名稱
// //    $mail->AddAddress("8hdec9@sm.hoyo.idv.tw"); //收件人郵件和名稱
//     //$mail->AddBCC('cc@example.com'); //設定 密件副本收件人
//     $mail->IsHTML(true); //郵件內容為html
//     //$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); //添加附件(若不需要則註解掉就好)
//     $mail->Subject = $_POST['userName']."從明郅資訊官網寄信給你"; //郵件標題
//     // $mail->Body = $_POST['userText']; //郵件內容
//     $mail->Body = $_POST['userText'].'<br><br><br><br>'.'連絡人名稱:'.$_POST['userName'].'<br>'.'連絡人電話:'.$_POST['userPhone'].'<br>'.'連絡人信箱:'.$_POST['userMail']; //郵件內容
//     //$mail->addAttachment('../uploadfile/file/dirname.png','new.jpg'); //附件，改以新的檔名寄出
//     //$mail->AltBody = '當收件人的電子信箱不支援html時，會顯示這串~~';
//     if(!$mail->send()) {
//         $Return = array( "Result"=>false, "Message"=>'' , "Data"=>$mail->ErrorInfo);
//     } else {
//         $Return = array( "Result"=>true, "Message"=>'', "Data"=>'' );
//     }
//     header('Access-Control-Allow-Origin:*');
//     echo json_encode($Return);



    if(empty($_GET['userMail'])||empty($_GET['userName'])||empty($_GET['userText'])||empty($_GET['userPhone'])){
        $Return = array( "Result"=>false, "Message"=>'', "Data"=>'' );
        echo $_GET['callback'].'('.json_encode($Return).')';
        exit();
    }    
    //伺服器
    $mail= new PHPMailer(); //初始化一個PHPMailer物件
    $mail->Host = "localhost"; //SMTP主機
    $mail->IsSMTP(); //設定使用SMTP方式寄信
    $mail->Port = 25;
    $mail->CharSet = "UTF-8"; //郵件編碼
    $mail->From = $_GET['userMail']; //寄件者信箱
    $mail->FromName = $_GET['userName']; //寄件者姓名
    $mail->AddAddress("sstudentr900@gmail.com"); //收件人郵件和名稱
    $mail->IsHTML(true); //郵件內容為html
    $mail->Subject = $_GET['userName']."從明郅資訊官網寄信給你"; //郵件標題
    $mail->Body = $_GET['userText'].'<br><br><br><br>'.'連絡人名稱:'.$_GET['userName'].'<br>'.'連絡人電話:'.$_GET['userPhone'].'<br>'.'連絡人信箱:'.$_GET['userMail']; //郵件內容
    if(!$mail->send()) {
        $Return = array( "Result"=>false, "Message"=>'' , "Data"=>$mail->ErrorInfo);
    } else {
        $Return = array( "Result"=>true, "Message"=>'', "Data"=>'' );
    }

    echo $_GET['callback'].'('.json_encode($Return).')';
}






