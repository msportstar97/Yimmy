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
    <div>
<?php
$link = mysqli_connect('127.0.0.1', 'yimmplayground_ijruiz2', 'yimmypassword', 'yimmplayground_first_database');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$email = $_POST["email"];
$password = $_POST["pass_edit"];
$age = $_POST["age_edit"];
$weight = $_POST["weight_edit"];
$height = $_POST["height_edit"];
$calories = $_POST["cal_edit"];

$age_edit = false;
$height_edit = false;
$weight_edit = false;

echo("<script>console.log('gender successfully retrieved');</script>");


$gender = "female";
$sql = "SELECT gender, weight, height, age
        FROM User 
        WHERE '$email' = email";
if ($result = mysqli_query($link, $sql)) 
{   
    $row = mysqli_fetch_assoc($result);
    echo("<script>console.log('gender successfully retrieved');</script>");
    $gender = $row["gender"];
    $old_weight = $row["weight"];
    $old_height = $row["height"];
    $old_age = $row["age"];
} 
else
{ 
    echo "ERROR: Could not execute $sql. "
        .mysqli_error($link); 
} 


if ($password != "") {
    $sql = "UPDATE User u
            SET u.password = '$password'
            WHERE '$email' = u.email";
    if ($result = mysqli_query($link, $sql)) 
    { 
        echo("<script>console.log('password updated successfully');</script>");
        echo 'Password successfully updated', '<br>';
    } 
    else
    { 
        echo "ERROR: Could not able to execute $sql. "
            .mysqli_error($link); 
    } 
}
if ($age != "") {
    $age_edit = true;
    $sql = "UPDATE User u
            SET u.age = '$age'
            WHERE '$email' = u.email";
    if ($result = mysqli_query($link, $sql)) 
    { 
        echo("<script>console.log('age updated successfully');</script>");
        echo 'Age successfully updated to ',$age,'<br>';
    } 
    else
    { 
        echo "ERROR: Could not able to execute $sql. "
            .mysqli_error($link); 
    } 
}
if ($weight != "") {
    $weight_edit = true;
    $sql = "UPDATE User u
            SET u.weight = '$weight'
            WHERE '$email' = u.email";
    if ($result = mysqli_query($link, $sql)) 
    { 
        echo("<script>console.log('weight updated successfully');</script>");
        echo 'Weight successfully updated to ',$weight,'<br>';
    } 
    else
    { 
        echo "ERROR: Could not able to execute $sql. "
            .mysqli_error($link); 
    } 
}
if ($height != "") {
    $height_edit = true;
    $sql = "UPDATE User u
            SET u.height = '$height'
            WHERE '$email' = u.email";
    if ($result = mysqli_query($link, $sql)) 
    { 
        echo("<script>console.log('height updated successfully');</script>");
        echo 'Height succesfully updated to ',$height,'<br>';
    } 
    else
    { 
        echo "ERROR: Could not able to execute $sql. "
            .mysqli_error($link); 
    } 
}
if ($age_edit || $height_edit || $weight_edit) {
    
    if (!$age_edit) {
        $age = $old_age;
    }
    
    if (!$height_edit) {
        $height = $old_height;
    }
    
    if (!$weight_edit) {
        $weight = $old_weight;
    }
    
    if ($gender == "male") 
    {
        $calories = 1.55* ((10 * $weight) + (6.5 * $height) - (5 * $age) +5);
    } 
    else 
    {
        $calories = 1.55* ((10 * $weight) + (6.5 * $height) - (5 * $age) - 161);
    }
    
    $sql = "UPDATE User u
            SET u.calorie = '$calories'
            WHERE '$email' = u.email";
    if ($result = mysqli_query($link, $sql)) 
    { 
        echo("<script>console.log('calories updated successfully');</script>");
        echo 'Calories succesfully updated to ',$calories,'<br>';
    } 
    else
    { 
        echo "ERROR: Could not able to execute $sql. "
            .mysqli_error($link); 
    } 
}

mysqli_close($link); 
?> 
    </div>
    <form action="/preferences.php" method="post">
        <input type="hidden" name="email" value="<?php echo $_POST["email"];?>">
        <input type="submit" name="go_pref" value="Go Back">
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

