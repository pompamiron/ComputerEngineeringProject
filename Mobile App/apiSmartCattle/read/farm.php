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

use model\model\FarmQuery;
use Propel\Runtime\Map\TableMap;

$farmName = FarmQuery::create()
			->findByFarmid(intval($data->user))
			->toArray(null, false,TableMap::TYPE_FIELDNAME)[0];

echo json_encode($farmName);

?>