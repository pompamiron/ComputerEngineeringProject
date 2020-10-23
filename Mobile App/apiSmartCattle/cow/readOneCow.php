<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../tables/cow.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$cow = new Cow($db);
  
// set ID property of record to read
$cow->cowID = isset($_GET['cowID']) ? $_GET['cowID'] : die();
  
// read the details of product to be edited
$cow->readOne();
  
if($cow->cowID!=null){
    // create array
    $cow_arr = array(
        "cowID" => $cow->cowID,
        "farmName" => $cow->farmName,
        "hwName1" => $cow->hwName1,
        "hwName2" => $cow->hwName2,
        "name" => $cow->name,
        "birthDate" => $cow->birthDate
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($cow_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));
}
?>