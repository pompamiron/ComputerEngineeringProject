<?php
class Cow{

	// database connection and table name
    private $conn;
    private $table_name = "cow";

    // object properties
    public $cowID;
    public $farmName;
    public $hwName1;
    public $hwName2;
    public $name;
    public $birthDate;

 	// constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    //read all cow
    function read(){
  
        // select all query
        $query = "SELECT c.cowID, f.farmName as farmName, h1.name as hwName1, h2.name as hwName2, c.name, c.birthDate
                  FROM $this->table_name c
                  JOIN farm f on c.farmID = f.farmID
                  JOIN hardware h1 on c.hwID1 = h1.hwID
                  JOIN hardware h2 on c.hwID2 = h2.hwID;";
                  //ORDER BY hwID DESC;";
  
        // prepare query statement
        $stmt = $this->conn->prepare($query);
  
        // execute query
        $stmt->execute();
  
        return $stmt;
    }

    //read one cow
    function readOne(){
  
        // query to read single record
        $query = "SELECT c.cowID, f.farmName as farmName, h1.name as hwName1, h2.name as hwName2, c.name, c.birthDate
                  FROM $this->table_name c
                  JOIN farm f on c.farmID = f.farmID
                  JOIN hardware h1 on c.hwID1 = h1.hwID
                  JOIN hardware h2 on c.hwID2 = h2.hwID
                  WHERE cowID = ?;";
                  //LIMIT 0,1;";
  
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
  
        // bind id of product to be updated
        $stmt->bindParam(1, $this->cowID);
  
        // execute query
        $stmt->execute();
  
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
        // set values to object properties
        $this->cowID = $row['cowID'];
        $this->farmName = $row['farmName'];
        $this->hwName1 = $row['hwName1'];
        $this->hwName2 = $row['hwName2'];
        $this->name = $row['name'];
        $this->birthDate = $row['birthDate'];
    }
}

?>