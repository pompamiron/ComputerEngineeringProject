<?php

require_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;

$token = $_GET['token'];

$key = "viewviewkey";
$data = JWT::decode($token, $key, ['HS256']);

$data = [
    'token' => $data
];

exit(json_encode($data));

?>