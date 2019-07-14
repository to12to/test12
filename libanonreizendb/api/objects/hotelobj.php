<?php
class hotelobj{
 
    // database connection and table name
    private $conn;
    private $table_name = "products";
 
    // object properties
    public $id;
    public $name;
    public $description; 
 
    public $pics = array();
    
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    function read($hotelpackageid){
        $database = new Database();
        $db = $database->getConnection();
         
         //$stmt = $this->conn->prepare("CALL sp_get_activity('$ptourid')");
         $stmt = $db->prepare("CALL    sp_get_hotel('$hotelpackageid')");
     
     
        
         // execute query
         $stmt->execute();
         $num = $stmt->rowCount();
         $hotelobj_arr=array(); 
         while ($rowhotel = $stmt->fetch(PDO::FETCH_ASSOC)){
             extract($rowhotel);
             $hotel_item = new hotelobj ($this->conn);             
             $hotel_item->id=$id;
             $hotel_item->name=$name;
             $hotel_item->description=$description;
             $hotelpicobj = new hotelpicobj($this->conn);
             $hotel_item->pics=$hotelpicobj->read($id);
              
             array_push($hotelobj_arr , $hotel_item);
     
         }
         return  $hotelobj_arr;
    }
}