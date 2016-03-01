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
						<li><a href="user_profile.php"><span class="glyphicon glyphicon-user"> Προφίλ</span></a></li>
						<li><a href="show_users.php"><span class="glyphicon glyphicon-star-empty"> Χρήστες</span></a></li>
						<li><a href="reports_list.php"><span class="glyphicon glyphicon-th-list"> Λίστα Αναφορών</span></a></li>
						<li class="active"><a href="add_spot.php"><span class="glyphicon glyphicon-plus"> Προσθήκη Αναφοράς</span></a></li>
					</ul>


					<ul class="nav navbar-nav navbar-right">
						<?php $email = $_SESSION['email']; ?>
						<li><a href="user_profile.php"><span class="glyphicon glyphicon-user"> <?php echo "$email" ?> </span></a></li>
						<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> (Έξοδος) </span></a></li>
					</ul>
				</div>
			</div>
		</nav>


		<div class="well container">

			<form role="form" method="post" action="add_spot_submit.php">
	
				<div class="clearfix"></div>



					<!-- Mono mia epilogh -->
					<!-- Prosthhkh kathgoriaws -->	



				<div class="form-group col-md-4">
					<label for="inputCategory">Επιλέξτε Κατηγορία</label>
					
					<select name="category">
						<option selected disabled>Κατηγορία</option>
						<?php 
							try {
							$pdo = new PDO('mysql:host=localhost;dbname=karolos;charset=utf8', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							} catch(PDOException $e) {
							echo 'ERROR: ' . $e->getMessage();
							}

							$stmt_check_email = $pdo->prepare("SELECT * FROM `karolos`.`category` ");
							$stmt_check_email->execute();

							while($row = $stmt_check_email->fetch( PDO::FETCH_ASSOC )){


							echo "<option value=\"".$row['name']."\">".$row['name']."</option>";
						}
						 ?>
					</select>
				</div>
			
		
				<div class="clearfix"></div>

				<div class="form-group col-md-4">
					<label for="inputAddress">Διεύθυνση</label>
					<input type="text" class="form-control" id="inputAddress" name="address" placeholder="Enter Address" >
					
				</div>

				<div class="form-group col-md-4">
					<label for="inputArea">Περιοχή</label>
					<input type="text" class="form-control" id="inputArea" name="area" placeholder="Enter Area" >
				</div>

				<div class="clearfix"></div>

				<div class="form-group col-md-4">
					<label for="latitude">Latitude</label>
					<input type="text" class="form-control" id="latitude" name="latitude">
				</div>

				<div class="form-group col-md-4">
					<label for="longitude">Longitude</label>
					<input type="text" class="form-control" id="longitude" name="longitude">
				</div>


				<div class="clearfix"></div>

				<div class="form-group col-md-4">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title">
				</div>

				<div class="form-group col-md-4">
					<label for="description">Description</label>
					<textarea class="form-control" id="description" name="description"></textarea>
				</div>



				<div class="form-group col-md-4">
					<label for=""></label>
					<button type="submit" class="form-control btn btn-info">Add</button>
				</div>

				




				<div class="col-md-12" style="height:500px;">
					<div id="map-canvas"/>
				</div>

			</form>

			

		</div>

		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxF6gjpA60q5YG7n-Dj9rIfDTDEpP0rlc"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
		<script src="js/bootstrap.min.js"></script>



		

			


		<script type="text/javascript">

			$(document).ready(function() {
				updateMap();
				$('#inputAddress').change(chackAddress);
				$('#inputAddress').keyup(chackAddress);
				$('#inputArea').change(chackAddress);
				$('#inputArea').keyup(chackAddress);
			});



			function updateMap(address) {

				var position = new google.maps.LatLng(0,0);

				google_map = new google.maps.Map(document.getElementById('map-canvas'), {
				  center: position,
				  zoom: 16,
				  mapTypeId: google.maps.MapTypeId.ROADMAP
				});

				geocoder = new google.maps.Geocoder();
				geocoder.geocode({ 'address': address }, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						google_map.setCenter(results[0].geometry.location);
						var marker = new google.maps.Marker({
							map: google_map,
							draggable:true,
							animation: google.maps.Animation.DROP,
							position: results[0].geometry.location
						});

						var lat = ""+marker.getPosition().lat()+"";
						var lng = ""+marker.getPosition().lng()+"";
						document.getElementById("latitude").value = lat.substring(0,8);
						document.getElementById("longitude").value = lng.substring(0,8);

						google.maps.event.addListener(marker, 'dragend', function()
						{
							//document.getElementById("latitude").value = "lat/long: "+marker.getPosition();
							var lat = ""+marker.getPosition().lat()+"";
							var lng = ""+marker.getPosition().lng()+"";
							document.getElementById("latitude").value = lat.substring(0,8);
							document.getElementById("longitude").value = lng.substring(0,8);
						});
					}
				});
			}


			function chackAddress(){
				var address = document.getElementById("inputAddress").value;
				var area = document.getElementById("inputArea").value;
				var addr = ""+address+" "+area+"";


				if (addr.length > 8 && addr.length%2 == 0){
					var geocoder = new google.maps.Geocoder();

					geocoder.geocode( { 'address': addr}, function(results, status) {
						if (status == 'OK') {
							updateMap(addr);
						};
					});
				};
			}

		var map;
		var markers = [];

		function initialize() {
			var map_center = new google.maps.LatLng(37.984335, 23.729058);
			var mapOptions = {
				zoom: 12,
				center: map_center
			};
			map = new google.maps.Map(document.getElementById('map-canvas'),
					mapOptions);
		}

		// Add a marker to the map and push to the array.
		function addMarker(location) {

			var marker = new google.maps.Marker({
				position: location,
				map: map,
			});
			markers.push(marker);
		}

		// Sets the map on all markers in the array.
		function setAllMap(map) {
			for (var i = 0; i < markers.length; i++) {
				markers[i].setMap(map);
			}
		}
		// Shows any markers currently in the array.
		function showMarkers() {
			setAllMap(map);
		}

		google.maps.event.addDomListener(window, 'load', initialize);

		</script>
					
	
		
	</body>
</html>