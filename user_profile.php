<?php
	date_default_timezone_set("Europe/Athens");
	session_name("karolos_session");
	session_start();
	
	if(!isset($_SESSION['id'])){
		header("Location: index.php");
	}
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Karolos</title>

		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
		<link type="text/css" rel="stylesheet" href="css/style.css">


		<LINK REL="SHORTCUT ICON"
      	href = "img\asteri.jpg">
	</head>

	<body>
		<!-- Nav Bar -->
		<nav class="navbar navbar-inverse navbar-inverse" role="navigation">
			<div class="container container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">Karolos</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="index.php"><span class="glyphicon glyphicon-home"> Αρχική</span></a></li>
						<?php if(isset($_SESSION['id'])){ ?>
						<li class="active"><a href="user_profile.php"><span class="glyphicon glyphicon-user"> Προφίλ</span></a></li>
						<li><a href="show_users.php"><span class="glyphicon glyphicon-star-empty"> Χρήστες</span></a></li>
						<li><a href="reports_list.php"><span class="glyphicon glyphicon-th-list"> Λίστα Αναφορών</span></a></li>
						<li><a href="add_spot.php"><span class="glyphicon glyphicon-plus"> Προσθήκη Αναφοράς</span></a></li>
						<?php } ?>
					</ul>


					<ul class="nav navbar-nav navbar-right">
						<?php if(!isset($_SESSION['id'])){ ?>
						<li><a href="register.php">Εγγραφή </a></li>
						<li><a href="login.php">Είσοδος </a></li>
						<?php }else{ ?>
						<?php $email = $_SESSION['email']; ?>
						<li><a href="user_profile.php"><span class="glyphicon glyphicon-user"> <?php echo "$email" ?> </span></a></li>
						<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> (Έξοδος) </span></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</nav>


		<?php if(isset($_SESSION['msg'])){ ?>
		<div class="container">
			<div class="alert alert-<?php echo $_SESSION['msg_type']; ?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<?php echo $_SESSION['msg']; ?>
			</div>
		</div>
		<?php 
		unset($_SESSION['msg']);
		unset($_SESSION['msg_type']);
		} ?>

		

		<?php
		try {
			$pdo = new PDO('mysql:host=localhost;dbname=karolos;charset=utf8', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
		$stmt = $pdo->prepare("SELECT * FROM `karolos`.`users` WHERE email=:email;");
		$stmt->bindParam(':email', $_GET['email']);
		
					if ($_GET['email']=='') 
					{
						$stmt->bindParam(':email', $_SESSION['email']);
					}	
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
			
			$_SESSION['id']				= $row['id'];
			$_SESSION['email1']			= $row['email'];
			$_SESSION['name']			= $row['name'];
			$_SESSION['surname']		= $row['surname'];
			$_SESSION['phone']			= $row['phone'];
			$_SESSION['admin']			= $row['admin'];
			$_SESSION['created_at']		= $row['created_at'];
		?>

		<?php $id 			= $_SESSION['id']; ?>,
		<?php $email 		= $_SESSION['email1']; ?>,
		<?php $name 		= $_SESSION['name']; ?>
		<?php $surname      = $_SESSION['surname']; ?>
		<?php $phone 		= $_SESSION['phone']; ?>
		<?php $admin 		= $_SESSION['admin']; ?>
		<?php $created_at 	= $_SESSION['created_at']; ?>
		<?php 
		if($admin == "0"){
			$temp_admin = "User";
		}	
		else{
			$temp_admin = "Admin";
		}	
		
		?>
		
		
		<div class="container container-fluid">
		
		</div>
		<div class="well container" style="height:200px;">
			<div class="panel panel-default">

  				<!-- Default panel contents -->
  				<div class="panel-heading"><strong><font size="5" color="black" ><span class="glyphicon glyphicon-user"> Προφίλ Χρήστη (<?php echo $email ?>)</span></font></strong>
				<a href="edit_profile.php">(Edit)</a>
				</div>
  				<body style="background-color:#500000  ;">
				</body>
					<div class="bs-example">

			    		<div class="panel panel-default">
			      		
				      		<div class="table-responsive">

					      		<!-- Table -->
					      		<table class="table table-bordered table-responsive">
					       			<thead>
										<tr>
										<th>ID Χρήστη</th>
										<th>Email Χρήστη</th>
										<th>Όνομα</th>
										<th>Επώνυμο</th>
										<th>Τηλέφωνο</th>
										<th>Εγγεγραμμένος/Διαχειριστής</th>
										<th>Ημερομηνια Εγγραφής</th>
										</tr>
					       			</thead>
					      		  	<tbody>
					      		    	<tr>
						        		    <td><?php echo $id ?></td>
						       	   			<td><?php echo $email ?></td>
						        		    <td><?php echo $name ?></td>
						        		    <td><?php echo $surname ?></td>
						        		    <td><?php echo $phone ?></td>
						        		    <td><?php echo $temp_admin ?></td>
						        		    <th><?php echo $created_at ?></th>
						         		</tr>
					       			</tbody>
					     		</table>
					     	</div>
			 			</div>
			 		</div>	
	 			</body>
			</div>

		</div>

		<div class="well container" style="height:300px;">

		<?php
	
 		
		if(isset($_GET['page'])){
		$page = ($_GET['page']-1)*3;
		}else{
		$page = 0;
		}
		
		$user = 'root';
		$pass = 'root';
		$db = new PDO( 'mysql:host=localhost;dbname=karolos;charset=utf8', $user, $pass );
		$sql1 = "SELECT * FROM spots WHERE user_id=:user_id ORDER BY created_at DESC LIMIT :page, 3;";
		$query1 = $db->prepare( $sql1 );
		$query1->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_INT);
		$query1->bindParam(':page', $page, PDO::PARAM_INT);
		$query1->execute();
		$results1 = $query1->fetchAll( PDO::FETCH_ASSOC );
		

		$temp_email1 			= $_SESSION['email'];
		// echo "<pre>";
		// var_dump($temp_email1 );
		// echo "</pre>";
		
		?>

		<div class="panel-heading"><strong><font size="5" color="black" ><span class="glyphicon glyphicon-th-list"> Αναφορές Χρήστη (<?php echo $email ?>)</span></font></strong></div>
		 <div class="bs-example">

			    		<div class="panel panel-default">
			      		
				      		<div class="table-responsive">
		 <table <table class="table table-bordered table-responsive">
  		 <tr>
  		 	<th>ID</th>
     		<th>Latitude</th>	
     		<th>longitude</th>
     		<th>Address</th>
     		<th>Area</th>
     		<th>Title</th>
     		<th>Category</th>
     		<th>Solved</th>
     		<th>Created_at</th>
     		<th>Updated_at</th>
     		<th>Profile</th>
   		</tr>
   	</div>
   	</div>
   </div>

   		<?php foreach( $results1 as $row )
   			{
   				
				$stmt_user_info = $db->prepare("SELECT email FROM users WHERE id=:id");
				$stmt_user_info->bindParam(':id', $row['user_id']);
				$stmt_user_info->execute();
				$user_info_results = $stmt_user_info->fetchAll( PDO::FETCH_ASSOC );

				foreach ($user_info_results as $user_info) {
					$temp_email = $user_info['email'];
				}	
					if($row['solved'] == "0"){
					$temp_solved = "Εκκρεμεί";
					}	
					else{
					$temp_solved = "Επιλυμένη";
					}

   					echo "<tr><td>";
   						echo '<a href="report_profile.php?id='.$row['id'].'">'.$row['id'].'</a>';
   							echo "</td><td>";
    					echo $row['latitude'];
    						echo "</td><td>";
    					echo $row['longitude'];
    						echo "</td><td>";
    					echo $row['address'];
   							echo "</td><td>";
   						echo $row['area'];
   							echo "</td><td>";
    					echo $row['title'];
   							echo "</td><td>";
   						echo $row['category'];
   							echo "</td><td>";
   						echo $temp_solved;
   							echo "</td><td>";	
    					echo $row['created_at'];
   							echo "</td><td>";
   						echo $row['updated_at'];
   							echo "</td><td>";
   						echo '<a href="user_profile.php?email='.$temp_email.'">'.$temp_email.'</a>';

   							echo "</td>";
 					echo "</tr>";
   			}
 		?>
 		</table>
 


 		<?php 
 	$sql2 = "SELECT * FROM spots WHERE user_id=:user_id ;";

	$query2 = $db->prepare( $sql2 );
	$query2->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_INT);
	$query2->execute();
	
	$active_page = (isset($_GET['page'])) ? $_GET['page'] : 1;

	$num_of_pages = (int) $query2->rowCount()/3;
	$num_of_pages = floor($num_of_pages);
	$extra_page = (($num_of_pages*3<$query2->rowCount()) ? 1 : 0);
	echo "<div class=\"btn-group\">";
	for ($i=1; $i <= $num_of_pages; $i++) { 
		if($active_page == $i){
			echo "<a class=\"active btn btn-default\">".$i."</a>";		
		}else{
			echo "<a href=\"user_profile.php?page=".$i."&email=".$temp_email."\" class=\"btn btn-default\">".$i."</a>";
		}
	}

	if($extra_page == 1){
		$extra_page_number = $num_of_pages + 1;
		//echo "<a class=\"bnt bnt-default\" href=\"test.php?page=".$extra_page_number."\">".$extra_page_number."</a>";
		if($active_page == $extra_page_number){
			echo "<a class=\"active btn btn-default\">".$extra_page_number."</a>";		
		}else{
			echo "<a href=\"user_profile.php?page=".$extra_page_number."&email=".$temp_email."\" class=\"btn btn-default\">".$extra_page_number."</button>";
		}
	}
?>


	</body>
</html>
 	

		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxF6gjpA60q5YG7n-Dj9rIfDTDEpP0rlc"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
		<script src="js/bootstrap.min.js"></script>
