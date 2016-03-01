<?php
	date_default_timezone_set("Europe/Athens"); 
	session_name("karolos_session");
	session_start();

	if(!isset($_SESSION['id'])){
		header("Location: index.php");
	}



	if($_POST['email']!=='' && $_POST['password']!=='' && $_POST['password_']!=='' ){

		if($_POST['password'] == $_POST['password_']){
			try {
				$pdo = new PDO('mysql:host=localhost;dbname=karolos;charset=utf8', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			$stmt_check_email = $pdo->prepare("SELECT * FROM `karolos`.`users` WHERE email=:email");
			$stmt_check_email->bindParam(':email', $_POST['email']);
			$stmt_check_email->execute();
			$_SESSION['email']		= $_POST['email'];



			if($stmt_check_email->rowCount() == 1){

				$blowfish_salt = bin2hex(openssl_random_pseudo_bytes(22));

				
				$email 			= $_POST['email'];
				$hash 			= crypt($_POST['password'], "$2a$12$".$blowfish_salt);
				$name 			= $_POST['name'];
				$surname 		= $_POST['surname'];
				$phone 			= $_POST['phone'];
				$date 			= date('Y-m-d H:i:s');
				$old_email		= $_SESSION['email'];
				
			




				$stmt = $pdo->prepare("UPDATE users SET email=:email, hash=:hash, name=:name, surname=:surname ,phone=:phone ,updated_at=:updated_at WHERE id=:id");
				$stmt->bindParam(":email", $email);
				$stmt->bindParam(":hash", $hash);
				$stmt->bindParam(":name", $name);
				$stmt->bindParam(":surname", $surname);
				$stmt->bindParam(":phone", $phone);
				$stmt->bindParam(":updated_at", $date);
				$stmt->bindParam(":id", $_SESSION['id']);
				$stmt->execute();
				


				$_SESSION['msg'] 		= "Το προφιλ σας ανανεώθηκε με επιτυχία!!!";
				$_SESSION['msg_type'] 	= "success";


				header("Location: index.php");

	}
?>

