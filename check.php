<?php
	date_default_timezone_set("Europe/Athens"); 
	session_name("karolos_session");
	session_start();

	if(isset($_POST['submit'])){
		$email = $_POST['username_input'];
		$pass = $_POST['password_input'];

		try {
			$pdo = new PDO('mysql:host=localhost;dbname=karolos;charset=utf8', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}

		$stmt = $pdo->prepare("SELECT * FROM `karolos`.`users` WHERE email=:email;");
		$stmt->bindParam(':email', $email);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if (crypt($pass, $row['hash']) == $row['hash']) {
			
			$_SESSION['id']				= $row['id'];
			$_SESSION['email']			= $row['email'];
			$_SESSION['display_name']	= $row['name']." ".$row['surname'];
			
			//Elegxos an einai admin
			if ($row['admin'] == "1") {
				
				$_SESSION['admin']		= "1";

			}else{

				$_SESSION['admin']		= "0";

			}

			header('Location: index.php');
		}else{
			$_SESSION['error'] = 1;
			$_SESSION['old_username'] = $email;
			header('Location: login.php');
		}
	}
?>