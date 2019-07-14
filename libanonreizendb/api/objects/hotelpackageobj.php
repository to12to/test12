<?php
require_once '../config/database.php';
class hotelpackageobj{
 
    // database connection and table name
    private $conn;
    private $table_name = "products";
 
    // object properties
    public $id;
    public $name;
    public $description; 
   
    public $hotel = array();
    public $pics = array();
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    function read($tourid){
        $database = new Database();
        $db = $database->getConnection();
         
         //$stmt = $this->conn->prepare("CALL sp_get_activity('$ptourid')");
         $stmt = $db->prepare("CALL  sp_get_hotelpackage('$tourid')");
     
         //$hotelobj = new hotelobj($this->conn);
        
         // execute query
         $stmt->execute();
         $num = $stmt->rowCount();
         $hotelpackageobj_arr=array( ); 
         while ($rowhotelpackage = $stmt->fetch(PDO::FETCH_ASSOC)){
             extract($rowhotelpackage);
             $hotelpackage_item = new hotelpackageobj ($this->conn);
             $hotelobj = new hotelobj($this->conn);
             $hotelpackagepicobj = new hotelpackagepicobj($this->conn);
             $hotelpackage_item->id=$id;
             $hotelpackage_item->name=$name;
             $hotelpackage_item->description=$description;       
             $hotelpackage_item->hotel=$hotelobj ->read($id);
            
              
             $hotelpackage_item->pics=$hotelpackagepicobj ->read($id);
             array_push($hotelpackageobj_arr , $hotelpackage_item);
     
         }
         return  $hotelpackageobj_arr;
    }
}