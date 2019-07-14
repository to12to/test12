<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once '../config/database.php';
include_once '../objects/tourobj.php';
include_once '../objects/hotelpackageobj.php';
include_once '../objects/activityobj.php';
include_once '../objects/hotelobj.php';
include_once '../objects/tourpicobj.php';
include_once '../objects/hotelpackagepicobj.php';
include_once '../objects/hotelpicobj.php';
include_once '../objects/activitypicobj.php';
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
//$tourobj = new tourobj($db);
$tourid=$_GET["tourid"];
$stmt = $db ->prepare("CALL sp_get_tour('$tourid')");

$tour_item = new tourobj($db );     
//$tour_item->read($tourid);
 echo  json_encode(   $tour_item->read($tourid));


 /* 
$tourobj_arr=array(); 
// execute query
$stmt->execute();
while ($rowtour = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($rowtour);
    $tour_item = new tourobj($db );     
    
    array_push($tourobj_arr, $tour_item->read($id));
}
  echo  json_encode(  $tourobj_arr); */
  
 
 