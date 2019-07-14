<?php
require_once '../config/database.php';
class tourpicobj{
 
    // database connection and table name
    private $conn;
 
 
    // object properties
    public $id; 
    public $src; 
    
    
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
        
    }
    function read($tourid){
        $database = new Database();
        $db = $database->getConnection();
         
         //$stmt = $this->conn->prepare("CALL sp_get_activity('$ptourid')");
         $stmt = $db->prepare("CALL   sp_get_tourpic('$tourid')");
     
          
          
        
         $tourpicobj_arr=array();
 
         // execute query
         $stmt->execute();
         while ($rowtour = $stmt->fetch(PDO::FETCH_ASSOC)){
             extract($rowtour);
         
              $tourpic_item = new tourpicobj($this->conn);
            $tourpic_item->id=$id;
              $tourpic_item->src=$src;
             array_push($tourpicobj_arr , $tourpic_item);
     
         }
         return  $tourpicobj_arr;
    }
}