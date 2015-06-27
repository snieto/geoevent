(function ($) {
	var GeoHelper = {
		getText: function () {
			console.log('GET TEXT');
			window.text = localStorage.getItem("geoevent-twitter-id");
			if (window.text == null) {
				window.text = prompt('Remember to reload to update your position. Now input your Twitter username, with or without @');
				localStorage.setItem("geoevent-twitter-id", window.text);
			}
			this.geolocate();
		},


		initialize: function () {
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
		},


		geolocate: function () {
			GMaps.geolocate({
				success      : function (position) {
					map.addMarker({
						lat : position.coords.latitude,
						lng : position.coords.longitude,
						icon: './wp-content/themes/geowceu/images/markers/ffa500-marker-32-blue.png',
						optimized: false,
						zIndex: 100000
					});
					console.log('Done!');
					map.setCenter(position.coords.latitude, position.coords.longitude);
					GeoHelper.savePos(position.coords.latitude, position.coords.longitude);
					//savePos(position.coords.Latitude, position.coords.Longitude);
					//return position;
				},
				error        : function (error) {
					console.log('Error!');
					alert('Geolocation not enabled? ' + error.message);
				},
				not_supported: function () {
					alert("Your browser does not support geolocation");
				},
				always       : function () {
					//alert("Done!");
				}
			});
		},

		savePos: function (lat, lng) {
			if (typeof text == 'undefined') {
				text = '';
			}
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("POST", "./wp-content/themes/geowceu/savePost.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("lat=" + lat + "&lng=" + lng + "&text=" + window.text + "&token=" + window.token);
		}
	};
	window.geoHelper = GeoHelper;
})(jQuery);
$( document ).on( 'load', function() {
	google.maps.event.addDomListener(window, 'load', geoHelper.initialize);
});
$( document ).ready( function() {
	console.log('INIT');
	$('.explain').delay(5000).fadeOut();
	$('.explain').on('click', function(){
		$(this).fadeOut();
	});
	geoHelper.getText();

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
	$('.animated_popup').trigger('click');

});