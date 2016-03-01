<?php
	date_default_timezone_set("Europe/Athens");
	session_name("karolos_session");
	session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>


		 
		
		<LINK REL="SHORTCUT ICON"
      	href = "img\asteri.jpg">
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Karolos</title>

		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
		<link type="text/css" rel="stylesheet" href="css/style.css">



		<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="rss.php" /> 
	</head>
	<body style="background-color:#500000  ;">
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
						<li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"> Αρχική</span></a></li>
						<?php if(isset($_SESSION['id'])){ ?>
						<li><a href="user_profile.php"><span class="glyphicon glyphicon-user"> Προφίλ</span></a></li>
						<li><a href="show_users.php"><span class="glyphicon glyphicon-star-empty"> Χρήστες</span></a></li>
						<li><a href="reports_list.php"><span class="glyphicon glyphicon-th-list"> Λίστα Αναφορών</span></a></li>
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

		

		<div class="well container" style="height:500px;" >
			<div id="map-canvas"></div>
		</div>
		<div class="container">
			<div>
				<button type="button" class="btn btn-default" <input onclick="clearMarkers();" >Hide Markers</button>
				<button type="button" class="btn btn-default" <input onclick="showMarkers();" >Show All Markers</button>
				<a href="rss.php"> <img src="img/rss.png" </image></a>
			</div>
			

			<div class="col-md-4 well" >

				<h2><u><b>Συνολικά Στοιχεία</b></u></h2>
				<h4>Αριθμός Ανφορών: <b></b><span id="numOfSpots"></span></b></h4>
				<h4>-----------------------------------------------------</h4>
				<h4>Αριθμός Επιλυμένων Αναφορών: <b><span id="numOfSolved"></span></b></h4>
				<h4>-----------------------------------------------------</h4>
				<h4>Αριθμός Μη Επιλυμένων Αναφορών: <b><span id="numOfUnsolved"></span></b></h4>
				<h4>-----------------------------------------------------</h4>	
				<h4>Μέσος Χρόνος Επίλυσης: <b><span id="averageTime"></span></b></h4>
			


			</div>
			<div class="col-md-4 col-md-offset-4"> 
			<div class="well" >
			<h2><u><b>Πρόσφατες αλλαγές</b></u></h2>
			<h4>Στις  <span id="showTime"></span> o admin <b><span id="showAdmin"></span></b> έθεσε την κατάσταση της αναφοράς <b><span id="showID"></span></b> ως επιλυμένη</h4>
			
			<h4><b>Σχόλιο:</b></h4>
			<h4><li><i><span id="showComments"></span></i></h4>
			
			</div>
			</div>	
		</div>


		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxF6gjpA60q5YG7n-Dj9rIfDTDEpP0rlc"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
		<script src="js/bootstrap.min.js"></script>



		




		<script type="text/javascript">

		var map;
		var markers = [];

		function initialize() {
			var map_center = new google.maps.LatLng(38.24532, 21.73451);
			var mapOptions = {
				zoom: 10,
				center: map_center
			};
			map = new google.maps.Map(document.getElementById('map-canvas'),
					mapOptions);

			// addMarker(map_center);
		}

		// Add a marker to the map and push to the array.
		function addMarker(location, title, body) {	

			var marker = new google.maps.Marker({
				position: location,
				map: map,
				title: title
			});
			markers.push(marker);

			var contentString = '<div id="content">'+
								'<div id="siteNotice">'+
								'</div>'+
								'<h1 id="firstHeading" class="firstHeading">'+title+'</h1>'+
								'<div id="bodyContent">'+
								'<p>'+body+'</p>'+
								'</div>'+
								'</div>';

			var infowindow = new google.maps.InfoWindow({
				content: contentString
			});
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map,marker);
			});
		}

		// Sets the map on all markers in the array.
		function setAllMap(map) {
			for (var i = 0; i < markers.length; i++) {
				markers[i].setMap(map);
			}
		}

		// Removes the markers from the map, but keeps them in the array.
		function clearMarkers() {
			setAllMap(null);
		}

		// Shows any markers currently in the array.
		function showMarkers() {
			setAllMap(map);
		}

		google.maps.event.addDomListener(window, 'load', initialize);


		function updateSpots(){
			$.ajax({
				type: "POST",
				async: true,
				url: "get_spots.php",
				cache: false,
				success: function(results){

					setAllMap(null);

					spots_results = jQuery.parseJSON(results);
					
					jQuery.each(spots_results, function(i, val) {

						var temp_location 	= new google.maps.LatLng(val.lat, val.lon);
						var title 			= val.title;
						var body 			= val.body;

						addMarker(temp_location, title, body);
					});
				}
			});
		}	

		function updateInfo(){
			$.ajax({
				type: "POST",
				async: true,
				url: "status.php",
				cache: false,
				success: function(results){
					info_results = jQuery.parseJSON(results);
					document.getElementById('numOfSpots').innerHTML = ""+info_results.spots;
					document.getElementById('numOfSolved').innerHTML = ""+info_results.solved;
					document.getElementById('numOfUnsolved').innerHTML = ""+info_results.unsolved;
					document.getElementById('averageTime').innerHTML = ""+info_results.average;
					
				}
			});
		}

		function updateComments(){
			$.ajax({
				type: "POST",
				async: true,
				url: "comment_status.php",
				cache: false,
				success: function(results2){
					info_results = jQuery.parseJSON(results2);
					document.getElementById('showComments').innerHTML = ""+info_results.spot_comments;
					document.getElementById('showID').innerHTML = ""+info_results.spot_id;
					document.getElementById('showAdmin').innerHTML = ""+info_results.Admin_email;
					document.getElementById('showTime').innerHTML = ""+info_results.comm_time;
					
				}
			});
		}

		window.setInterval(function(){
			updateSpots();
			updateInfo();
			updateComments();
		}, 10000);

		updateSpots();
		updateInfo();
		updateComments();
		</script>

		

</body>
</html>
		

	


