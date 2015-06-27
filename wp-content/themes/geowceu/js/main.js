(function ($) {
	function getText() {
		window.text = localStorage.getItem("geoevent-twitter-id");
		if (window.text == null) {
			window.text = prompt('Remember to reload to update your position. Now input your Twitter username, with or without @');
			localStorage.setItem("geoevent-twitter-id", window.text);
		}
		geolocate();
	}


	function initialize() {
		var mapOptions = {
			center: {lat: -34.397, lng: 150.644},
			zoom  : 6
		};
		var map = new google.maps.Map(document.getElementById('map-canvas'),
			mapOptions);
		window.token = localStorage.getItem("geoevent-id");
		if (token == null) {
			localStorage.setItem("geoevent-id", window.token);
			window.token = localStorage.getItem("geoevent-id");
		}
	}

	google.maps.event.addDomListener(window, 'load', initialize);

	function geolocate() {
		GMaps.geolocate({
			success      : function (position) {
				map.addMarker({
					lat : position.coords.latitude,
					lng : position.coords.longitude,
					icon: '<?php echo get_stylesheet_directory_uri();?>/images/markers/ffa500-marker-32-blue.png'
				});
				map.setCenter(position.coords.latitude, position.coords.longitude);
				savePos(position.coords.latitude, position.coords.longitude);
				//savePos(position.coords.Latitude, position.coords.Longitude);
				//return position;
			},
			error        : function (error) {
				//alert('Geolocation not enabled? '+error.message);
			},
			not_supported: function () {
				alert("Your browser does not support geolocation");
			},
			always       : function () {
				//alert("Done!");
			}
		});
	}

	function savePos(lat, lng) {
		if (typeof text == 'undefined') {
			text = '';
		}
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("POST", "<?php echo get_stylesheet_directory_uri();?>/savePost.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("lat=" + lat + "&lng=" + lng + "&text=" + window.text + "&token=" + window.token);
	}



	$( document ).ready( function() {
		getText();

		$('.animated_popup').popup({
			show: function ($popup, $back) {
				var plugin = this,
					center = plugin.getCenter();
				$popup
					.css({
						top    : -$popup.children().outerHeight(),
						left   : center.left,
						opacity: 1
					})
					.animate({top: center.top}, 500, 'easeOutBack', function () {
						// Call the open callback
						plugin.o.afterOpen.call(plugin);
					});
			}
		});
		$('.animated_popup').popup.(	);
	});
})(jQuery);