<?php
	date_default_timezone_set("Europe/Athens"); 
	session_name("karolos_session");
	session_start();

	if(!isset($_SESSION['id'])){
		header("Location: index.php");
	}
?>


<?php 
try {
$pdo = new PDO('mysql:host=localhost;dbname=karolos;charset=utf8', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
echo 'ERROR: ' . $e->getMessage();
}


$stmt1 = $pdo->prepare("SELECT * FROM spots WHERE id=:id");
$stmt1->bindParam(':id', $_POST['spotid']);

$stmt1->execute();

while($row = $stmt1->fetch( PDO::FETCH_ASSOC )){

				$id	= $row['id'];
			}




$spot_id		=$id;
$stmt_check_photos = $pdo->prepare("SELECT * FROM photos WHERE spot_id=:spot_id");
$stmt_check_photos->bindParam(':spot_id', $spot_id);

$stmt_check_photos->execute();





if($stmt_check_photos->rowCount() <> 4)
{
	
	function GetImageExtension($imagetype)
	   	 {
	       if(empty($imagetype)) return false;
	       switch($imagetype)
	       {
	           case 'image/bmp': return '.bmp';
	           case 'image/gif': return '.gif';
	           case 'image/jpeg': return '.jpg';
	           case 'image/png': return '.png';
	           case 'image/jpeg': return '.jpeg';
	           default: return false;
	       }
	     }

		 
	if (!empty($_FILES["uploadedimage"]["name"])) 

		{

					$file_name=$_FILES["uploadedimage"]["name"];
					$temp_name=$_FILES["uploadedimage"]["tmp_name"];
					$imgtype=$_FILES["uploadedimage"]["type"];
					$ext= GetImageExtension($imgtype);
					$imagename=date("d-m-Y")."-".time().$ext;
					$target_path = "images/".$imagename;
					
					$image_type 			= $imgtype;
					$image_path 			= $target_path;
					$image_created_at 		= date('Y-m-d H:i:s');

				if(move_uploaded_file($temp_name, $target_path)) 

				{

				 	$stmt = $pdo->prepare("INSERT INTO `photos` (`spot_id`,`image_path`,`image_type`,`image_created_at`) VALUES (:spot_id,:image_path,:image_type,:image_created_at);");
					$stmt->bindParam(':spot_id', $spot_id);
					$stmt->bindParam(':image_path', $image_path);
					$stmt->bindParam(':image_type', $image_type);
					$stmt->bindParam(':image_created_at', $image_created_at);
					
					$stmt->execute();

					$_SESSION['msg'] 		= "Η φωτογραφία προστέθηκε με επιτυχία!!!";
					$_SESSION['msg_type'] 	= "success";

					header("Location: index.php");

				}

					else
					{

						
				  		$_SESSION['msg'] 		= "Σφάλμα στην προσθήκη της φωτογραφίας!!!";
						$_SESSION['msg_type'] 	= "warning";
						

						header("Location: reports_list.php");

					} 

		}
}else{

	$_SESSION['msg'] 		= "Προσπαθείτε να ανεβάσετε περισσότερες φωτογραφίες από το επιτρεπτό όριο!!!";
	$_SESSION['msg_type'] 	= "danger";
	

	header("Location: reports_list.php");

}
?>