<?php

require_once "../vendor/autoload.php";
require_once "../config/config.php";

use Propel\Runtime\Map\TableMap;
use model\model\HardwareQuery;

$hwID = $_GET['hwID'];

$hardware = HardwareQuery::create()
            ->findByHwid($hwID);

$hardware = $hardware->toArray(null, false,TableMap::TYPE_FIELDNAME)[0];

echo json_encode($hardware);

?>
            