<html>
<head>
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon.ico" />
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtvA1l3OHvvrobvCl5ldRiUqGTOzrRWbY">
		//src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQQnmFW_WBzYdyh82b7KAiSB51ipG7cVw">
	</script>
	<script src="<?php echo get_stylesheet_directory_uri();?>/js/gmaps.js"></script>
	<script type="text/javascript">
		function getText(){
			window.text = localStorage.getItem("geoevent-twitter-id");
			if(window.text == null) {
				window.text = prompt('Input your Twitter username');
				localStorage.setItem("geoevent-twitter-id", window.text);
			}
			geolocate();
		}
		<?php $token = md5(uniqid(mt_rand(), true));?>
		function initialize() {
			var mapOptions = {
				center: { lat: -34.397, lng: 150.644},
				zoom: 8
			};
			var map = new google.maps.Map(document.getElementById('map-canvas'),
				mapOptions);
			window.token = localStorage.getItem("geoevent-id");
			if(token == null) {
				localStorage.setItem("geoevent-id", "<?php echo $token;?>");
				window.token = localStorage.getItem("geoevent-id");
			}
		}
		google.maps.event.addDomListener(window, 'load', initialize);

		function geolocate(){
			GMaps.geolocate({
				success: function(position){
					map.addMarker({
						lat: position.coords.latitude,
						lng: position.coords.longitude,
						icon: '<?php echo get_stylesheet_directory_uri();?>/images/markers/ffa500-marker-32.png'
					});
					map.setCenter(position.coords.latitude, position.coords.longitude);
					savePos(position.coords.latitude, position.coords.longitude);
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
			if(typeof text == 'undefined'){
				text = '';
			}
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("POST", "<?php echo get_stylesheet_directory_uri();?>/savePost.php", true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("lat="+lat+"&lng="+lng+"&text="+window.text+"&token="+window.token);
		}
	</script>
	<style>
		body{
			background-color: #000;
			font-family: Georgia;
		}

		header{
			height:80px;
			position: relative;
		}
		.hastag{
			padding-top: 40px;
			padding-left: 30px;
			float: left;
			width: 100px;
			color: orange;
			font-size: 25px
		}
		h1{
			background: url(<?php echo get_stylesheet_directory_uri();?>/images/logogeo.png) top center no-repeat;
			font-size: 0;
			height: 96px;
			width:382px;
			position: absolute;
			left:50%;
			margin-left: -191px;
			margin-top: 10px;
			background-size:80%;
		}

		h2{
			background: url(<?php echo get_stylesheet_directory_uri();?>/images/logow.png) top center no-repeat;
			font-size: 0;
			height: 112px;
			width:138px;
			position:absolute;
			right:20px;
			margin-top: 10px;
			background-size:80%;
		}

		#map,
		.gm-master{
			width: 100%!important;
			height:70%;
			margin: 30px auto 0;
		}

		footer{
			color: #eee;
			height: 60px;
		}

		.developed{
			margin-top: 15px;
		}
		.developed .heart{
			color: red;
		}

		.authors{
			float: right;
			width: 150px;

		}
		.authors a{
			display: block;
			width: 100%;
			margin-bottom: 5px;
		}

		.github{
			color: #eee;
			margin-top: 15px;
		}

		footer a{
			color: orange;
		}

		@media screen and (max-width: 767px){
			header{
				height: 55px;
			}
			h1{
				background-size:50%;
			}

			h2{
				background-size:50%;
			}
			#map{
				height:70% !important;
			}
		}
	</style>
</head>
<body onLoad="getText()">
<header>
<div class="hastag">#WCEU</div>
<h1>GEOEVENT - ALPHA VERSION</h1>
<h2>WCEU</h2>
</header>

<!--  - Where are the personas? -->
<?php
include __DIR__.DIRECTORY_SEPARATOR.'includes/connectDB.php';
$spots = getSpots($db);
?>

<div id="map"></div>
<div id="map-canvas"></div>

<footer>
	<div class="authors">
		<a href="https://twitter.com/snieto">@snieto</a>
		<a href="https://twitter.com/juaevpa">@juaevpa</a>
		<a href="https://twitter.com/manelio">@manelio</a>
	</div>
	<div class="developed">
		Developed in Seville with <span class="heart">&#9829;</span> for you WCEU personas!
	</div>
	<div class="github">
		Github: <a href="https://github.com/snieto/geoevent">https://github.com/snieto/geoevent</a>
	</div>
</footer>
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
		icon: '<?php echo get_stylesheet_directory_uri();?>/images/markers/ffa500-marker-32.png'
	});
	<?php endforeach; ?>


</script>
</body>
</html>