<?php
require_once('connectDatabase.php');
define('LINE_API',"https://notify-api.line.me/api/notify");

$cowID = mysqli_real_escape_string($conn,$_POST['cowID']);
$behavior = mysqli_real_escape_string($conn,$_POST['behavior']);
?>


<div class="wrapper">
	<button class="btn btn-primary" onclick="parent.location='index.php'">Back</button>
</div>
<br>

<?php
$insertBehavior = 	"INSERT INTO `behavior_data` (`cowID`, `behavior`, `time`) 
					VALUES ($cowID,'$behavior',CURRENT_TIMESTAMP);";

if(mysqli_query($conn,$insertBehavior)) // INSERT BOOKING NAME
	{
		echo "Insert Behavior COMPLETE!! \n";
	}
else{
		echo "Insert Error!!";
	}

$selectName = 	"SELECT c.name as `name`
				FROM `behavior_data` b 
				JOIN `cow` c on b.cowID = c.cowID
				ORDER BY ID DESC 
				LIMIT 1;";

$result = $conn->query($selectName);
$row = $result->fetch_assoc();

/* Line Notify */
$token = "d1SzoGoH6Fnsoo3qkKKKQt1dTMcaOMWdVDO87NNWCgl"; // Token
$str = 'Cow behavior is updated! '. 'Cow name: '. $row['name']. ', Behavior: '. $behavior; // Message
 
$res = notify_message($str,$token);
/*print_r($res);*/
function notify_message($message,$token){
 $queryData = array('message' => $message);
 $queryData = http_build_query($queryData,'','&');
 $headerOptions = array( 
         'http'=>array(
            'method'=>'POST',
            'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                      ."Authorization: Bearer ".$token."\r\n"
                      ."Content-Length: ".strlen($queryData)."\r\n",
            'content' => $queryData
         ),
 );
 $context = stream_context_create($headerOptions);
 $result = file_get_contents(LINE_API,FALSE,$context);
 $res = json_decode($result);
 return $res;
}	

$conn->close()

/* รูปในเฟส */
/*if($result){
	echo "";
	echo "";
	echo "";
	echo "";
}
else{
	echo "";
	echo "";
	echo "";
}*/
?>