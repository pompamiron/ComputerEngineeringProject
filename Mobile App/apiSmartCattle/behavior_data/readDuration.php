<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../tables/behavior_data.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$behavior_data = new Behavior_data($db);

$behavior_data->cowID = isset($_GET['cowID']) ? $_GET['cowID'] : die();

$stmt = $behavior_data->readBehaviorArrayByCowID();

if($behavior_data->cowID!=null){

// query products
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
  
    // products array
    $behavior_datas_arr=array();
    //$cows_arr["records"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	extract($row);

    	$behavior_item=array(
            "behavior" => $behavior,
            "second" => $second,
            "durationTime" => $durationTime,
        );

  		array_push($behavior_datas_arr, $behavior_item);
        //array_push($cows_arr["records"], $cow_item);
    }

    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode(['behaviorDuration' => $behavior_datas_arr], JSON_PRETTY_PRINT);
}
}

else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No data found.")
    );
}