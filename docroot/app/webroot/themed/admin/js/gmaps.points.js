/* (c) 2007 Witold Rugowski http://nhw.pl

v0.1 - 2007-02-09 - Initial release, tested in FF, some quirks in IE
v0.2 - 2007-03-27 - Improved release - drag&drop, changed icon
v0.3 - 2007-05-15 - Fixed blocked drag&drop
*/
var points = new Array();
var markers = new Array();
var map;
var line = undefined;
var vertex = true;

var opt = {};
opt.draggable = true
opt.clickable = false
opt.dragCrossMove = true


var geocoder = new GClientGeocoder();

function showAddress(address) {
  geocoder.getLatLng(
    address,
    function(point) {
      if (!point) {
        alert(address + " not found");
      } else {
        map.setCenter(point, 14);
      }
    }
  );
}

function load() {
	if (GBrowserIsCompatible()) {
		map = new GMap2(document.getElementById("map"));
		map.setCenter(new GLatLng(-25.244696, 133.769531), 4);
		map.addControl(new GLargeMapControl())
		map.addControl(new GMapTypeControl())

		GEvent.addListener(map, "click", function (marker, point) {
			if (!vertex)	//dont add new points in Polygon mode
				return
			if (!marker) {
				addMarker(point);
			}
			else {
				reShape();
			}
		})
	}
}

function addMarker(point) {
	new_marker = new GMarker(point,opt)
	map.addOverlay( new_marker )
	markers.push(new_marker)
	GEvent.addListener(new_marker,'dragend', function(){
		points[markers.indexOf(this)] = this.getPoint()
		reDraw()
		asArray()
	})
	points.push(point);
	asArray();
	reDraw();
}

function clearPoints() {
	points = new Array()
	markers = new Array
	map.clearOverlays()
	$("#DeliveryAreaAreas").val("");
	line = undefined
	vertex = true
}

function toArray() {
	txt = "";
	for (i = 0; i < points.length; i++) {
    	txt = txt + points[i].lat() + ',' + points[i].lng() + "\n";
	}
	return txt;
}

function toGLatLng() {
  html = "[<br/>"
  for (i=0; i<points.length; i++) {
    html = html + ' new GLatLng(' + points[i].lat() +
            ',' + points[i].lng() + ')'
    if (i <points.length-1)
      html = html +',<br/>'
    else
      html = html + '<br/>]<br/>'

  }
  return html
}

function asArray() {
	$("#DeliveryAreaAreas").val(toArray());
}

function asGLatLng() {
  document.getElementById("output").innerHTML = toGLatLng()
}

function reDraw() {
  if (vertex) {
    if (line) {
      map.removeOverlay(line)
    }
    line = new GPolyline( points )
    map.addOverlay(line)
  } else {
    map.clearOverlays()
    map.addOverlay(new GPolygon(points,'#000000',2,1,'#FF0000',.5))
  }
}

function delLast() {
	points.pop();
	map.removeOverlay(markers.pop());
	reDraw();
	if ( !vertex ) {
		reShape();
	}
}

function reShape() {
	map.clearOverlays();
	vertex = !vertex;
	if (vertex) {
		for (i=0; i < markers.length; i++) {
			map.addOverlay(markers[i]);
		}
	}
	reDraw();
}