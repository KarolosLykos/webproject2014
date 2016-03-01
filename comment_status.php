<?php
try {
		$pdo = new PDO('mysql:host=localhost;dbname=karolos;charset=utf8', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}



$solved = "1";

$query =$pdo->prepare("SELECT * FROM `karolos`.`spots` WHERE solved=:solved ORDER BY updated_at ASC;");
$query->bindParam(':solved', $solved, PDO::PARAM_INT);
$query->execute();
$results = $query->fetchAll( PDO::FETCH_ASSOC );

foreach( $results as $row ) {

	$id = $row['id'];
}


$query3 =$pdo->prepare("SELECT * FROM `karolos`.`comments`  WHERE comm_spot_id=:comm_spot_id;");
$query3->bindParam(':comm_spot_id', $id, PDO::PARAM_INT);
$query3->execute();
$results1 = $query3->fetchAll( PDO::FETCH_ASSOC );

foreach( $results1 as $row ) {

	$comm = $row['comment_text'];
	$ad_email = $row['admin_email'];
	$when		=$row['comm_created_at'];
}


$results2 = array(
	'spot_comments'		=> $comm,
	'spot_id'			=> $id,
	'Admin_email'		=> $ad_email,
	'comm_time'			=> $when
);

echo json_encode($results2);
		

?>