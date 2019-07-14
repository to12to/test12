<?php
class tourobj{
 
    // database connection and table name
    private $conn;

 
    // object properties
    public $id;
    public $name;
    public $description;
    public $activity = array();
    public $hotelpackage = array();     
    public $pics = array();
    // constructor with $db as database connection
    public function __construct($db ){
        $this->conn = $db;
       /*  $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->activity = $activity;
        $this->hotelpackage = $hotelpackage;
        $this->pics = $pics;
        ,$id,$name,$description ,$activity,$hotelpackage,$pics */
    }
   		
 
function read($tourid){
    $stmt = $this->conn->prepare("CALL sp_get_tour('$tourid')");

    //$activityobj = new activityobj($this->conn);
    //$hotelpackageobj = new hotelpackageobj($this->conn);
    //$tourpicobj = new tourpicobj($this->conn);
     $tourobj_arr=array();
    
    // execute query
    $stmt->execute();
    while ($rowtour = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($rowtour);
        $tour_item = new tourobj($this->conn);
        $tour_item->id=$id;
        $tour_item->name=$name;
        $tour_item->description=$description;
        $activityobj = new activityobj($this->conn);
        $hotelpackageobj = new hotelpackageobj($this->conn);
        $tourpicobj = new tourpicobj($this->conn);
        $tour_item->pics=$tourpicobj->read($id);
        $tour_item->hotelpackage=$hotelpackageobj ->read($id);
        $tour_item->activity=$activityobj ->read($id);
       // $tour_item = new tourobj($this->conn,$id,$name,$description,$activityobj ->read($id),$hotelpackageobj ->read($id) ,$tourpicobj->read($id));
        array_push($tourobj_arr, $tour_item);

    }
    return  $tourobj_arr;


      
    
}
}