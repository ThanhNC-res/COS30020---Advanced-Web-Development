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
        $query = "SELECT member_id, fname, lname FROM vipmembers";
        $result = @mysqli_query($conn, $query);
        if(!$result ){
            echo "Query wrong. ". "Error: ".mysqli_error($conn);
        } 
        else{
            echo "<table border = \"1\">\n";
            echo "<tr>\n"
                ."<th>Member ID</th>\n"
                ."<th>First Name</th>\n"
                ."<th>Last Name</th>\n"
                ."</tr>";

            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>\n";
                echo "<td>",htmlspecialchars($row['member_id']),"</td>\n";
                echo "<td>",htmlspecialchars($row['fname']),"</td>\n";
                echo "<td>",htmlspecialchars($row['lname']),"</td>\n";
                echo "</tr>\n";
            }
            echo "</table>\n";
            mysqli_free_result($result);
        }
        mysqli_close($conn);
    }
?> 
</body> 
<br/><br>
<button onclick="location.href='vip_member.php'">Home Page</button><br><br>
<input type="button" onclick="location.href = 'member_add_form.php'" value="Add Member"><br><br>
<input type="button" onclick="location.href = 'member_search.php'" value="Search Member"><br>

</html> 