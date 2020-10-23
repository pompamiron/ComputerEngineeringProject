<?php

require_once "../vendor/autoload.php";
require_once "../config/config.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type", "application/json; charset=utf-8");

use model\model\FarmQuery;
use Propel\Runtime\Map\TableMap;
use Rakit\Validation\Validator;

// Takes raw data from the request
$inputJSON = file_get_contents('php://input');
// Converts it into a PHP object
$input= json_decode($inputJSON,true); 

$validator = new Validator();

$validation = $validator->make($input, [
	'farmID'	=> 'required',
	'oldPass'	=> 'required',
	'newPass'	=> 'required',
]);

$validation->validate();

if($validation->fails()) {
    $dataResponse = 'Please insert all fields.';
    exit(json_encode($dataResponse));
}

extract($validation->getValidatedData());

$farmIDRakit = $farmID;
$oldPassRakit = $oldPass;

$findFarm = FarmQuery::create()
        	->filterByFarmid($farmIDRakit)
        	->filterByPassword($oldPassRakit)
        	->findOne();

if($findFarm == null) {
	$dataResponse = 'Wrong password.';
    exit(json_encode($dataResponse));
}
else{
	$updateFarm = FarmQuery::create()
        	->filterByFarmid($farmID)
        	->filterByPassword($oldPass)
        	->findOne()
        	->setPassword($newPass)
        	->save();
    $dataResponse = 'Change password success.';
}

exit(json_encode($dataResponse));
?>