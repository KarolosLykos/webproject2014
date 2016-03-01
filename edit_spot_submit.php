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

		$stmt2 = $pdo->prepare("SELECT * FROM `karolos`.`spots` WHERE id=:id");
		$stmt2->bindParam(':id', $_POST['id']);
		$stmt2->execute();

		while($row = $stmt2->fetch( PDO::FETCH_ASSOC )){

		$id	= $row['id'];
		}

		$solved			=$_POST['solved'];
		$updated_at		= date('Y-m-d H:i:s');


		$stmt = $pdo->prepare("UPDATE spots SET solved=:solved, updated_at=:updated_at WHERE id=:id;");
		$stmt->bindParam(":solved", $solved);
		$stmt->bindParam(":updated_at", $updated_at);
		$stmt->bindParam(":id", $id);
		$stmt->execute();


		$comm_user_id			= $_POST['user_id'];
		$comm_spot_id 			= $_POST['id'];
		$comment_text 			= $_POST['comment_text'];
		$admin_email			= $_POST['admin_email'];
		$comm_created_at 		= date('Y-m-d H:i:s');
		try {
			$com = new PDO('mysql:host=localhost;dbname=karolos;charset=utf8', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$com->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}



		$statement_add_comment = $com->prepare("INSERT INTO `karolos`.`comments` (`comm_user_id`, `comm_spot_id`, `comment_text`, `admin_email`, `comm_created_at`) VALUES (:comm_user_id, :comm_spot_id, :comment_text, :admin_email, :comm_created_at);");
		$statement_add_comment->bindParam(':comm_user_id', $comm_user_id);
		$statement_add_comment->bindParam(':comm_spot_id', $comm_spot_id);
		$statement_add_comment->bindParam(':comment_text', $comment_text);
		$statement_add_comment->bindParam(':admin_email', $admin_email);  
		$statement_add_comment->bindParam(':comm_created_at', $comm_created_at); 

		$statement_add_comment->execute();

		
		$_SESSION['msg'] 		= "Η κατάσταση της αναφοράς άλλαξε με επιτυχία!!!";
		$_SESSION['msg_type'] 	= "success";


		header("Location: index.php");


	 
?>

