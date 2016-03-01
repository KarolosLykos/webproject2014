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
						<li><a href="user_profile.php"><span class="glyphicon glyphicon-user"> Προφίλ</span></a></li>
						<li><a href="show_users.php"><span class="glyphicon glyphicon-star-empty"> Χρήστες</span></a></li>
						<li class="active"><a href="reports_list.php"><span class="glyphicon glyphicon-th-list"> Λίστα Αναφορών</span></a></li>
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
						<!-- <li><a href="logout.php">Έξοδος </a></li> -->
						<?php } ?>
						
					</ul>
				</div>
			</div>
		</nav>
		<div class="container well"><font size="5" color="black" ><span class="glyphicon glyphicon-star-empty"> Ενημέρωση αναφοράς <?php echo $_SESSION['id'] ?> </span></font>
</div>
		<div class="container well">
			
			<form role="form" method="post" action="edit_spot_submit.php">
				<div class="form-group col-md-4">
					<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
					<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
					<input type="hidden" name="admin" value="<?php echo $_SESSION['admin'];?>">
					<input type="hidden" name="admin_email" value="<?php echo $_SESSION['email'];?>">
					<select name="solved">
						<option selected disabled>Κατάσταση Αναφοράς</option>
						<?php
						$temp_solved = "1";
						$temp_unsolved = "0";
						
						echo "<option value=\"".$temp_solved."\">Επιλύθηκε</option>";
						
						echo "<option value=\"".$temp_unsolved."\">Εκκρεμεί</option>";
						?>
						</select>
					
				</div>
				<div class="form-group col-md-4">
					<label for="comment_text">Εισάγετε το σχόλιο σας</label>
					<textarea class="form-control" id="comment_text" name="comment_text"></textarea>
				</div>

				<div class="clearfix"></div>

				<div class="clearfix"></div>
				<div class="form-group col-md-4">
					<button type="submit" class="btn btn-default">Submit</button>
				</div>
			</form>

		</div>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
		<script src="js/bootstrap.min.js"></script>

	</body>
</html>

































