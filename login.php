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
    
    <style> 
    .imageContainer{
       width:80%; 
       height:300px; 
       background-image: url(https://img.huffingtonpost.com/asset/585be1aa1600002400bdf2a6.jpeg?ops=scalefit_970_noupscale);
       opacity: 0.75 ;
       
       margin:auto;
       
       color:white;
       text-shadow: 2px 4px 3px rgba(0,0,0,0.3);
       text-align: center;
       font-size: 50px;
       font-family: Arial;
       
       padding: 70px 0;
       padding-bottom: 25px;
    }
    
    </style>
</head>
<body>
<div class="brand">Yimmy</div>

<div class="container">
<div class="row">
<div class="box">
<div class="col-lg-12 text-center">
          
          <div class="imageContainer">
              Welcome<br>
              <?php echo $_POST["email"];?> 
          </div>
        
        <!Buttons>
        
        <br><br>
        
        <form action="edit_param.php" method="POST">
        <input type="hidden" name="email" value="<?php echo $_POST["email"];?>">
        <input type="submit" style="margin-bottom:10px" name="edit" value="Edit Preferences"/>
        </form>
        
        <form action="delete.php" method="POST">
        <input type="hidden" name="email" value="<?php echo $_POST["email"];?>">
        <input type="submit" style="margin-bottom:10px" name="delete" value="Delete Account"/>
        </form>  
        <form action="search.php" method="POST">   
        <input type="hidden" name="email" value="<?php echo $_POST["email"];?>">
        <input type="submit" style="margin-bottom:10px" name="search" value="Search"/>
        </form>
        <form action="view_plan.php" method="POST">     
        <input type="hidden" name="email" value="<?php echo $_POST["email"];?>">
        <input type="submit" style="margin-bottom:10px" name="view_plan" value="View All Meal Plans"/>
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

<?php
$link = mysqli_connect('127.0.0.1', 'yimmplayground_ijruiz2', 'yimmypassword', 'yimmplayground_first_database');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$email = $_POST["email"];
$password = $_POST["password"];
echo("<script>console.log('email is: ".$email."');</script>");
echo("<script>console.log('password is: ".$password."');</script>");

?>