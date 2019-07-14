<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once '../config/database.php';
 
$email=$_GET["email"];
$hash=$_GET["hash"];
$database = new Database();
$db = $database->getConnection();
 
$stmt = $db ->prepare("CALL  sp_verify('$email','$hash' ,@pstatus ) ; ");

$stmt->execute();
 
$r = $db ->query('select @pstatus as status;')->fetch();
$status=array(
    "status" =>$r['status']
);
echo  json_encode($status);
 