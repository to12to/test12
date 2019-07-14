<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once '../config/database.php';
 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'C:\wamp64\www\libanonreizendb\vendor\autoload.php';
 
$fname=$_POST["fname"];
$lname=$_POST["lname"];
$mobile=$_POST["mobile"];
$profilepic=$_POST["profilepic"];
$email=$_POST["email"];
 
$hashed_password = hash('sha512', $_POST['password']);
$gender=$_POST["gender"];
$dob=$_POST["dob"];
$oauthkey=$_POST["oauthkey"];
$authtype=$_POST["authtype"];

$database = new Database();
$db = $database->getConnection();
 
$stmt = $db ->prepare("CALL sp_signup_user('$fname','$lname','$mobile','$profilepic','$email','$hashed_password','$gender','$dob','$oauthkey','$authtype',@pstatus,@phash) ; ");

$stmt->execute();
$r = $db ->query('select @pstatus as status,@phash as hash')->fetch();
if($r['status']==1 && !empty($r['hash'])  ){$mail = new PHPMailer(TRUE);

    try {
       
       $mail->setFrom('hachache_ralph@hotmail.com', 'Ralph Hachache');
       $mail->addAddress($email, $fname);
       $mail->Subject = 'Account Verification'; 
       
        $message  = '<p>  <b>In order to verify your email please click the link below</b>
        <a href="http://localhost:3031/libanonreizendb/api/user/verify?email='
        .$email.
        '&hash='
         .$r['hash']. 
        '">Link</a></p>';
       /* SMTP parameters. */
       
       /* Tells PHPMailer to use SMTP. */
       $mail->isSMTP();
       $mail->IsHTML(true);
       /* SMTP server address. */
       $mail->Host = 'smtp.live.com';
       $mail->Body = $message;
       /* Use SMTP authentication. */
       $mail->SMTPAuth = TRUE;
       
       /* Set the encryption system. */
       $mail->SMTPSecure = 'tls';
       
       /* SMTP authentication username. */
       $mail->Username = 'putyouremail';
       
       /* SMTP authentication password. */
       $mail->Password = 'putyourpassword';
       
       /* Set the SMTP port. */
       $mail->Port = 587;
       
       /* Finally send the mail. */
       $mail->send();
    }
    catch (Exception $e)
    {
       echo $e->errorMessage();
    }
    catch (\Exception $e)
    {
       echo $e->getMessage();
    }
    

}
$status=array(
    "status" =>$r['status']
);
echo  json_encode($status);
 