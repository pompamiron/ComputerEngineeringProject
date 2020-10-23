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

$behavior_data->cowID1 = isset($_GET['cowID1']) ? $_GET['cowID1'] : die();
$behavior_data->cowID2 = isset($_GET['cowID2']) ? $_GET['cowID2'] : die();

if($behavior_data->cowID1!=null && $behavior_data->cowID2!=null){

$stmt = $behavior_data->readBehaviorForNotification();
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
            "cowName" => $cowName,
            "behavior" => $behavior,
            "time" => $time,
        );

  		array_push($behavior_datas_arr, $behavior_item);
        //array_push($cows_arr["records"], $cow_item);
    }

    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode(['behavior' => $behavior_datas_arr], JSON_PRETTY_PRINT);
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