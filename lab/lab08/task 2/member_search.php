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
<h1>Web Programming Form - Lab8</h1> 
<form method = "post" action=""> 
   <label>Enter Your Last Name: </label>
   <input type="text" name="string">
    <input type="submit" value="Enter">
</form> 
<br>
<br>
<?php
require_once ("settings.php");
$lname = "";
$conn = @mysqli_connect($host, $user, $pswd, $dbnm);
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
if (isset ($_POST["string"]) && trim($_POST["string"]) != ''){ 
    $lname = $_POST['string'];
    if(!$conn){
        echo "Cannot connect into the database. ".mysqli_connect_error() ;
    }
    else{
        $query = "SELECT member_id, fname, lname, email FROM vipmembers WHERE lname LIKE '%$lname%'";
        $result = @mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 0){
            echo "<p>No member have that last name</p>";
        }
        else{
            echo "<table border = \"1\">\n";
            echo "<tr>\n"
                ."<th>Member ID</th>\n"
                ."<th>First Name</th>\n"
                ."<th>Last Name</th>\n"
                ."<th>Email</th>\n"
                ."</tr>";

            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>\n";
                echo "<td>",htmlspecialchars($row['member_id']),"</td>\n";
                echo "<td>",htmlspecialchars($row['fname']),"</td>\n";
                echo "<td>",htmlspecialchars($row['lname']),"</td>\n";
                echo "<td>",htmlspecialchars($row['email']),"</td>\n";
                echo "</tr>\n";
            }
            echo "</table>\n";
            mysqli_free_result($result);
        }
        
    }
mysqli_close($conn);
    
} else {      
    echo "<p>Please enter last name you want to search.</p>"; 
} 
}
?>
</body> 
<footer>
<br><br>
<button onclick="location.href='vip_member.php'">Home Page</button><br><br>
<input type="button" onclick="location.href = 'member_add_form.php'" value="Add Member"><br><br>
<input type="button" onclick="location.href = 'member_display.php'" value="Show Member"><br><br>
</footer>
</html> 