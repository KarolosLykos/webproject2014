<?php
	date_default_timezone_set("Europe/Athens"); 
	session_name("karolos_session");
	session_start();

	if($_POST['email']!=='' && $_POST['password']!=='' && $_POST['password_']!==''){

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

			if($stmt_check_email->rowCount() == 0){

				$blowfish_salt = bin2hex(openssl_random_pseudo_bytes(22));

				$email 			= $_POST['email'];
				$hash 			= crypt($_POST['password'], "$2a$12$".$blowfish_salt);
				$name 			= $_POST['name'];
				$surname 		= $_POST['surname'];
				$phone 			= $_POST['phone'];
				$date 			= date('Y-m-d H:i:s');

			
				$stmt = $pdo->prepare("INSERT INTO `karolos`.`users` (`email`, `hash`, `name`, `surname`, `phone`, `created_at`, `updated_at`) VALUES (:email, :hash, :name, :surname, :phone, :created_at, :updated_at);");
				$stmt->bindParam(':email', $email);
				$stmt->bindParam(':hash', $hash);
				$stmt->bindParam(':name', $name);
				$stmt->bindParam(':surname', $surname);
				$stmt->bindParam(':phone', $phone);
				$stmt->bindParam(':created_at', $date);
				$stmt->bindParam(':updated_at', $date);

				$stmt->execute();

				$_SESSION['msg'] 		= "Ο λογαριασμός σας δημιουργήθηκε με επιτυχία!! Μπορείετε να κάνετε <a href=\"login.php\" class=\"alert-link\">login</a>";
				$_SESSION['msg_type'] 	= "success";

				header("Location: index.php");

			}else{
				// Error 5 = Email exists
				$_SESSION['error_5'] = true;

				$_SESSION['old_name'] = $_POST['name'];
				$_SESSION['old_surname'] = $_POST['surname'];
				$_SESSION['old_phone'] = $_POST['phone'];

				header("Location: register.php");
			}

		}else{
			// Error 4 = Τα passwords δεν είναι ίδια
			$_SESSION['error_4'] = true;

			$_SESSION['old_email'] = $_POST['email'];
			$_SESSION['old_name'] = $_POST['name'];
			$_SESSION['old_surname'] = $_POST['surname'];
			$_SESSION['old_phone'] = $_POST['phone'];

			header("Location: register.php");
		}
	}else{
		// Error 1 = δεν έχει email
		if($_POST['email']==''){
			$_SESSION['error_1'] = true;
		}else{
			$_SESSION['error_1'] = false;
			$_SESSION['old_email'] = $_POST['email'];
		}

		// Error 2 = δεν έχει password
		if($_POST['password']==''){
			$_SESSION['error_2'] = true;
		}else{
			$_SESSION['error_2'] = false;
		}

		// Error 3 = δεν έχει password_
		if($_POST['password_']==''){
			$_SESSION['error_3'] = true;
		}else{
			$_SESSION['error_3'] = false;
		}

		$_SESSION['old_name'] = $_POST['name'];
		$_SESSION['old_surname'] = $_POST['surname'];
		$_SESSION['old_phone'] = $_POST['phone'];

		header("Location: register.php");
	}
?>