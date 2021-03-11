<?php
    //驗證碼 captcha
    session_start();


//    //文字
//    define('captch',6);
//    $pass_phrase='';
//    for($i=0;$i<captch;$i++){
//        //chr把數字轉成ASCII字元
//        $pass_phrase.=chr(rand(96,122));
//    }
//    //記起來
//    $_SESSION['pass_phrase'] = shal($pass_phrase);



    $md5_hash = md5(rand(0,999));
    $security_code = substr($md5_hash, 15, 5);
    //Set the session to store the security code
    $_SESSION["security_code"] = $security_code;

    //寬高
    define('w',260);
    define('h',120);
    $img=imagecreatetruecolor(w,h);
    $bg_color=imagecolorallocate($img,255,255,255);
    $graphic_color = imagecolorallocate($img,64,64,64);
    $text_color = imagecolorallocate($img,0,0,0);
    //背景色
    imagefilledrectangle($img,0,0,w,h,$bg_color);
    //線
    for($i=0;$i<5;$i++){
        imageline($img,0,rand()%h,w,rand()%h,$graphic_color);
    }
    //點
    for($i=0;$i<50;$i++){
        imagesetpixel($img,rand()%w,rand()%h,$graphic_color);
    }
    //圓
    imagefilledellipse($img,5,5,10,10,$graphic_color);

    //文字
//    imagestring($img, 30, 40, 70,$security_code,$text_color);
    imagettftext($img,30,0,40,72,$text_color,'../font/arial.ttf',$security_code);

    //文字選轉
    //imagestringup();


    //輸出
    header('Content-type:image/png');
//    imagepng($img,'存放路徑','壓縮等級');
    imagepng($img);
    imagedestroy($img);//銷毀

