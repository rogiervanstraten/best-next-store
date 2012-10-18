
$(function()
{
	
	$('.scroll-pane').each(function(){
			
			$(this).jScrollPane({showArrows: $(this).is('.arrow')});

			var api = $(this).data('jsp');
			var throttleTimeout;
			
			$(window).bind('resize',function(){
				
					if ($.browser.msie) {
						if (!throttleTimeout) {
							throttleTimeout = setTimeout(function(){
									api.reinitialise();
									throttleTimeout = null;
								}, 50);
						}
					} else {
						
						api.reinitialise();
					
					}
					
				});
			
		});
		
});


/******
*******
** RESIZE CANVAS
*******
******/
function resize_canvas()
{
	var ww = $(window).width();
	var m = ww-(711);
	$('#canvas').css({width: m+"px"});
}



	/******
	** GEO
	** ADD PLACEMARK 
	*******
	******/
	function addPlacemark(coordinates, title)
	{
		var marker = new google.maps.Marker({
	      position: coordinates,
	      map: map,
	      title: title
	  });
	}


	/******
	** GEO
	** ADD POLYGON 
	*******
	******/
	function addPolygon(path, color, vl, title)
	{
		var fillOp = vl/110;

		if(vl < 40)
		{
			var fillOp = 0.3;
		}
		if(vl == 0)
		{
			var fillOp = 0;
		}
		if(vl > 80)
		{
			var fillOp = 0.8;
		}

		zipcode = new google.maps.Polygon({
	    paths: path,
	    strokeColor: "#ffffff",
	    strokeOpacity: 0.8,
	    strokeWeight: 1,
	    fillColor: 'rgb('+color+')',
	    fillOpacity: fillOp
	  });

		zipcode.infowindow = new google.maps.InfoWindow({content:"<b>" + title + "</b>" + "</br>"});
		zipcode.infowindow.name = title;
		zipcode.setMap(map);

		google.maps.event.addListener(zipcode, 'click', showInfo);	

	}


/*=====
*******
** ACTIONS ON WINDOW RESIZE
*******
=====*/
$(window).resize(function(){
	
	//CENTER GOOGLEMAPS
	resize_canvas();

});

/******
*******
** DOCUMENT READY
*******
******/
$(document).ready(function(){
	
	resize_canvas();

});


var opened_info = new google.maps.InfoWindow();

function showInfo(event) {
    opened_info.close();
    if (opened_info.name != this.infowindow.name) {
        this.infowindow.setPosition(event.latLng);
        this.infowindow.open(map);
        opened_info = this.infowindow;
    }
}