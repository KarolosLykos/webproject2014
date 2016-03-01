<?php
	date_default_timezone_set("Europe/Athens");
	session_name("karolos_session");
	session_start();

	if(isset($_SESSION['id'])){
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
		<link type="text/css" rel="stylesheet" href="css/login.css">

		
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
						<li><a href="index.php">Αρχική</a></li>
					</ul>


					<ul class="nav navbar-nav navbar-right">
						<?php if(!isset($_SESSION['id'])){ ?>
						<li><a href="register.php">Εγγραφή </a></li>

						<li class="active"><a>Είσοδος </a></li>
						<?php }else{ ?>
						<li><a href="logout.php">Έξοδος </a></li>
						<?php } ?>
						
					</ul>
				</div>
			</div>
		</nav>

		<?php if(!isset($_SESSION['id'])){ ?>

		<div class="container">
			<form class="form-signin" role="form" method="post" action="check.php">
				<input name="username_input" id="inputUsername" type="text" class="form-control" placeholder="Email" <?php if ($_SESSION['error']==1) {echo "value=\"".$_SESSION['old_username']."\"";}else{ echo "autofocus";} ?> placeholder="Username" required autocomplete="off">
				<input name="password_input" id="inputPassword" type="password" class="form-control" placeholder="Password" <?php if($_SESSION['error']==1){echo "autofocus";} ?> required autocomplete="off">
				<?php
					if ($_SESSION['error']==1) {
						session_unset(); 
						session_destroy();
				?>
				<div class="alert alert-danger">
					<center><strong>Wrong Username or Password</strong></center>
				</div>
				<?php
					}
				?>
				<button class="btn btn-lg btn-default btn-block" name="submit" type="submit">Sign in</button>
			</form>
		</div>

		<?php }else{ ?>

		<!-- Xaxa -->

		<?php } ?>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>


