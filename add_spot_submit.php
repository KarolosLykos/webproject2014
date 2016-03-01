<?php
	date_default_timezone_set("Europe/Athens"); 
	session_name("karolos_session");
	session_start();

	try {
		$pdo = new PDO('mysql:host=localhost;dbname=karolos;charset=utf8', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}


	$user_id 		= $_SESSION['id'];
	$lat 			= $_POST['latitude'];
	$lon			= $_POST['longitude'];
	$address 		= $_POST['address'];
	$area 			= $_POST['area'];
	$title 			= $_POST['title'];
	$category 		= $_POST['category'];
	$description 	= $_POST['description'];
	$date 			= date('Y-m-d H:i:s');
	if ($category == '') {

		$_SESSION['msg'] 		= "Παρακαλώ επιλέξτε κατηγορία";
		$_SESSION['msg_type'] 	= "danger";


	header("Location: index.php");
	}	
	

	$stmt = $pdo->prepare("INSERT INTO `karolos`.`spots` (`user_id`, `latitude`, `longitude`, `address`, `area`, `title`, `category`, `description`, `created_at`, `updated_at`) VALUES (:user_id, :latitude, :longitude, :address, :area, :title, :category, :description, :created_at, :updated_at);");

	$stmt->bindParam(':user_id', $user_id);
	$stmt->bindParam(':latitude', $lat);
	$stmt->bindParam(':longitude', $lon);
	$stmt->bindParam(':address', $address);
	$stmt->bindParam(':area', $area);
	$stmt->bindParam(':title', $title);
	$stmt->bindParam(':category', $category);
	$stmt->bindParam(':description', $description);
	$stmt->bindParam(':created_at', $date);
	$stmt->bindParam(':updated_at',  $date);

	$stmt->execute();

	$_SESSION['msg'] 		= "Το νέο σημείο προστέθηκε με επιτυχία!!!";
	$_SESSION['msg_type'] 	= "success";

	header("Location: index.php");


	



?>




