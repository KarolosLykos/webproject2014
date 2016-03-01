<?php
	date_default_timezone_set("Europe/Athens");
	session_name("karolos_session");
	session_start();
	$temail = $_GET['email'];
	echo "<pre>";
				var_dump($_GET['email']);
				echo "</pre>";
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
						<body style="background-color:#500000  ;">
						</body>
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

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
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


					<ul class="nav navbar-nav navbar-right">
						<?php if(!isset($_SESSION['id'])){ ?>
						<li class="active"><a href="">Εγγραφή </a></li>
						<li><a href="login.php">Είσοδος </a></li>
						<?php }else{ ?>
						<li><a href="logout.php">Έξοδος </a></li>
						<?php } ?>
						
					</ul>
				</div>
			</div>
		</nav>
		<div class="container well"><font size="5" color="black" ><span class="glyphicon glyphicon-star-empty"> Διαγραφή Χρήστη <?php echo "$temail" ?> </span></font>
</div>
		<div class="container well">
			
			<form role="form" method="post" action="delete_user_submit.php">
				<input type="hidden" name="email" value="<?php echo $_GET['email'];?>">
				
				<font size="3" color="black" >Είστε σίγουρος οτι θέλετε να διαγράψετε τον χρήστη: <?php echo "$temail" ?>
				</div>


				<div class="form-group col-md-4">
					<button type="submit" class="btn btn-default">Submit</button>
				</div>
				<!-- <div class="form-group col-md-2"> -->
					<a href="index.php"><button type="button" class="btn btn-default"> Ακύρωση</button></a>
				<!-- </div> -->
				
			</form>

		</div>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
		<script src="js/bootstrap.min.js"></script>

	</body>
</html>