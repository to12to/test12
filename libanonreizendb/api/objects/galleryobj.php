<?php
require_once '../config/database.php';
class galleryobj{
 
    // database connection and table name
    private $conn; 
    // object properties
    public $id;
    public $src;
    public $name;
    public $description;
  
     // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
function read($id){
    $database = new Database();
    $db = $database->getConnection();
     
     //$stmt = $this->conn->prepare("CALL sp_get_activity('$ptourid')");
     $stmt = $db->prepare("CALL  sp_get_gallery('$id')");
    
 
 
    
     // execute query
     $stmt->execute();
     $num = $stmt->rowCount();
     $galleryobj_arr=array( ); 
     while ($row  = $stmt->fetch(PDO::FETCH_ASSOC)){
         extract($row);
         $gallery_item = new galleryobj ($this->conn);
         $gallery_item->id=$id;
         $gallery_item->src=$src;
         $gallery_item->name=$name;
         $gallery_item->description=$description;
                
         array_push($galleryobj_arr , $gallery_item);
 
     }
     return  $galleryobj_arr;
}
}