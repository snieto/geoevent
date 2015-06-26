<?php
include __DIR__.DIRECTORY_SEPARATOR.'includes/connectDB.php';
try{
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	$text = $_POST['text'];

	$stmt = $db->prepare("INSERT INTO geospots(lat, lng, text) VALUES(:lat,:lng,:text)");
	$stmt->bindValue(':lat', $lat);
	$stmt->bindValue(':lng', $lng);
	$stmt->bindValue(':text', $text, PDO::PARAM_STR);
	$stmt->execute();

	$affected_rows = $stmt->rowCount();
	echo json_encode(['saved' => $affected_rows==1? true: false]);
}catch(Exception $e){
	echo $e->getMessage();
	error_log($ex->getMessage());
}
/*
try {
	$spots = getSpots($db);
} catch(PDOException $ex) {
	echo "An Error occured!"; //user friendly message
	error_log($ex->getMessage());
}
*/