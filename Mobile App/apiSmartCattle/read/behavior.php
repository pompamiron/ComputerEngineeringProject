<?php

require_once "../vendor/autoload.php";
require_once "../config/config.php";

use Propel\Runtime\Map\TableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use model\model\Behavior_dataQuery;


$cowID = $_GET['cowID'];

$cowBehaviors = Behavior_dataQuery::create()
            	->findByCowid($cowID)
            	->toArray(null, false,TableMap::TYPE_FIELDNAME);

echo json_encode(['cowBehaviors' => $cowBehaviors], JSON_PRETTY_PRINT);

?>
            
            
