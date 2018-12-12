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
Your Meal Plans:<br>
    
    
<?php

$link = mysqli_connect('127.0.0.1', 'yimmplayground_ijruiz2', 'yimmypassword', 'yimmplayground_first_database');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$email = $_POST["email"];

$sql = "SELECT *
        FROM MealPlan as mp JOIN FoodItems as fi ON mp.meal_id = fi.meal_id
        WHERE mp.email = '$email'";
        
if ($result = mysqli_query($link, $sql)) 
{ 
   if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $mealid = -1;
        $all_foods = array(0,0,0,0);
        while($row = mysqli_fetch_assoc($result)) {
            if ($mealid != $row["meal_id"]) {
                echo "<br>Here is your past plan for the week of ".$row["date"]."<br>";
                echo "Day 1: ".$row["day1"]."<br>";
                echo "Day 2: ".$row["day2"]."<br>";
                echo "Day 3: ".$row["day3"]."<br>";
                echo "Day 4: ".$row["day4"]."<br>";
                echo "Day 5: ".$row["day5"]."<br>";
                echo "Day 6: ".$row["day6"]."<br>";
                echo "Day 7: ".$row["day7"]."<br><br>";
                $count = 1;
                $mealid = $row["meal_id"];
            }
            
            $calories = $row["carbs"]*4 + $row["fat"]*9 + $row["proteins"]*4;
            
            $all_foods[0] += $calories;
            $all_foods[1] += $row["carbs"]*4;
            $all_foods[2] += $row["fat"]*9;
            $all_foods[3] += $row["proteins"]*4;
            
            echo $row["restaurant"]." - ".$row["fooditem"]."<br>";
            echo "calories: ".$row["calories"]."<br>";
            echo "carbs: ".$row["carbs"]."<br>";
            echo "fat: ".$row["fat"]."<br>";
            echo "protein: ".$row["proteins"]."<br>";
            // $result = shell_exec('piechart.py', $row["restaurant"]." - ".$row["fooditem"], $row["restaurant"], $row["calories"],$row["carbs"],$row["fat"], $row["proteins"]);
            //   $food_nutrition = array(
            //     "fooditem" => $row["fooditem"],
            //     "calories" => $row["calories"],
            //     "carbs" => $row["carbs"],
            //     "fat" => $row["fat"],
            //     "protein" => $row["proteins"],
            // ); 
           
            // print_r($food_nutrition);
            // $food_nutrition = array($row["fooditem"],$row["calories"],$row["carbs"],$row["fat"],$row["proteins"]); 
            // print_r($food_nutrition);
        }
        // echo "all cal".$all_foods[0];
        // echo "allcarb".$all_foods[1];
        // echo "all fat ".$all_foods[2];
        // echo "all protein".$all_foods[3];
    } 

    else {
        echo "You have not created a meal plan yet";
    }
} 

else
{ 
    echo "ERROR: Could not able to execute $sql. "
        .mysqli_error($link); 
}

mysqli_close($link); 
?> 

<p id = "fooditem"> Macronutrient Breakdown: </p> 

<canvas id="piechart" width="400" height="400"> </canvas>

    <script type = "text/javascript"> 
        var nutrition = <?php echo json_encode($all_foods); ?>;

        var carbs = Math.round((nutrition[1]/nutrition[0])*100).toString();
        var fat = Math.round((nutrition[2]/nutrition[0])*100).toString();
        var proteins = Math.round((nutrition[3]/nutrition[0])*100).toString();
        var labels = ["carbs, "+carbs+"%", "fat ," + fat+"%", "proteins, " +proteins+"%"];
        
        var colors = ["#FFDAB9", "#E6E6FA", "#E0FFFF"];
    

           var data = [nutrition[1]/nutrition[0]*360, nutrition[2]/nutrition[0]*360, nutrition[3]/nutrition[0]*360];
      //  document.getElementById("fooditem2").innerHTML = jarray[1];

        function drawSegment(canvas, context, i) {
            context.save();
            var centerX = Math.floor(canvas.width / 2);
            var centerY = Math.floor(canvas.height / 2);
            radius = Math.floor(canvas.width / 2);
        
            var startingAngle = degreesToRadians(sumTo(data, i));
            var arcSize = degreesToRadians(data[i]);
            var endingAngle = startingAngle + arcSize;
        
            context.beginPath();
            context.moveTo(centerX, centerY);
            context.arc(centerX, centerY, radius, 
                        startingAngle, endingAngle, false);
            context.closePath();
        
            context.fillStyle = colors[i];
            context.fill();
        
            context.restore();
        
            drawSegmentLabel(canvas, context, i);
        }
        
        function degreesToRadians(degrees) {
            return (degrees * Math.PI)/180;
        }
        
        function sumTo(a, i) {
            var sum = 0;
            for (var j = 0; j < i; j++) {
              sum += a[j];
            }
            return sum;
        }
        
        function drawSegmentLabel(canvas, context, i) {
           context.save();
           var x = Math.floor(canvas.width / 2);
           var y = Math.floor(canvas.height / 2);
           var angle = degreesToRadians(sumTo(data, i));
        
           context.translate(x, y);
           context.rotate(angle);
           var dx = Math.floor(canvas.width * 0.5) - 10;
           var dy = Math.floor(canvas.height * 0.05);
        
           context.textAlign = "right";
           var fontSize = Math.floor(canvas.height / 25);
           context.font = fontSize + "pt Helvetica";
        
           context.fillText(labels[i], dx, dy);
        
           context.restore();
        }
        
        canvas = document.getElementById("piechart");
        var context = canvas.getContext("2d");
        for (var i = 0; i < data.length; i++) {
            drawSegment(canvas, context, i);
        }
    </script>
    

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