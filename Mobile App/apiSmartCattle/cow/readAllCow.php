<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../tables/cow.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$cow = new Cow($db);

// query products
$stmt = $cow->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
  
    // products array
    $cows_arr=array();
    //$cows_arr["records"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	extract($row);

    	$cow_item=array(
            "cowID" => $cowID,
            "farmName" => $farmName,
            "hwName1" => $hwName1,
            "hwName2" => $hwName2,
            "name" => $name,
            "birthDate" => $birthDate
        );

  		array_push($cows_arr, $cow_item);
        //array_push($cows_arr["records"], $cow_item);
    }

    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($cows_arr);
}

else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No data found.")
    );
}