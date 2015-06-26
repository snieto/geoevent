<html>
<head>
	<script type="text/javascript"
	        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtvA1l3OHvvrobvCl5ldRiUqGTOzrRWbY">
	        //src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQQnmFW_WBzYdyh82b7KAiSB51ipG7cVw">
	</script>
	<script src="js/gmaps.js"></script>
	<style>
		h1{
			font-size: 16px;
		}
		#map,
		gm-master{
			width: 80%;
			height:500px;
			margin: 40px auto 0;
		}
	</style>
	<script type="text/javascript">
		function getText(){
			window.text = prompt('Wanna say something?');
			geolocate();
		}

		function initialize() {
			var mapOptions = {
				center: { lat: -34.397, lng: 150.644},
				zoom: 8
			};
			var map = new google.maps.Map(document.getElementById('map-canvas'),
				mapOptions);
		}
		google.maps.event.addDomListener(window, 'load', initialize);

		function geolocate(){
			GMaps.geolocate({
				success: function(position) {
					savePos(position.coords.latitude, position.coords.longitude);
					console.log(position);
					//savePos(position.coords.Latitude, position.coords.Longitude);
					//return position;
				},
				error: function(error) {
					alert('Geolocation failed: '+error.message);
				},
				not_supported: function() {
					alert("Your browser does not support geolocation");
				},
				always: function() {
					//alert("Done!");
				}
			});
		}
		function savePos(lat, lng){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("POST", "savePost.php", true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("lat="+lat+"&lng="+lng+"&text="+window.text+"&token="+window.token);
		}
	</script>
	<style>
		body{
			background-color: #000;
		}
		h1{
			background: url(https://europe.wordcamp.org/2015/files/2015/02/logo.png) top center no-repeat;
			background-color: #000;
			height: 200px;
			background-size: contain;
			font-size: 16px;
		 }
		#map,
		.gm-master{
			width: 80%;
			height:500px;
			margin: 40px auto 0;
		}
	</style>
</head>
<body onLoad="getText()">
	<h1>WCEU</h1>
	<!--  - Where are the personas? -->
	<?php
		include __DIR__.DIRECTORY_SEPARATOR.'includes/connectDB.php';
		$spots = getSpots($db);
	?>

	<div id="map"></div>
	<div id="map-canvas"></div>
	<script>
		var map = new GMaps({
			el: '#map',
			lat: 37.4094169,
			lng: -5.9964033,

		});

		<?php
			foreach($spots as $spot):?>
				map.addMarker({
					lat: <?php echo $spot['lat']; ?>,
					lng: <?php echo $spot['lng']; ?>,
					click: function(e){
						console.log('<?php echo $spot['text']; ?>');
					}
				});
		<?php endforeach; ?>


	</script>
	<script>
		/*
		function initialize() {
			var mapOptions = {
				zoom: 8,
				center: new google.maps.LatLng(-34.397, 150.644)
			};

			var map = new google.maps.Map(document.getElementById('map-canvas'),
				mapOptions);
		}

		function loadScript() {
			var script = document.createElement('script');
			script.type = 'text/javascript';
			script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp' +
			'&signed_in=true&callback=initialize&key=AIzaSyCtvA1l3OHvvrobvCl5ldRiUqGTOzrRWbY';
			document.body.appendChild(script);
		}

		window.onload = loadScript;
		*/
	</script>
</body>
</html>