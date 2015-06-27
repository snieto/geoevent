<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon.ico" />
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtvA1l3OHvvrobvCl5ldRiUqGTOzrRWbY">
	</script>
	<link href='<?php echo get_stylesheet_directory_uri();?>/style.css' rel='stylesheet' type='text/css'>
	<script src="<?php echo get_stylesheet_directory_uri();?>/js/gmaps.js"></script>
	<script>
		window.token = '<?php $token = md5(uniqid(mt_rand(), true));?>';
	</script>
</head>
<body>
<?php include_once(locate_template("includes/analytics-tracking.php")); ?>
<header>
<div class="hastag">#WCEU</div>
<h1>GEOEVENT - ALPHA VERSION</h1>
<h2>WCEU</h2>

<div class="animated_popup">
	<form>
		<h3></h3>
		<label for="twitter">Twitter id:</label>
		<input type="text" name="twitter" value="">

		<h3>I'm here for:</h3>
		<ul>
			<li>
				be hired
			</li>
			<li>
				hiring
			</li>
			<li>
				networking
			</li>
			<li>
				gay pride parade
			</li>
			<li>
				Sex
			</li>
		</ul>
	</form>
</div>
<?php do_action( 'wordpress_social_login' ); ?>

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
		Developed in Seville with <span class="heart">&#9829;</span> for you!
	</div>
<?php /*
	<div class="github">
		Github: <a href="https://github.com/snieto/geoevent">https://github.com/snieto/geoevent</a>
	</div>
 */ ?>
</footer>
<script>
	var map = new GMaps({
		el: '#map',
		lat: 37.4094169,
		lng: -5.9964033,
		styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}]
	});

	<?php
		foreach($spots as $spot):
		?>
	map.addMarker({
		lat: <?php echo $spot['lat']; ?>,
		lng: <?php echo $spot['lng']; ?>,
		icon: '<?php echo get_stylesheet_directory_uri();?>/images/markers/ffa500-marker-32<?php echo $mySpot;?>.png'
	});
	<?php endforeach; ?>


</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/js/jquery.popup.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri();?>/js/main.js">
</body>
</html>
