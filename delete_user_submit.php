<?php
	date_default_timezone_set("Europe/Athens"); 
	session_name("karolos_session");
	session_start();


	if(!isset($_SESSION['id'])){
		header("Location: index.php");
	}
	echo "string";
	echo "<pre>";
				var_dump($_POST['email']);
				echo "</pre>";

	
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

			echo "<pre>";
				var_dump($email);
				echo "</pre>";
			

			if($stmt_check_email->rowCount() == 1){
				
				

				$stmt = "DELETE FROM `karolos`.`users` WHERE id=:id";
				$stmt = $pdo->prepare($stmt);
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);   
				$stmt->execute();


				$_SESSION['msg'] 		= "Το προφιλ του χρήστη διαγράφηκε με επιτυχία!!!";
				$_SESSION['msg_type'] 	= "success";


				header("Location: index.php");

	 }
?>

