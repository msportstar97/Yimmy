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
                    $html = self::_arrayToHtmlTableRecursive($val, $html);
                }
            } else {
                if ($key == "name" && $key != "0") {
                    array_push($html, $val);
                }
            }
        }
        return $html;
    }

    public static function nutritionixJsonPrint($jsonText = '', $restaurant)
    {
        $arr = json_decode($jsonText, true);
        $html = "";
        $html = array();
        if ($arr && is_array($arr)) {
            $html = self::nutritionixToArray($arr, $restaurant, $html);
        }
        return $html;
    }

    private static function nutritionixToArray($arr, $restaurant, $html) {
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                if (!empty($val)) {
                    if ($key == "fields") {
                        if (strcasecmp($val["brand_name"], $restaurant) != 0) {
                            continue;
                        } else {
                            $array = array($val["brand_name"], $val["item_name"], $val["nf_calories"], $val["nf_total_carbohydrate"], $val["nf_total_fat"], $val["nf_protein"]);
                            array_push($html, $array);
                        }
                    } else {
                        $html = self::nutritionixToArray($val, $restaurant, $html);
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
// echo json_decode(Foo::jsonToDebug($response), true);
// print_r(Foo::jsonToDebug($response));
$arr = Foo::jsonToDebug($response);

$link = mysqli_connect('127.0.0.1', 'yimmplayground_ijruiz2', 'yimmypassword', 'yimmplayground_first_database');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}


// $appId = "aca4d733";
// $appKey = "a16689b796452ddfe3a66285af76309a";

// //miraal
// $appId = "b8e0cddc";
// $appKey = "275547bfc7ca03342fe1ecf3f8c7d886";

//last one
$appId  = "60d34131";
$appKey = "cb17d39949676e9a07e7f1e364c86f51";
$email = $_POST["email"];
$date=time();
$date = date("Y-m-d",$date);

$count = 0;
$total = 0;
$foods = Array();
$countdata = 0;

$sql = "SELECT MAX(meal_id) as total
        FROM MealPlan";

if ($result = mysqli_query($link, $sql)) {
    $data = mysqli_fetch_assoc($result);
    $countdata = $data['total'];
}

$countdata = $countdata + 1;

while ($count < 7 && $total < count($arr)) {
    $name = preg_replace('/\s+/', '%20', $arr[$total]);
    $url = "https://api.nutritionix.com/v1_1/search/".$name."?results=0%3A50&cal_min=0&cal_max=50000&fields=item_name%2Cbrand_name%2Cnf_calories%2Cnf_total_fat%2Cnf_protein%2Cnf_total_carbohydrate&appId=".$appId."&appKey=".$appKey;
               $ch = curl_init();
               curl_setopt($ch, CURLOPT_URL, $url);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
               curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
               curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
               curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
               $response = curl_exec($ch);
               curl_close($ch);
    $foodarr = Foo::nutritionixJsonPrint($response, $arr[$total]);
    if (!empty($foodarr)) {
        $count += 1;

        $sql = "SELECT calorie
                FROM User
                WHERE User.email = $email";
                
        $cal = 0;
        if ($result = mysqli_query($link, $sql)) {
            $data = mysqli_fetch_assoc($result);
            $cal = $data['calorie'];
        }
        
        $cal = $cal/2;
        
        $x = 0;
        $trackcount = 0;
        shuffle($foodarr);
        for ($i = 0; $i < count($foodarr) && $x < 2; $i++) {
            $temparr = $foodarr[$i];
            if ($temparr[3] < 50 || $temparr[3] > ($cal + 100)) {
                continue;
            }
            $x = $x + 1;
            $sql = "INSERT INTO FoodItems (meal_id, restaurant, fooditem, calories, carbs, fat, proteins)
                VALUES ('$countdata', '$temparr[0]', '$temparr[1]', '$temparr[2]', '$temparr[3]', '$temparr[4]', '$temparr[5]')";
            if ($result = mysqli_query($link, $sql)) {
                if ($trackcount == 0) {
                    array_push($foods, $temparr[0]);
                    $trackcount += 1;
                }
                echo("<script>console.log('fooditems success');</script>");
            }
        }
    }
    $total += 1;
}

if (count($foods) == 7) {
     $sql = "INSERT INTO MealPlan (meal_id, email, date, day1, day2, day3, day4, day5, day6, day7)
    VALUES ('$countdata', '$email', '$date', '$foods[0]', '$foods[1]', '$foods[2]', '$foods[3]', '$foods[4]', '$foods[5]', '$foods[6]')";
    if ($result = mysqli_query($link, $sql)) {
        echo("<script>console.log('mealplan success');</script>");
    }
} else {
    $rand0 = rand(0,count($foods)-1);
    $rand1 = rand(0,count($foods)-1);
    $rand2 = rand(0,count($foods)-1);
    $rand3 = rand(0,count($foods)-1);
    $rand4 = rand(0,count($foods)-1);
    $rand5 = rand(0,count($foods)-1);
    $rand6 = rand(0,count($foods)-1);
    
    $sql = "INSERT INTO MealPlan (meal_id, email, date, day1, day2, day3, day4, day5, day6, day7)
    VALUES ('$countdata', '$email', '$date', '$foods[$rand0]', '$foods[$rand1]', '$foods[$rand2]', '$foods[$rand3]', '$foods[$rand4]', '$foods[$rand5]', '$foods[$rand6]')";
    if ($result = mysqli_query($link, $sql)) {
        echo("<script>console.log('mealplan success');</script>");
    }
}

$sql = "SELECT day1, day2, day3, day4, day5, day6, day7
        FROM MealPlan
        WHERE MealPlan.email = '$email' AND MealPlan.meal_id = '$countdata'";

$week = Array();
if ($result = mysqli_query($link, $sql)) 
{ 
    $row = mysqli_fetch_assoc($result);
    array_push($week, Array($row["day1"], $row["day2"], $row["day3"], $row["day4"], $row["day5"], $row["day6"], $row["day7"]));
}  else {
    echo "ERROR: Could not able to execute $sql. "
    .mysqli_error($link); 
}

for ($i = 0; $i < count($week[0]); $i++) {
    echo "We recommend you to eat here for day " .($i+1). ": ";
    echo $week[0][$i];
    echo "<br>";
    echo "We recommend you eat these fooditems from the place: ";
    echo "<br>";
    $restName = $week[0][$i];
    $sql = "SELECT fooditem, calories
            FROM FoodItems
            WHERE FoodItems.meal_id = '$countdata' AND FoodItems.restaurant = '$restName'";
            
    if ($result = mysqli_query($link, $sql)) {
        while($row = mysqli_fetch_assoc($result)) {
            echo $row["fooditem"]." - ".$row["calories"]." calories";
            echo "<br>";
        }
        echo "<br>";
    } else {
        echo "ERROR: Could not able to execute $sql. "
        .mysqli_error($link); 
    }
    
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