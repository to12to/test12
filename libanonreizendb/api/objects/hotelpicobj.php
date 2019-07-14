<?php
require_once '../config/database.php';
class hotelpicobj{
 
    // database connection and table name
    private $conn;
 
 
    // object properties
    public $id; 
    public $src; 
    
      
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
        
    }
    function read($hotelid){
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("CALL     sp_get_hotelpic('$hotelid')");
        $hotelpicobj_arr=array();
        $stmt->execute();
         while ($row  = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $hotelpicobj_item = new hotelpicobj($this->conn);
            $hotelpicobj_item->id=$id;
            $hotelpicobj_item->src=$src;
            array_push($hotelpicobj_arr , $hotelpicobj_item);
     
         }
         return  $hotelpicobj_arr;
    }
}