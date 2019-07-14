<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once '../config/database.php';
$email=$_POST["email"];
$hashed_password = hash('sha512', $_POST['password']);
$oauthkey=$_POST["oauthkey"];
$authtype=$_POST["authtype"];
$database = new Database();
$db = $database->getConnection();
 //echo $hashed_password ;
$stmt = $db ->prepare("CALL sp_signin_user('$email','$hashed_password','$oauthkey','$authtype',@pstatus) ; ");

$stmt->execute();
$r = $db ->query('select @pstatus as status;')->fetch();
$status=array(
    "status" =>$r['status']
);
 echo  json_encode($status);
 