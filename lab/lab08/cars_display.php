<!DOCTYPE html> 
<html lang="en"> 
<head> 
  <meta charset="utf-8" /> 
  <meta name="description" content="Web application development" /> 
  <meta name="keywords" content="PHP" /> 
  <meta name="author"   content="Your Name" /> 
  <title>TITLE</title> 
</head> 
<body> 
<h1>Web Programming - Lab08</h1> 
<?php  
    require_once ("settings.php");
    $conn = @mysqli_connect($host,$user, $pswd, $dbnm);
    if(!$conn){
        echo "Cannot connect into the database. ".mysqli_connect_error() ;
    }
    else{
        $query = "SELECT car_id, make, model, price FROM cars";
        $result = @mysqli_query($conn, $query);
        if(!$result ){
            echo "Query wrong. ". "Error: ".mysqli_error($conn);
        } 
        else{
            echo "<table border = \"1\">\n";
            echo "<tr>\n"
                ."<th>Cars_ID</th>\n"
                ."<th>Make</th>\n"
                ."<th>Model</th>\n"
                ."<th>Price</th>\n"
                ."</tr>";

            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>\n";
                echo "<td>",htmlspecialchars($row['car_id']),"</td>\n";
                echo "<td>",htmlspecialchars($row['make']),"</td>\n";
                echo "<td>",htmlspecialchars($row['model']),"</td>\n";
                echo "<td>",htmlspecialchars($row['price']),"</td>\n";
                
                echo "</tr>\n";
            }
            echo "</table>\n";
            mysqli_free_result($result);
        }
        mysqli_close($conn);
    }
?> 
</body> 
</html> 