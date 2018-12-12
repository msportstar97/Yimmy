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
<div class="brand">Yimmy</div>

<div class="container">
<div class="row">
<div class="box">
<div class="col-lg-12 text-center">
    
<?php

class Foo {
    public static function jsonToDebug($jsonText = '')
    {
        $arr = json_decode($jsonText, true);
        // print_r($arr);
        // $html = "";
        $html = array();
        if ($arr && is_array($arr)) {
            $html = self::_arrayToHtmlTableRecursive($arr, $html);
        }
        return $html;
    }

    private static function _arrayToHtmlTableRecursive($arr, $html) {
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                if (!empty($val)) {
                    if ($key == "results") {
                        foreach ($val as $key1 => $val1) {
                            $name = "";
                            $location = "";
                            $price = 0;
                            $rating = 0;
                            foreach ($val1 as $key2 => $val2) {
                                if ($key2 == "name" && $key != "0") {
                                    $name = $val2;
                                }
                                if ($key2 == "vicinity") {
                                    $location = $val2;
                                } 
                                if ($key2 == "price_level") {
                                    $price = $val2;
                                }
                                if ($key2 == "rating") {
                                    $rating = $val2;
                                }
                            }
                            array_push($html, Array($name, $location, $price, $rating));
                        }
                    } else {
                        $html = self::_arrayToHtmlTableRecursive($val, $html);
                    }
                }
            }
        }
        return $html;
    }
}
//include 'call_api.php';

//creating an array of keywords
$keywords = $_POST["keywords"];
$keywords = explode(" ", $keywords);

//appending cuisine type 
$cuisine_type = $_POST['cuisine_type'];
foreach($_POST['cuisine_type'] as $selected){
    array_push($keywords, $selected);
}

$keywords_bool = "";
for ($i = 0; $i < sizeof($keywords); $i++){
    $keywords_bool.= "(";
    $keywords_bool .= $keywords[$i];
    $keywords_bool.= ")";
    if ($i< sizeof($keywords)-1){
        $keywords_bool .= "OR";
    }
}

//getting user location
$user_curr_latitude = $_POST["user_curr_latitude"];
$user_curr_longitude = $_POST["user_curr_longitude"];

$price_level = $_POST["price_level"];
$min_price = 0;
$max_price = 4;

if(!empty($price_level)){
    $min_price = $price_level[0];
    $max_price = $price_level[sizeof($price_level)-1];
}
$min_price = intval($min_price);
$max_price = intval($max_price);

echo("<script>console.log('keywords are: ".$keywords_bool."');</script>");
echo("<script>console.log('latitude is: ".$user_curr_latitude."');</script>");
echo("<script>console.log('longitude is: ".$user_curr_longitude."');</script>");

// $google_places = new joshtronic\GooglePlaces('AIzaSyDFtzabY5k6-NOC6V1h3b-LjftEvZyW2MY');

// echo $google_places;

// $google_places->location = array($user_curr_latitude, $user_curr_longitude);
// $google_places->radius = 800;
// $google_places->rankby   = 'distance';
// $google_places->types    = 'restaurant'; // Requires keyword, name or types

// $results = $google_places->nearbySearch();

// echo $results;

$name = "";    
$url = "https://maps.googleapis.com/maps/api/place/search/json?name=".urlencode($name)."&location=".$user_curr_latitude.",".$user_curr_longitude."&rankby=distance&type=restaurant&keyword=".$keywords_bool."&minprice=".$min_price."&maxprice=".$max_price."&key=AIzaSyDFtzabY5k6-NOC6V1h3b-LjftEvZyW2MY";
            $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $response = curl_exec($ch);
          curl_close($ch);
//echo $response;
//echo json_decode(Foo::jsonToDebug($response), true);
// print_r(Foo::jsonToDebug($response));

$searched = Foo::jsonToDebug($response);
echo "Search results: <br><br>";
for ($i = 0; $i < count($searched); $i++) {
    echo "Name: ".$searched[$i][0]."<br>";
    echo "Location: ".$searched[$i][1]."<br>";
    echo "Price Level: ".$searched[$i][2]."<br>";
    echo "Rating: ".$searched[$i][3]."<br><br>";
}

?>

<form action="/search.php" method="post">
    <input type="hidden" name="email" value="<?php echo $_POST["email"];?>">
    <input type="submit" name="go_back" value="Go Back">
</form>

</div>

<div class="copyright">Copyright &copy; Yimmy 2018</div>
</div>
</div>
</div>
</footer>
<!-- jQuery --><script src="js/jquery.js"></script><!-- Bootstrap Core JavaScript --><script src="js/bootstrap.min.js"></script><script type="application/ld+json">
    {
      "@context" : "http://schema.org",
      "@type" : "Organization",

      
      "name" : "Yimmy",

      
      "url" : "http:\/\/yimmplayground.web.illinois.edu",
    }
</script>
</div>
</body>
</html>