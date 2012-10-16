function addPolygon(path, color, vl, title)
{
	var fillOp = vl/140;
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


function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
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
