<?php

require_once '../vendor/autoload.php';
require_once '../generated-conf/config.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type", "application/json; charset=utf-8");

use model\model\Farm;
use model\model\Base\FarmQuery;
use Rakit\Validation\Validator;

use \Firebase\JWT\JWT;

// Takes raw data from the request
$inputJSON = file_get_contents('php://input');
// Converts it into a PHP object
$input= json_decode($inputJSON,true); 

$validator = new Validator();

$validation = $validator->make($input, [
    'user' => 'required',
    'pass' => 'required',
]);

$validation->validate();

if($validation->fails()) {
    $data = [
        'errors' => $validation->errors()->firstOfAll(),
        'loggedin' => false
    ];

    exit(json_encode($data));
}

extract($validation->getValidatedData());

$account = FarmQuery::create()
           ->filterByUsername($user)
           ->filterByPassword($pass)
           ->findOne();

if($account == null) {
    $data = [
        'errors' => ['description' => 'Username and password does not match.'],
        'loggedin' => false
    ];

    exit(json_encode($data));
}

$key = "viewviewkey";
$token = [
    'user' => $account->getFarmid(),
    'timestamp' => time()
];

$jwt = JWT::encode($token, $key);

$data = [
    'loggedin' => true,
    'token' => $jwt
];

exit(json_encode($data));

?>