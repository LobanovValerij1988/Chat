
let map;
function initMap(){
  map = new google.maps.Map(document.getElementById("map"),{
    center:{lat: 34.101240, lng:-118.343694 },
    zoom:20,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
  });
	setMarkers(map,locations);
}
var locations = [
       ['LosAngeles',34.101280, -118.343694, 'Central office'],
      
];
function setMarkers(map, locations) {

        var marker, i, mark_position;    
        for (i = 0; i < locations.length; i++) { 
            var title = locations[i][0];
            var lat = locations[i][1];
            var long = locations[i][2];
            var text = locations[i][3];
            mark_position = new google.maps.LatLng(lat, long); // Создаем позицию для отметки
            marker = new google.maps.Marker({ // Что будет содержаться в отметке
                 map: map, // К какой карте относиться отметка
                 title: title, // Заголовок отметки
                 position: mark_position, // Позиция отметки
             });
			
			// Дальше создаем контент для каждой отметки

            var content = '<div class="info-block"><h3>' + title + '</h3><b>' + "Address: </b>" + text + '</div>';
            var infowindow = new google.maps.InfoWindow();
			
			// При нажатии на марку, будет отображаться контент

            google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){
                return function() {
                    infowindow.setContent(content);
                    infowindow.open(map,marker);
                };
            })(marker,content,infowindow));
        }
    }
$(function(){  
$('document').ready(function(){
    $("#map").resizable();
  } )
});
$(function() {
	
    $('#datep').datepicker();
			
});