<?php
require_once '../config/database.php';
class activitypicobj{
 
    // database connection and table name
    private $conn;
 
 
    // object properties
    public $id; 
    public $src; 
    
      
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
        
    }
    function read($activityid){
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("CALL    sp_get_activitypic('$activityid')");
        $activitypicobj_arr=array();
        $stmt->execute();
         while ($row  = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $activitypic_item = new activitypicobj($this->conn);
            $activitypic_item->id=$id;
            $activitypic_item->src=$src;
            array_push($activitypicobj_arr , $activitypic_item);
     
         }
         return  $activitypicobj_arr;
    }
}