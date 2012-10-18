
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
