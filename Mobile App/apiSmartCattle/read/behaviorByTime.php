<?php

require_once "../vendor/autoload.php";
require_once "../config/config.php";

use Propel\Runtime\Map\TableMap;
use model\model\Behavior_dataQuery;
use Rakit\Validation\Validator;

/*$cowID = $_GET['cowID'];
$dateSearchFrom = $_GET['dateSearchFrom'];					/*แบบที่1
$timeStamp = $_GET['timeStamp'];*/

$date = new DateTime();

// Takes raw data from the request
$inputJSON = file_get_contents('php://input');
// Converts it into a PHP object
$input= json_decode($inputJSON,true); 

$validator = new Validator();

$validation = $validator->make($input, [			/*แบบที่2*/
    'cowID' => 'required',
    'dateSearchFrom' => 'required',
    'timeStamp' => 'required',
]);

$validation->validate();

/*if($validation->fails()) {
    $cowBehaviors = 'Please insert date.';
    exit(json_encode($cowBehaviors));
}*/

extract($validation->getValidatedData());

$cowBehaviors = Behavior_dataQuery::create()
				->filterByTime(array("min" => $dateSearchFrom, "max" => $timeStamp))
            	->findByCowid($cowID);
                

/*If($cowBehaviors == null) {
	$cowBehaviors = 'No record.';
    exit(json_encode($cowBehaviors));
}*/

$cowBehaviors = $cowBehaviors->toArray(null, false,TableMap::TYPE_FIELDNAME);

echo json_encode(['cowBehaviors' => $cowBehaviors], JSON_PRETTY_PRINT);

?>