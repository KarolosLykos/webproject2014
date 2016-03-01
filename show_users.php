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
						<li><a href="user_profile.php"><span class="glyphicon glyphicon-user"> Προφίλ</span></a></li>
						<li class="active"><a href="show_users.php"><span class="glyphicon glyphicon-star-empty"> Χρήστες</span></a></li>
						<!--O diaxeirhsths mporei n kanei edit na diagrafei xrhstes kai comments pou exoun kanei -->
						
						<li><a href="reports_list.php"><span class="glyphicon glyphicon-th-list"> Λίστα Αναφορών</span></a></li>
					<!--Ta comments pou exei kanei Ta spots pou exei valei ktlp -->
						<li><a href="add_spot.php"><span class="glyphicon glyphicon-plus"> Προσθήκη Αναφοράς</span></a></li>
						<?php } ?>


					</ul>

					<ul class="nav navbar-nav navbar-right">
						<?php if(!isset($_SESSION['id'])){ ?>
						<li><a href="register.php"><span class="glyphicon glyphicon-pencil"> Εγγραφή </span></a></li>
						<li><a href="login.php"><span class="glyphicon glyphicon-log-in"> Είσοδος </span></a></li>
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

		<?php if(!isset($_SESSION['id'])){ ?>

		<?php }else{ ?>

		<!-- Xaxa -->

		<?php } ?>


		
		<?php
		if(isset($_GET['page'])){
			$page = ($_GET['page']-1)*10;
		}else{
			$page = 0;
		}


 		$user = 'root';
 		$pass = 'root';
 		$db = new PDO( 'mysql:host=localhost;dbname=karolos;charset=utf8', $user, $pass );
 		$sql = "SELECT * FROM users LIMIT :page, 10;";
 		$query = $db->prepare( $sql );
 		$query->bindParam(':page', $page, PDO::PARAM_INT);
 		$query->execute();
 		$results = $query->fetchAll( PDO::FETCH_ASSOC );
 	
 	


		?>
		<div class="container container-fluid">
		
		</div>
		
		<div class="well container" style="height:600px;">
			<div class="panel panel-default">
  				<!-- Default panel contents -->
  			<div class="panel-heading"><strong><font size="5" color="black" ><span class="glyphicon glyphicon-star-empty"> Χρήστες </span></font></strong></div>
			<body style="background-color:#500000  ;">
			</body>
			<div class="bs-example">
    		<div class="panel panel-default">
    			<div class="table-responsive">
  			<table class="table">
		 <table class="table table-bordered table-responsive">
  		 <tr>
  		   <th>ID</th>
     		<th>Email</th>
     		<th>Name</th>
     		<th>Surname</th>
     		<th>Phone</th>
     		<th>Admin</th>
     		<th>created_at</th>
     		<th>Profile</th>
   		</tr>
   		
   		<?php foreach( $results as $row )
   			{
			if($row['admin'] == "0"){
			$temp_admin = "User";
			}	
			else{
			$temp_admin = "Admin";
			}
   				$email = $row['email'];
   				echo "<tr><td>";
     				echo $row['id'];
     					echo "</td><td>";
    				echo $email;
    					echo "</td><td>";
    				echo  $row['name'];
    					echo "</td><td>";
    				echo $row['surname'];
    					echo "</td><td>";
    				echo $row['phone'];
   						echo "</td><td>";
   					echo $temp_admin;
   						echo "</td><td>";
    				echo $row['created_at'];
   						echo "</td><td>";
   					if ($_SESSION['admin'] == '1'){
   						echo '<a href="userx_profile.php?email='.$email.'">'.$email.'</a>';
   					}else{
   						echo '<a href="user_profile.php?email='.$email.'">'.$email.'</a>';
   					}
   					
   						echo "</td>";
 				echo "</tr>";
   			}
 		?>
 		</table>
 			</div>
 		 </div>

 		 </div>

		</div>

		<?php
		if(isset($_GET['page'])){
			$page = ($_GET['page']-1)*10;
		}else{
			$page = 0;
		}


 		$user = 'root';
 		$pass = 'root';
 		$db = new PDO( 'mysql:host=localhost;dbname=karolos;charset=utf8', $user, $pass );
 		$sql1 = "SELECT * FROM users LIMIT :page, 10;";
 		$query1 = $db->prepare( $sql1 );
 		$query1->bindParam(':page', $page, PDO::PARAM_INT);
 		$query1->execute();
 		$results = $query->fetchAll( PDO::FETCH_ASSOC );
 	




 		$sql2 = "SELECT * FROM users";
 		$query2 = $db->prepare( $sql2 );
 		$query2->execute();

 		$num_of_pages = (int) $query2->rowCount()/10;
		$num_of_pages = floor($num_of_pages);
		$extra_page = (($num_of_pages*10<$query2->rowCount()) ? 1 : 0);
		echo "<div class=\"btn-group\">";
		for ($i=1; $i <= $num_of_pages; $i++) { 
		if($active_page == $i){
		echo "<a class=\"active btn btn-default\">".$i."</a>";		
		}else{
		echo "<a href=\"show_users.php?page=".$i."\" class=\"btn btn-default\">".$i."</a>";
		}

		//echo "<a class=\"bnt bnt-default\" href=\"test.php?page=".$i."\">".$i."</a>";
		}

 		// 	echo "<pre>";
			// var_dump($num_of_pages);
			// echo "</pre>";





		if($extra_page == 1){
		$extra_page_number = $num_of_pages + 1;
		//echo "<a class=\"bnt bnt-default\" href=\"test.php?page=".$extra_page_number."\">".$extra_page_number."</a>";
		if($active_page == $extra_page_number){
		echo "<a class=\"active btn btn-default\">".$extra_page_number."</a>";		
		}else{
		echo "<a href=\"show_users.php?page=".$extra_page_number."\" class=\"btn btn-default\">".$extra_page_number."</button>";
		}

		}


		?>

		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxF6gjpA60q5YG7n-Dj9rIfDTDEpP0rlc"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
		<script src="js/bootstrap.min.js"></script>
