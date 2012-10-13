<!doctype html><!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]--><!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]--><!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]--><!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]--><!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
  <meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>.starter</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.med.css">
	
  <script src="<?php echo base_url(); ?>assets/js/vendor/modernizr-2.6.1.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

</head>

<body><!--[if lt IE 7]><p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p><![endif]-->
	
<div id="canvas"></div>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>assets/js/vendor/jquery-1.8.0.min.js"><\/script>')</script>

  <script src="<?php echo base_url(); ?>assets/js/plugins.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
	<script type="text/javascript" charset="utf-8">
		
		
		var map;
		
		
		function loadPlacemarks()
		{
			$.getJSON('http://localhost/nextstore/index.php/map/fetch_placemarks', function(json) {
				
				if (json.length > 0) {
					
					for (_i=0; _i < json.length; _i++) {
												 
						var path = new google.maps.LatLng(json[_i].lat,json[_i].lng);
						var title = json[_i].title;
				
						addPlacemark(path, title);
					
					}
				
				}
				
			});
				
		}
		
		
		function loadScript()
		{
			$.getJSON('http://localhost/nextstore/index.php/map/fetch_bounds', function(json) {

				if (json.length > 0) {

					for (_i=0; _i < json.length; _i++) {
						
						var correlation = json[_i].correlation;
						var title = json[_i].title;
						var zip = json[_i].coordinates;
								
						var path = [];
				
						for (var i = 0; i < zip.length; i++){
					
							var coord = zip[i];
													
							path.push(new google.maps.LatLng(coord[0], coord[1]));
					
						}
						
						addPolygon(path, correlation, title);
											
					}
					
				}

			});
			
		}

		function initialize() {

		  var mapOptions = {
		    zoom: 8,
		    center: new google.maps.LatLng(51.8391075134278, 4.603306770324821),
		    mapTypeId: google.maps.MapTypeId.ROADMAP
		  };

		  map = new google.maps.Map(document.getElementById('canvas'), mapOptions);
			
			loadScript();
			
			loadPlacemarks();
		}


		function addPolygon(path, correlation, title)
		{
			var fillOp = (Math.floor(Math.random() * 70) + 20)/100;
			var fill = '#'+Math.floor(Math.random()*16777215).toString(16);
			zipcode = new google.maps.Polygon({
		    paths: path,
		    strokeColor: "#ffffff",
		    strokeOpacity: 0.8,
		    strokeWeight: 1,
		    fillColor: fill,
		    fillOpacity: fillOp
		  });
			
			zipcode.infowindow = new google.maps.InfoWindow({content:"<b>" + title + "</b>" + "</br>"});
			
			zipcode.infowindow.name = title;
			
			google.maps.event.addListener(zipcode, 'click', showInfo);
			
			zipcode.setMap(map);
			
		}
		
		function addPlacemark(coordinates, title)
		{
			
			var marker = new google.maps.Marker({
		      position: coordinates,
		      map: map,
		      title: title
		  });
		
		}
		
		var opened_info = new google.maps.InfoWindow();
    
		function showInfo(event) {
        opened_info.close();
        if (opened_info.name != this.infowindow.name) {
            this.infowindow.setPosition(event.latLng);
            this.infowindow.open(map);
            opened_info = this.infowindow;
        }
    }

		$(document).ready(function(){

			initialize();

		});
		
	</script>
</body></html>