<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

 require 'phpmailer/src/Exception.php';
 require 'phpmailer/src/PHPMailer.php';
 require 'phpmailer/src/SMTP.php';


    $mail = new PHPMailer(true);

    $mail->isSMTP(); 
    //$mail->SMTPDebug = 2;
    $mail->Host="smtp.hostinger.com";
    $mail->SMTPAuth = true;
    $mail->Username="donotreply@benbandrowski.co.uk";
    $mail->Password="Stophackingthispassword!1";
    $mail->SMTPSecure="ssl";
    $mail->Port=465;
    $mail->AddEmbeddedImage('../assets/images/icon-success-lg.svg', 'tick');

    $mail->setFrom("donotreply@benbandrowski.co.uk");

    $mail->addAddress($_REQUEST["email"]);

    $mail->isHTML(true);

    $mail->Subject = "Newsletter subscription";
    $mail->Body= "Hi " . $_REQUEST["email"] . "," . "<br><br>You have successfully signed up to our newsletter. You will now receive regular updates!<br><br><br><br><center><img src='cid:tick'></center>";

    $mail->send();

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result=curl_exec($ch);
    curl_close($ch);
    $decode = json_decode($result,true);	

    $output['status']['code'] = "200";
    $output['status']['name'] = "ok";
    $output['status']['description'] = "success";
    $output['data'] = $decode;
        
    header('Content-Type: application/json; charset=UTF-8');

    echo json_encode($output); 
?>
