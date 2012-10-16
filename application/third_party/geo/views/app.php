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

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.med.css">
	
  <script src="<?php echo base_url(); ?>assets/js/vendor/modernizr-2.6.1.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
</head>
<style type="text/css" media="screen">
	#canvas img {
	  max-width: none;
	}
</style>
<body><!--[if lt IE 7]><p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p><![endif]-->
	
<div id="toolbar">
	
	<div class="ui-nav">
		<a class="client-logo" href="/">Bever Sport</a>
		
		<ul class="nav">
			<li>
				<span class="group"><i class="icon-signal icon-white"></i> Store Portfolio</span>
				<ul>
					<li><a href="<?= site_url() ?>/app/geo/coverage">Coverage</a></li>
					<li><a href="<?= site_url() ?>/app/geo/performance">Performance</a></li>
					<!--<li><a href="<?= site_url() ?>/app">New Store Potential</a></li>-->
				</ul>
			</li>
			<li>
				<span class="group"><i class="icon-map-marker icon-white"></i> Areas</span>
				<ul>
					<li><a href="<?= site_url() ?>/app/geo">Underperforming Areas</a></li>
					<li><a href="<?= site_url() ?>/app/geo">Drivetime Analytics</a></li>
				</ul>
			</li>
			<li>
				<span class="group"><i class="icon-cog icon-white"></i> Settings</span>
				<ul>
					<li><a href="<?= site_url() ?>/app">Define Target Group</a></li>
					<li><a href="<?= site_url() ?>/app">Define Catchment Area</a></li>
					<li><a href="<?= site_url() ?>/app">Upload Data</a></li>
				</ul>
			</li>
			<li>
				<span class="group"><i class="icon-user icon-white"></i> Application</span>
				<ul>
					<li><a href="<?= site_url() ?>/app/profile">Profile</a></li>
					<li><a href="<?= site_url() ?>/app/logout">Logout</a></li>
				</ul>
			</li>
		</ul>
	
		<a class="logo" href="/">Smarten UP</a>
	
	</div>
</div>
<div id="content">
	<div class="ui-control scroll-pane">
		<div class="main">
		</div>
	</div>
</div>

<div id="buttonset" style="position:absolute;z-index:1000;left:730px;top:10px">
<div class="btn-group">
	<button class="btn btn-mini" id="provinceMap">Province</button>
  <button disabled="disabled" class="btn btn-mini">Commune</button>
  <button disabled="disabled" class="btn btn-mini">Postal</button>
	 <button class="btn btn-mini dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
	  <ul class="dropdown-menu">
			<li><a tabindex="-1" href="#">Roadmap</a></li>
			<li><a tabindex="-1" href="#">Satelite</a></li>
		  <li class="divider"></li>
		  <li><a tabindex="-1" href="#">Disable map &times;</a></li>
	  </ul>
</div>
</div>
<div id="canvas"></div>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>assets/js/vendor/jquery-1.8.0.min.js"><\/script>')</script>

  <script src="<?php echo base_url(); ?>assets/js/plugins.js"></script>

  <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.js"></script>

  <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
	<script type="text/javascript" charset="utf-8">
		var map;
		
		function loadPlacemarks()
		{
			$.getJSON('http://localhost/nextstore/index.php/app/geo/fetch_placemarks', function(json) {
				
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
			$.getJSON('http://localhost/nextstore/index.php/app/geo/fetch_bounds/2/1', function(json) {

				if (json.length > 0) {

					for (_i=0; _i < json.length; _i++) {
						
						var correlation = json[_i].correlation;
						var title = json[_i].title;
						var zip = json[_i].coordinates;
						var vl = json[_i].vl;
								
						var path = [];
				
						for (var i = 0; i < zip.length; i++){
					
							var coord = zip[i];
													
							path.push(new google.maps.LatLng(coord[0], coord[1]));
					
						}
						
						addPolygon(path, correlation, vl,title);
											
					}
					
				}

			});
		}

		
		function initialize() {
			var scope = new google.maps.LatLng(52.075879,3.989377);
		  var mapOptions = {
		    zoom: 8,
		    center: scope,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				mapTypeControl: false,
				mapTypeControlOptions: {
					style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
					position: google.maps.ControlPosition.TOP_RIGHT
					},
				panControl: false,
				streetViewControl: false,
				scaleControl: false,
				zoomControl: true,
				zoomControlOptions: {
					style: google.maps.ZoomControlStyle.LARGE,
					position: google.maps.ControlPosition.RIGHT_TOP
					}
				};

		  map = new google.maps.Map(document.getElementById('canvas'), mapOptions);
			
			google.maps.event.addDomListener(window, 'resize', function() {
			    map.setCenter(scope);
			});
			
			//loadPlacemarks();
			
		}
		
		$(document).ready(function(){
			var ww = $(window).width();
			var m = ww-480+230;
			$('#canvas').css({width: m+"px"});
			
			initialize();
			
			
			$('#provinceMap').toggle(function(){
				
				$(this).addClass('active');
				
				loadScript();
								
			},function(){
				
				$(this).removeClass('active');
				
				zipcode.setMap(null);
				
			});
			
			
		});
		
		$(window).resize(function(){
			var ww = $(window).width();
			var m = ww-480+230;
			$('#canvas').css({width: m+"px"});
			
		});
	
		$(function()
		{
			$('.scroll-pane').jScrollPane();
		});
		
	</script>
</body></html>