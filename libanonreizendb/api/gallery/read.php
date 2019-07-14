<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../objects/galleryobj.php';
$id=$_GET["id"];
$database = new Database();
$db = $database->getConnection();
$galleryobj = new galleryobj($db);
echo  json_encode(  $galleryobj->read($id));