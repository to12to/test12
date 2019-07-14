<?php
class userobj{
 
    // database connection and table name
    private $conn;

 
    // object properties
    public $id;
    public $name;
    public $description;
    public $price;
    public $isactive;
    public $activity = array();
    public $hotelpackage = array();     
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
 
function read($tourid){
    $stmt = $this->conn->prepare("CALL sp_get_tour('$tourid')");

    $activityobj = new activityobj($this->conn);
    $hotelpackageobj = new hotelpackageobj($this->conn);
    $tourobj_arr=array();
    $tourobj_arr["tour"]=array(); 
    // execute query
    $stmt->execute();
    while ($rowtour = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($rowtour);
        $tour_item=array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description) ,
            "activity" => $activityobj ->read($id),
            "hotelpackage" => $hotelpackageobj ->read($id)
        );
        
        array_push($tourobj_arr["tour"], $tour_item);

    }
    return  $tourobj_arr;


      
    
}
}