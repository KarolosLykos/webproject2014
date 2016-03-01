<?php
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=karolos;charset=utf8', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	$stmt = $pdo->prepare("SELECT * FROM `karolos`.`spots` ORDER BY created_at DESC LIMIT 0,20");
	$stmt->execute();

	$results = array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		
		$temp_array = array(
			"lat"	=> $row['latitude'],
			"lon"	=> $row['longitude'],
			"title"	=> $row['title'],
			"body"	=> $row['description']
		);

		array_push($results, $temp_array);
	}

	echo json_encode($results);
?>