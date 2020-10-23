<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../tables/hardware.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$hardware = new Hardware($db);

// query products
$stmt = $hardware->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
  
    // products array
    $hardwares_arr=array();
    //$hardwares_arr["records"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	extract($row);

    	$hardware_item=array(
            "hwID" => $hwID,
            "installPath" => $installPath,
            "name" => $name
        );

  		array_push($hardwares_arr, $hardware_item);
        //array_push($hardwares_arr["records"], $hardware_item);
    }

    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($hardwares_arr);
}

else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No data found.")
    );
}