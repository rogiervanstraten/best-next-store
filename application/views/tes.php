$.getJSON('http://localhost/nextstore/index.php/map/json_report', function(json) {
	console.log(json);
	if (json.length > 0) {

		for (i=0; i<json.length; i++) {

			for (var i = 0; i < json[0].coordinates.length; i++){
				var coord = json[0].coordinates[i];
				var ll = new google.maps.LatLng(coord[1], coord[0]);
				path.push(ll);
			}
			
			addPolygon(path);

		}
	}
});