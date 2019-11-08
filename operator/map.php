<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAgY3Vew0LpTLCBR_Sg98TKXrW_8Yk_4o&libraries=geometry&callback=initMap"></script>
<style type="text/css">
  #map { width: 1079px; height: 400px; }
</style>
<script type="text/javascript"> 
    var map, infoWindow;
    var gmarkers = [];
    var map = null;
    var infoWindow = new google.maps.InfoWindow;
     // auto reload arker
    setInterval(function(){
      // reloadMarkers();
      // initialize();
      updateMarkers();
      // alert("hai");
    }, 5000);
    function deleteMarkers() {
        //Loop through all the markers and remove
        for (var i = 0; i < gmarkers.length; i++) {
            gmarkers[i].setMap(null);
        }

        gmarkers = [];
    };
    var customIcons = {
      pelanggar: {
        icon: '../assets/images/marker/marker-logo2.png'
      }
    };

    function createMarker(latlng, name, icon, html) {
      var contentString = html;
      var marker = new google.maps.Marker({
        position: latlng,
        title: name,
        icon: icon.icon
        // animation: google.maps.Animation.DROP
      });
      
      //menempatkan dan menampilkan info window untuk marker
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(contentString); 
        infoWindow.open(map,marker);
      });
      
      gmarkers.push(marker);
      // alert(gmarkers.length);
      // map.setCenter(marker.position);
      // map.zoom(12);
    }
    function updateMarkers(){
      $.ajax({
          url: "all-location.php",
          type: "GET",
          dataType: "xml",
          success:function(data)
          {
            deleteMarkers();
            // alert (data);
            var xml = data;
            var markers = xml.documentElement.getElementsByTagName("marker");
            for (var i = 0; i < markers.length; i++) {
              var name = markers[i].getAttribute("name");
              var plate = markers[i].getAttribute("plate");
              var foto = markers[i].getAttribute("foto");
              var type = markers[i].getAttribute("category");
              var point = new google.maps.LatLng(
                parseFloat(markers[i].getAttribute("lat")),
                parseFloat(markers[i].getAttribute("lng")));
              var html = "<b>" + name + "</b><br/>"+"<img src='../assets/images/uploads/"+foto+"' style='width:50%'"+"<br/><br/>" + plate;
              //membuat marker
              createMarker(point, name, customIcons[type], html);
             }
            if (gmarkers.length > 0){
                for (var i=0; i<gmarkers.length;i++) {
                  gmarkers[i].setMap(map);

                }
            }
          }
        });  
    }
    function initialize() {
        map = new google.maps.Map(document.getElementById("map"), {
          center: new google.maps.LatLng(-8.676488,115.211177),
          zoom: 12,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        $.ajax({
          url: "all-location.php",
          type: "GET",
          dataType: "xml",
          success:function(data)
          {
            var xml = data;
            var markers = xml.documentElement.getElementsByTagName("marker");
            for (var i = 0; i < markers.length; i++) {
              var name = markers[i].getAttribute("name");
              var plate = markers[i].getAttribute("plate");
              var foto = markers[i].getAttribute("foto");
              var type = markers[i].getAttribute("category");
              var point = new google.maps.LatLng(
                parseFloat(markers[i].getAttribute("lat")),
                parseFloat(markers[i].getAttribute("lng")));
              var html = "<b>" + name + "</b><br/>"+"<img src='../assets/images/uploads/"+foto+"' style='width:50%'"+"<br/><br/>" + plate;
              
              // bindInfoWindow(marker, map, infoWindow, html);
              //membuat marker
              createMarker(point, name, customIcons[type], html);
             }
            if (gmarkers.length > 0){
                for (var i=0; i<gmarkers.length;i++) {
                  gmarkers[i].setMap(map);

                }
            }
          }
        });      
    }
   
    google.maps.event.addDomListener(window, 'load', initialize);
    
    
</script>