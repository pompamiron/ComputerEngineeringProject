<?php

require_once "../vendor/autoload.php";
require_once "../config/config.php";

use Propel\Runtime\Map\TableMap;
use model\model\CowQuery;


$cowID = $_GET['cowID'];

$cow = CowQuery::create()
			->joinWithHardwareRelatedByHwid1()	
			->joinWithGeneral_data()
			->joinWithBehavior_data()
            ->findByCowid($cowID);

$cow = $cow->toArray(null, false,TableMap::TYPE_FIELDNAME)[0];

echo json_encode($cow);

?>
            
            
