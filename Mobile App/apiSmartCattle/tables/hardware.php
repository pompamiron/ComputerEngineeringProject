<?php
class Hardware{

	// database connection and table name
    private $conn;
    private $table_name = "hardware";

    // object properties
    public $hwID;
    public $installPath;
    public $name;

 	// constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    //read hardware
    function read(){
  
        // select all query
        $query = "SELECT *
                  FROM $this->table_name;";
                  //ORDER BY hwID DESC;";
  
        // prepare query statement
        $stmt = $this->conn->prepare($query);
  
        // execute query
        $stmt->execute();
  
        return $stmt;
    }
}

?>