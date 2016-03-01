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
						<!--O diaxeirhsths mporei n kanei edit na diagrafei xrhstes kai comments pou exoun kanei -->
						<li><a href="show_users.php"><span class="glyphicon glyphicon-star-empty"> Χρήστες</span></a></li>
						<li class="active"><a href="reports_list.php"><span class="glyphicon glyphicon-th-large"> Λίστα Αναφορών</span></a></li>
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
 		$user = 'root';
 		$pass = 'root';
 		$db = new PDO( 'mysql:host=localhost;dbname=karolos;charset=utf8', $user, $pass );
 		

	
 		
		if(isset($_GET['page'])){
		$page = ($_GET['page']-1)*10;
		}else{
		$page = 0;
		}
		
		$user = 'root';
		$pass = 'root';
		$db = new PDO( 'mysql:host=localhost;dbname=karolos;charset=utf8', $user, $pass );

		if(isset($_GET['sort']) && $_GET['sort']=='solved'){
			$sql1 = "SELECT * FROM spots  WHERE solved='1'ORDER BY created_at DESC LIMIT :page, 10;";
			$query1 = $db->prepare( $sql1 );
			$query1->bindParam(':page', $page, PDO::PARAM_INT);
			$query1->execute();
			$results1 = $query1->fetchAll( PDO::FETCH_ASSOC );
		}elseif (isset($_GET['sort']) && $_GET['sort']=='unsolved'){
			$sql1 = "SELECT * FROM spots WHERE solved='0'ORDER BY created_at DESC LIMIT :page, 10;";
			$query1 = $db->prepare( $sql1 );
			$query1->bindParam(':page', $page, PDO::PARAM_INT);
			$query1->execute();
			$results1 = $query1->fetchAll( PDO::FETCH_ASSOC );
		}elseif (isset($_GET['sort']) && $_GET['sort']=='category1'){
			$sql1 = "SELECT * FROM spots WHERE category='ΚΑΤΗΓΟΡΙΑ 1'ORDER BY created_at DESC LIMIT :page, 10;";
			$query1 = $db->prepare( $sql1 );
			$query1->bindParam(':page', $page, PDO::PARAM_INT);
			$query1->execute();
			$results1 = $query1->fetchAll( PDO::FETCH_ASSOC );
		}elseif (isset($_GET['sort']) && $_GET['sort']=='category2'){
			$sql1 = "SELECT * FROM spots WHERE category='ΚΑΤΗΓΟΡΙΑ 2'ORDER BY created_at DESC LIMIT :page, 10;";
			$query1 = $db->prepare( $sql1 );
			$query1->bindParam(':page', $page, PDO::PARAM_INT);
			$query1->execute();
			$results1 = $query1->fetchAll( PDO::FETCH_ASSOC );
		}elseif (isset($_GET['sort']) && $_GET['sort']=='category3'){
			$sql1 = "SELECT * FROM spots WHERE category='ΚΑΤΗΓΟΡΙΑ 3'ORDER BY created_at DESC LIMIT :page, 10;";
			$query1 = $db->prepare( $sql1 );
			$query1->bindParam(':page', $page, PDO::PARAM_INT);
			$query1->execute();
			$results1 = $query1->fetchAll( PDO::FETCH_ASSOC );
		}elseif (isset($_GET['sort']) && $_GET['sort']=='category4'){
			$sql1 = "SELECT * FROM spots WHERE category='ΚΑΤΗΓΟΡΙΑ 4'ORDER BY created_at DESC LIMIT :page, 10;";
			$query1 = $db->prepare( $sql1 );
			$query1->bindParam(':page', $page, PDO::PARAM_INT);
			$query1->execute();
			$results1 = $query1->fetchAll( PDO::FETCH_ASSOC );
		}elseif (isset($_GET['sort']) && $_GET['sort']=='category5'){
			$sql1 = "SELECT * FROM spots WHERE category='ΚΑΤΗΓΟΡΙΑ 5'ORDER BY created_at DESC LIMIT :page, 10;";
			$query1 = $db->prepare( $sql1 );
			$query1->bindParam(':page', $page, PDO::PARAM_INT);
			$query1->execute();
			$results1 = $query1->fetchAll( PDO::FETCH_ASSOC );
		}else{	
			$sql1 = "SELECT * FROM `karolos`.`spots`  ORDER BY `created_at` ASC LIMIT :page, 10;";
			$query1 = $db->prepare( $sql1 );
			$query1->bindParam(':page', $page, PDO::PARAM_INT);
			$query1->execute();
			$results1 = $query1->fetchAll( PDO::FETCH_ASSOC );
		}

		

		?>
		
		</div>
		<div class="well container" style="height:800px;">
			<div class="panel panel-default">
  				<!-- Default panel contents -->
  			<div class="panel-heading"><strong><font size="5" color="black" ><span class="glyphicon glyphicon-th-large"> Λίστα Αναφορών </span></font></strong></div>
			<body style="background-color:#500000  ;">
			</body>
			
    		<div class="panel panel-default">
    			<div class="table-responsive">
  			<!--<table class="table"> -->
		<table class="table table-bordered table-responsive">
  		 <tr>
  		 	<th>ID</th>
  		    <th>User ID</th>
     		<th>Address</th>
     		<th>Area</th>
     		<th>Title</th>
     		<th>Category<a href="reports_list.php?sort=category1">[1]</a><a href="reports_list.php?sort=category2">[2]</a><a href="reports_list.php?sort=category3">[3]</a><a href="reports_list.php?sort=category4">[4]</a><a href="reports_list.php?sort=category5">[5]</a></th>
     		<th><a href="reports_list.php?sort=solved">Solved</a><a href="reports_list.php?sort=unsolved">/Unsolved</a></th>
     		<th>Solved By</th>
     		<th>Updated_at</th>
     		<th>Profile</th>

   		</tr>
   		
 		<!--</tr>-->
 		
   		<?php foreach( $results1 as $row )
   			{
   				
				$stmt_user_info = $db->prepare("SELECT email FROM users WHERE id=:id");
				$stmt_user_info->bindParam(':id', $row['user_id']);
				$stmt_user_info->execute();
				$user_info_results = $stmt_user_info->fetchAll( PDO::FETCH_ASSOC );

				foreach ($user_info_results as $user_info) {
						$temp_email = $user_info['email'];
				
						if($row['solved'] == "1"){
						$temp_solved = "Επιλυμένη";
						}	
						else{
						$temp_solved = "Εκκρεμεί";
						$temp_solved_by = "None";
						}	


						if($row['solved'] == "1"){
						$stmt_get_email = $db->prepare("SELECT admin_email FROM comments WHERE comm_spot_id=:comm_spot_id");
						$stmt_get_email->bindParam(':comm_spot_id', $row['id']);
						$stmt_get_email->execute();
						while($row1 = $stmt_get_email->fetch( PDO::FETCH_ASSOC )){
							$admin_email	= $row1['admin_email'];
						}
						$temp_solved_by = $admin_email;
						$temp_solved = "Επιλυμένη";
						}	
						else{
						$temp_solved = "Εκκρεμεί";
						$temp_solved_by = "None";
						}	
				}

				


   					echo "<tr><td>";
   						echo '<a href="report_profile.php?id='.$row['id'].'">'.$row['id'].'</a>';
   							echo "</td><td>";
     					echo $row['user_id'];
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
   						echo $temp_solved_by;
   							echo "</td><td>";
   						echo $row['updated_at'];
   							echo "</td><td>";
   						echo '<a href="userx_profile.php?email='.$temp_email.'">'.$temp_email.'</a>';
   							echo "</td>";
 					echo "</tr>";
   			}
 		?>
 		</table>
 	</div>

 	</div>
 	</div>

 		<?php 
 		$sql2 = "SELECT * FROM spots;";
	$query2 = $db->prepare( $sql2 );
	$query2->execute();
	
	$active_page = (isset($_GET['page'])) ? $_GET['page'] : 1;

	$num_of_pages = (int) $query2->rowCount()/10;
	$num_of_pages = floor($num_of_pages);
	$extra_page = (($num_of_pages*10<$query2->rowCount()) ? 1 : 0);
	echo "<div class=\"btn-group\">";
	for ($i=1; $i <= $num_of_pages; $i++) { 
		if($active_page == $i){
			echo "<a class=\"active btn btn-default\">".$i."</a>";		
		}else{
			echo "<a href=\"reports_list.php?page=".$i."\" class=\"btn btn-default\">".$i."</a>";
		}
		
		
	}

	if($extra_page == 1){
		$extra_page_number = $num_of_pages + 1;
		if($active_page == $extra_page_number){
			echo "<a class=\"active btn btn-default\">".$extra_page_number."</a>";		
		}else{
			echo "<a href=\"reports_list.php?page=".$extra_page_number."\" class=\"btn btn-default\">".$extra_page_number."</button>";
		}
		
	}


 		 ?>


		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxF6gjpA60q5YG7n-Dj9rIfDTDEpP0rlc"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
		<script src="js/bootstrap.min.js"></script>
