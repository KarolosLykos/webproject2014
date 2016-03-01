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

		<?php if(!isset($_SESSION['id'])){ ?>

		<?php }else{ ?>

		<!-- Xaxa -->

		<?php } ?>
		<?php
		try {
			$pdo = new PDO('mysql:host=localhost;dbname=karolos;charset=utf8', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
		$stmt = $pdo->prepare("SELECT * FROM `karolos`.`spots` WHERE id=:id;");
		$stmt->bindParam(':id', $_GET['id']);
		
					if ($_GET['id']=='') 
					{
						//$stmt->bindParam(':id', $_SESSION['id']);
					}	
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$id 						= $row['id']; 
		$user_id 					= $row['user_id']; 
		$latitude 				= $row['latitude']; 
		$longitude      			= $row['longitude']; 
		$address 					= $row['address']; 
		$area 					= $row['area']; 
		$solved 					= $row['solved']; 
		$category 				= $row['category']; 
		$description 				= $row['description']; 
		$created_at 				= $row['created_at']; 
		$updated_at 				= $row['updated_at']; 

		$stmt1 = $pdo->prepare("SELECT email FROM `karolos`.`users` WHERE id=:id;");
		$stmt1->bindParam(':id', $user_id);
		$stmt1->execute();

		$temp_email = $stmt1->fetch(PDO::FETCH_ASSOC);


		
		?>

		
		
			
		<div class="container container-fluid">
		
		</div>
		<div class="well container" style="height:200px;">
			<div class="panel panel-default">
  				<!-- Default panel contents -->
  			<div class="panel-heading"><span class="glyphicon glyphicon-th-list"> Αναφορά </span>(<?php echo $id ?>)
			
			<?php
				if($solved == "1"){
				$temp_solved = "Επιλυμένη";
				}	
				else{
				$temp_solved = "Εκκρεμεί";
				}	



			if($_SESSION['admin'] == "1" && $solved == '0') 
			{


			
			echo '<a href="edit_spot.php?id='.$id.'">(Edit)</a>';
			
			}
			?>




  			</div>

  			<body style="background-color:#500000  ;">
			</body>
			<div class="bs-example">
    		<div class="panel panel-default">
      
      		<!-- Table -->
      		<div class="table-responsive">
  			<table class="table">
      		<table class="table table-bordered table-responsive">
       		 <thead>
        		  <tr>
          		  <th>ID Αναφοράς</th>
           		  <th>Id User</th>
           		  <th>Email User</th>
          		  <th>Latitude</th>
          		  <th>Longitude</th>
          		  <th>Address</th>
          		  <th>Category</th>
          		  <th>Area</th>
          		  <th>Solved</th>
          		  <th>Ημερομηνια Καταχώρησης</th>
          		  <th>Ημερομηνια Ενημέρωσης</th>
         		 </tr>
       		 </thead>
      		  <tbody>
      		    <tr>
        		    <td><?php echo $id ?></td>
       	   			<td><?php echo $user_id ?></td>
       	   			<td><?php echo '<a href="user_profile.php?email='.$temp_email['email'].'">'.$temp_email['email'].'</a>' ?></td>
        		    <td><?php echo $latitude ?></td>
        		    <td><?php echo $longitude ?></td>
        		    <td><?php echo $address ?></td>
        		    <td><?php echo $category ?></td>
        		    <td><?php echo $area ?></td>
        		    <td><?php echo $temp_solved ?></td>
        		    <th><?php echo $created_at ?></th>
        		    <th><?php echo $updated_at ?></th>
         		 </tr>
       		 </tbody>
     		 </table>
     		</div>
		</div>
	</div>
</div>
</div>

<div class="col-md-4 col-md-offset-4">
			<div class="well" >
				<div class="panel-heading"><strong><font size="3" color="black" ><u>Περιγραφή  Αναφοράς</u></font></strong></a>
				</div>
			
			<?php
			echo $description;

			
			?>
			
		
			</div>
			</div>	
<div class="container " style="width:600px;" >
		
		</div>

		
		
		
		<div class="well container" style="width:600px;" >
			
			
				
  				<!-- Default panel contents -->
  					<div class="panel-heading"><strong><font size="3" color="black" > <u>Φωτογραφίες Αναφοράς</u></font></strong></a>
					
					</div>

					
					
					
						
						
							
 						 
								<?php 

								try {
								$pdo = new PDO('mysql:host=localhost;dbname=karolos;charset=utf8', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
								$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								} catch(PDOException $e) {
								echo 'ERROR: ' . $e->getMessage();
								}

								$spot_id = $id;
								$stmt1 = $pdo->prepare("SELECT * FROM photos WHERE spot_id=:spot_id; ");
								$stmt1 ->bindParam(':spot_id', $spot_id);

								$stmt1->execute();
								$results = $stmt1->fetchAll( PDO::FETCH_ASSOC );


								foreach( $results as $row ){

								?>	
								
  								<a href="#" class="thumbnail">	

								<?php 
								
								header("Content-type:'.row['image_type'].'");
								echo '<img src="'.$row['image_path'].'"  class="img-responsive" alt="Responsive image"  style="width:250px; height: 250px" ';?></a>

								   
		
								<?php
								}
								?>
								<?php
								 
								      



								 if($_SESSION['email'] == $temp_email["email"]) 
								{
									

								?>	
								
								
								
								<a href="<?php echo "upload_file.php?id=$id";?>" class="btn btn-primary" role="button">Upload A Photo</a>
								<?php
								}
								?>
								
								</div>
								</div>

			</div>	



		</div>


		<div class="well container" style="width:400px;" >


  		
  			<!-- <a href="<?php echo "comments.php?id=$id";?>" class="btn btn-primary btn-lg active" role="button">Add comment</a> -->
  		<div class="panel-heading"><strong><font size="3" color="black" ><u>Σχόλια  Αναφοράς</u></font></strong></a>
  		</div>
  		<?php
			$comm_spot_id = $id;
			$stmt4 = $pdo->prepare("SELECT * FROM comments WHERE comm_spot_id=:comm_spot_id; ");
			$stmt4 ->bindParam(':comm_spot_id', $comm_spot_id);

			$stmt4->execute();
			$results = $stmt4->fetchAll( PDO::FETCH_ASSOC );

			foreach( $results as $row ){
				$comment 		= $row['comment_text'];
				$temail 			= $row['admin_email'];
				$when 			= $row['comm_created_at'];
			}?>
	
		<li><strong><font size="2" color="black" ><?php echo "Επιλύθηκε από τον Admin :  $temail";?></font></strong></a></li><br>
		<li><strong><font size="2" color="black" ><?php echo "Στις $when σχολίασε  : $comment";?></font></strong></a></li><br>
			

  		

		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxF6gjpA60q5YG7n-Dj9rIfDTDEpP0rlc"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
		<script src="js/bootstrap.min.js"></script>
