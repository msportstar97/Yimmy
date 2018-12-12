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
    $link = mysqli_connect('127.0.0.1', 'yimmplayground_ijruiz2', 'yimmypassword', 'yimmplayground_first_database');
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }
    
    $email = $_POST["email"];
    
    $sql = "DELETE FROM User
            WHERE '$email' = email";
               
    if (mysqli_query($link, $sql)) 
    { 
    } 
    else
    { 
        echo "ERROR: Could not able to execute $sql. "
            .mysqli_error($link); 
    } 
            
    $sql = "SELECT meal_id
            FROM MealPlan
            WHERE MealPlan.email = '$email'";
    
    $mealids = Array();
    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($mealids, $row["meal_id"]);
        }
    }
    
    print_r($mealids);
    
    for ($i = 0; $i < count($mealids[0]); $i++) {
        $tempid = $mealids[0][$i];
        $sql = "DELETE FROM FoodItems
                WHERE '$tempid' = meal_id";
                   
        if (mysqli_query($link, $sql)) 
        { 
        } 
        else
        { 
            echo "ERROR: Could not able to execute $sql. "
                .mysqli_error($link); 
        } 
    }
    
    $sql = "DELETE FROM MealPlan
            WHERE '$email' = email";
            
    if (mysqli_query($link, $sql)) 
    { 
        echo 'Account succesfully deleted';
    } 
    else
    { 
        echo "ERROR: Could not able to execute $sql. "
            .mysqli_error($link); 
    } 
      
    mysqli_close($link); 
    ?> 
</div>

<div class="col-lg-12 text-center">
    <form action="/index.html">
        <input type="submit" name="go_home" value="Go Back to Home Page">
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

