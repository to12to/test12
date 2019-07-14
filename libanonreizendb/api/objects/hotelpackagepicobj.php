<?php
require_once '../config/database.php';
class hotelpackagepicobj{
 
    // database connection and table name
    private $conn;
 
 
    // object properties
    public $id; 
    public $src; 
    
      
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
        
    }
    function read($hotelpackageid){
         
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("CALL    sp_get_hotelpackagepic('$hotelpackageid')");
        $hotelpackagepicobj_arr=array();
        $stmt->execute();
         while ($row  = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $hotelpackagepic_item = new hotelpackagepicobj($this->conn);
            $hotelpackagepic_item->id=$id;
            $hotelpackagepic_item->src=$src;
            array_push($hotelpackagepicobj_arr , $hotelpackagepic_item);
     
         }
         return  $hotelpackagepicobj_arr;
    }
}