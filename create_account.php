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

Welcome <?php echo $_POST["email"],'<br>';
    echo 'Here are your settings:<br>';
    echo 'Age: ',$_POST["age"],'<br>';
    echo 'Gender: ',$_POST["gender"],'<br>';
    echo 'Weight: ',$_POST["weight"],'<br>';
    echo 'Height: ',$_POST["height"],'<br>';
    $calories = 0;
    if ($_POST["gender"]=="male") 
    {
        $calories = 1.55* ((10 * $_POST["weight"]) + (6.5 * $_POST["height"]) - (5 * $_POST["age"]) +5);
    } 
    else 
    {
        $calories = 1.55* ((10 * $_POST["weight"]) + (6.5 * $_POST["height"]) - (5 * $_POST["age"]) - 161);
    }

    echo 'Calories: ',round($calories), '<br>';?>
    
<form action="preferences.php" method="POST">    
<input type="hidden" name="email" value="<?php echo $_POST["email"];?>"> 
<input type="submit" name="submit" value="Continue"/></form>
<br>

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

<?php
//include 'call_api.php';


echo("<script>console.log('starting api call');</script>");

/* ZOMATO API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://developers.zomato.com/api/v2.1/search?q=cuisines&start=0&count=50");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$headers = array(
  "Accept: application/json",
  "User-Key: f0baf53bd8c31d3c625e9d9c0d379379"
  );
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
*/

/** GEOLOCATION API **/
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyDFtzabY5k6-NOC6V1h3b-LjftEvZyW2MY");
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
// $headers = array(
//   "Accept: application/json",
//   );
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// $location = curl_exec($ch);
// if (curl_errno($ch)) {
//     echo 'Error:' . curl_error($ch);
// }
// curl_close ($ch);
// echo $location;

// echo("<script>console.log('finished api call');</script>");

// $myJSON = json_decode($result);

// echo("<script>console.log(' api: ".$myJSON."');</script>");
// echo $result;
//echo("<script>console.log(' api: ".$result."');</script>");

// Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }    

//18.220.149.166
$link = mysqli_connect('127.0.0.1', 'yimmplayground_ijruiz2', 'yimmypassword', 'yimmplayground_first_database');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

echo("<script>console.log('got past conenct');</script>");


$email = $_POST["email"];
$password = $_POST["password"];
$age = $_POST["age"];
$gender = $_POST["gender"];
$weight = $_POST["weight"];
$height = $_POST["height"];
$calories = 0;
if ($gender=="male") 
{
    $calories = 1.55* ((10 * $weight) + (6.5 * $height) - (5 * $age) +5);
} 
else 
{
    $calories = 1.55* ((10 * $weight) + (6.5 * $height) - (5 * $age) - 161);
}

// echo 'Your recommended daily calorie intake: '.$calories;

// $servername = "localhost";
// $username = "username";
// $password = "password";
// $dbname = "myDB";

$sql = "INSERT INTO User (email, password, age, gender, weight, height, calorie)
VALUES ('$email', '$password', '$age', '$gender', '$weight', '$height', '$calories')";
echo("<script>console.log('inseted into database');</script>");

echo '<script>console.log("got past insert")</script>';
if (mysqli_query($link, $sql)) 
{ 
    echo("<script>console.log('records inserted successfully');</script>");
} 
else
{ 
    echo "ERROR: Could not able to execute $sql. "
        .mysqli_error($link); 
} 

  
mysqli_close($link); 
?> 