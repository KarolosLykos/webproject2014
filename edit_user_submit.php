<?php
	date_default_timezone_set("Europe/Athens"); 
	session_name("karolos_session");
	session_start();

	if(!isset($_SESSION['id'])){
		header("Location: index.php");
	}



	
			try {
				$pdo = new PDO('mysql:host=localhost;dbname=karolos;charset=utf8', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			$stmt_check_email = $pdo->prepare("SELECT * FROM `karolos`.`users` WHERE email=:email");
			$stmt_check_email->bindParam(':email', $_POST['email']);
			$stmt_check_email->execute();
			
			while($row = $stmt_check_email->fetch( PDO::FETCH_ASSOC )){

				$id	= $row['id'];
			}
			
			$email		= $_POST['email'];

			

			if($stmt_check_email->rowCount() == 1){

				

				
				
				$name 			= $_POST['name'];
				$surname 		= $_POST['surname'];
				$phone 			= $_POST['phone'];
				$date 			= date('Y-m-d H:i:s');
	
				
			




				$stmt = $pdo->prepare("UPDATE users SET name=:name, surname=:surname ,phone=:phone ,updated_at=:updated_at WHERE id=:id");
				$stmt->bindParam(":name", $name);
				$stmt->bindParam(":surname", $surname);
				$stmt->bindParam(":phone", $phone);
				$stmt->bindParam(":updated_at", $date);
				$stmt->bindParam(":id", $id);
				$stmt->execute();
				


				$_SESSION['msg'] 		= "Το προφιλ του χρήστη ανανεώθηκε με επιτυχία!!!";
				$_SESSION['msg_type'] 	= "success";


				header("Location: index.php");

	}
?>

