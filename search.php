<!DOCTYPE html>

<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content=""><meta name="author" content="">
	<title>Yimmy</title>
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" /><!-- Custom CSS -->
	<link href="css/business-casual.css" rel="stylesheet" /><!-- Fonts -->
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
	<link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css" /><!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --><!-- WARNING: Respond.js doesn't work if you view the page via file:// --><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
            <div class="brand">Yimmy</div>
    <div class="row">
    <div class="box">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 50vh;;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 50vh;
        margin: 0;
        padding: 0;
      }
      #container {
          height: 100vh;
      }
    </style>
    
    <div id="map"></div>
    <div class="col-lg-12 text-center">
     
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 15
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
            console.log("lat is" + pos.lat);
            console.log("lng is " + pos.lng);
            document.getElementById('user_curr_latitude').value = pos.lat;
            document.getElementById('user_curr_longitude').value = pos.lng;
            
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFtzabY5k6-NOC6V1h3b-LjftEvZyW2MY&callback=initMap">
    </script>
    
    <p id ="test1"> Search for food near you or let us create a meal plan for you for the week</p> 
    <form name=f1 method=post action="/search_results.php">
      <input type="hidden" name="email" value="<?php echo $_POST["email"];?>">
      <input type="text" name="keywords" value="">
      <br>
      
      <br>What cuisine type do you want?<br>
      <input type="checkbox" name="cuisine_type[]" value="american"> American<br>
      <input type="checkbox" name="cuisine_type[]" value="mexican" > Mexican<br>
      <input type="checkbox" name="cuisine_type[]" value="italian" > Italian<br>
      <input type="checkbox" name="cuisine_type[]" value="thai" > Thai<br>
      <input type="checkbox" name="cuisine_type[]" value="chinese"> Chinese <br>
      <input type="checkbox" name="cuisine_type[]" value="japanese"> Japanese <br>

      <br>Price level<br>
      <input type="checkbox" name="price_level[]" value="1"> $ <br>
      <input type="checkbox" name="price_level[]" value="2" > $$ <br>
      <input type="checkbox" name="price_level[]" value="3" > $$$ <br>
      <input type="checkbox" name="price_level[]" value="4" > $$$$ <br><br>
 
      <input type='submit' value='Search' onclick="f1.action='search_results.php'; return true;">
      <input type='submit' value='Create Meal Plan' onclick="f1.action='mealplan.php';  return true;">
       <input type='submit' value='Back' onclick="f1.action='login.php';  return true;">
      <input type="hidden" id="user_curr_latitude" name="user_curr_latitude" value="">
      <input type="hidden" id="user_curr_longitude" name="user_curr_longitude" value="">
      <br><br>
     </form>
     
     <!Copypasted Start>
     <div class="copyright">Copyright &copy; Yimmy 2018</div>
    </div>
    </div>
    </div>
    </footer>
     <!Copypasted End>
  </body>
</html>