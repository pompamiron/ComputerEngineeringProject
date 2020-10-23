<?php

require_once '../vendor/autoload.php';
require_once '../generated-conf/config.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type", "application/json; charset=utf-8");

use model\model\Cow;
use model\model\Base\CowQuery;
use model\model\General_data;
use model\model\General_dataQuery;
use Rakit\Validation\Validator;

// Takes raw data from the request
$inputJSON = file_get_contents('php://input');
// Converts it into a PHP object
$input= json_decode($inputJSON,true); 

$validator = new Validator();

$validation = $validator->make($input, [
	'cowID'	 => 'required',
    'action' => 'required',
    'time'   => 'required',
]);

$validation->validate();

if($validation->fails()) {
    $dataResponse = 'Please insert an action.';
    exit(json_encode($dataResponse));
}

extract($validation->getValidatedData());

$newGeneralData = (new General_data) 
					-> setCowid($cowID)
					-> setAction($action)
					-> setTime($time)
					-> save();

$dataResponse = 'Add medical record success.';

exit(json_encode($dataResponse));
?>