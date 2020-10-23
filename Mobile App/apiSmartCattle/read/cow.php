<?php

require_once "../vendor/autoload.php";
require_once "../config/config.php";

use Firebase\JWT\JWT;

$data = JWT::decode($_GET['token'], $token_key, ['HS256']);

if(!isset($data->user)) {
    $data = [
        "error" => "Invalid input."
    ];
    http_response_code(422);

    exit(json_encode($data));
}

use model\model\CowQuery;
use model\model\FarmQuery;
use Propel\Runtime\Map\TableMap;


$cows = CowQuery::create()
            ->joinWithFarm()
            ->joinWithHardwareRelatedByHwid1()
            ->findByFarmid(intval($data->user)) //intval($data->user)
            ->toArray(null, false, TableMap::TYPE_FIELDNAME);

$results = array();            
foreach($cows as $cow) {
    unset($cow['farm']['cows']);

    $results[] = $cow;
}

echo json_encode(['cows' => $results], JSON_PRETTY_PRINT);

?>
            
            
