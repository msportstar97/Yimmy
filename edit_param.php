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
    
    Enter the fields you want to update <br>
    <?php echo $_POST["email"],'<br>'; ?> <br>
    
    <form action="/edit.php" method = "post">
        <input type="hidden" name="email" value="<?php echo $_POST["email"];?>">
        Password:<br>
        <input type="password" name="pass_edit" value="">
        <br>
        Age:<br>
        <input type="number" name="age_edit" min="0" value="">
        <br>
        Weight (kg):<br>
        <input type="number" name="weight_edit" min="0" value="">
        <br>
        Height (cm):<br>
        <input type="number" name="height_edit" min="0" value="">
        <br>
        <!--Daily calorie limit:<br>-->
        <!--<input type="number" name="cal_edit" min="0" value="">-->
        <!--<br>-->
        <br><br>
        <input type="hidden" name="email" value="<?php echo $_POST["email"];?>">
        <input type="submit" name="submit_change" value="Submit">
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
