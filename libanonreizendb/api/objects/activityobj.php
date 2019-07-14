<?php
require_once '../config/database.php';
class activityobj{
 
    // database connection and table name
    private $conn; 
    // object properties
    public $id;
    public $name;
    public $description;
    public $pics = array();
     // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
function read($tourid){
    $database = new Database();
    $db = $database->getConnection();
     
     //$stmt = $this->conn->prepare("CALL sp_get_activity('$ptourid')");
     $stmt = $db->prepare("CALL sp_get_activity('$tourid')");
 
 
    
     // execute query
     $stmt->execute();
     $num = $stmt->rowCount();
     $activityobj_arr=array( ); 
     while ($rowactivity = $stmt->fetch(PDO::FETCH_ASSOC)){
         extract($rowactivity);
         $activity_item = new activityobj ($this->conn);
         $activity_item->id=$id;
         $activity_item->name=$name;
         $activity_item->description=$description;
         $activitypicobj_item = new activitypicobj($this->conn);
         $activity_item->pics=$activitypicobj_item->read($id);          
         array_push($activityobj_arr , $activity_item);
 
     }
     return  $activityobj_arr;
}
}