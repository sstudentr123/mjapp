<?php
require( '../php/config.php' );

//session
session_start();

spl_autoload_register(function ($class_name) {
    $load_FileName = str_replace('\\', '/', $class_name);
    $file_name = __DIR__ .'/php/'. $load_FileName .".php";
    if ( is_file($file_name) === true ) {
        require_once( $file_name );
    }else{
        header('Location: ../');
    }
});



class Indext {

    function __construct(){
        //(a--page,b--moth)
        if ( !empty( $_GET['a'] ) ) {
            $ClassName = str_replace('/', '\\', $_GET['a']);

            if($ClassName == 'login'){
                $this->login();
            }

            if($ClassName == 'logout'){
                $this->logout();
            }

            //有無登入
            if($_SESSION['adminName']==""){
                header('location:paLogin.php');
            }

            $ctrl = new $ClassName();
            if(method_exists($ctrl, $b = $_GET['b'])){
                $ctrl->$b();
            }
            else{
                require( './pa.php' );
            }
        }else{
            header('location:paLogin.php');
        }
    }

    function login(){
        global $pdo;
        $sql = " SELECT * FROM admin WHERE account = :account AND password = :password";
        $pre = $pdo->prepare($sql);
        $pre->bindValue(':account', $_POST['account']);
        $pre->bindValue(':password', md5('@#mj'. $_POST['password'] .'app!'));
        $pre->execute();
        if ( $pre->rowCount() >= 1) {
            $_SESSION['adminName'] = $_POST['account'];
            $Return = array( "Result"=>true, "Message"=>'登入成功', "Data"=>'' );
        } else {
            $Return = array( "Result"=>false, "Message"=>'帳號或密碼錯誤', "Data"=>'' );
        }
        echo json_encode($Return);
        exit();
    }

    function logout(){
        unset($_SESSION['adminName']);
        header('location:paLogin.php');
        exit();
    }
}

new Indext();





