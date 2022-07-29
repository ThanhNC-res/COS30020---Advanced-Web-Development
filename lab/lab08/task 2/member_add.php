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
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once ("settings.php");

$conn = @mysqli_connect($host, $user, $pswd, $dbnm );
$fname = "";
$lname = "";
$gender = "";
$email = "";
$phone = "";
$table = "vipmembers";

if(isset($_POST)){
if(!empty($_POST)){

    if(isset($_POST['fname']) && trim($_POST['fname']) != ''){
        $fname = $_POST['fname'];
    }else{echo "Please Enter Your First Name <br>";
        exit("Turn back to search form by Return button");}

    if(isset($_POST['lname']) && trim($_POST['lname']) != ''){
        $lname = $_POST['lname'];
    }else{echo "Please Enter Your Last Name <br>";
        exit("Turn back to search form by Return button");}

    if(isset($_POST['gender']) && trim($_POST['gender']) != ''){
        $gender = $_POST['gender'];
    }else{echo "Please choose your gender <br>";
        exit("Turn back to search form by Return button");}

    if(isset($_POST['email']) && trim($_POST['email']) != ''){
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo "<p>ERROR: Invalid email format</p>";
            exit("Turn back to search form by Return button");
        }
        else{
            $email = $_POST['email'];
        }
    }
    else{echo "Please Enter Your Email <br>";}

    if(isset($_POST['phone']) && trim($_POST['phone']) != ''){
        $phone = $_POST['phone'];
    }else{echo "Please Enter Your Phone Number <br>";
        exit("Turn back to search form by Return button");}


    validateFormat($fname, $lname, $phone);

    if(!$conn){
        echo "Cannot connect into the database. ".mysqli_connect_error() ;
    }
    else{
        $query = "SHOW TABLES LIKE '$table'";
        $result1 = mysqli_query($conn, $query);
        if(mysqli_num_rows($result1) == 0){
            $query = "CREATE TABLE $table (member_id int NOT NULL AUTO_INCREMENT,fname VARCHAR(40),lname VARCHAR(40),gender VARCHAR(1),email VARCHAR(40),phone VARCHAR(20),PRIMARY KEY(member_id))";
            $result2 = mysqli_query($conn, $query);
            echo "<p>Create table successfully</p>";

            $query = "INSERT INTO $table(fname, lname, gender, email ,phone) VALUES ('$fname', '$lname', '$gender', '$email', '$phone')";
            $result3 = @mysqli_query($conn, $query);
            echo "<p>New vip member added successfully </p>";
        }
        else if(mysqli_num_rows($result1) != 0){
        $query = "SELECT fname, lname, email, phone FROM vipmembers";
        $result4 = @mysqli_query($conn, $query);
        while($rows = @mysqli_fetch_assoc($result4)){
            if($fname == $rows['fname'] && $lname == $rows['lname']){
                echo "<p>Duplicate Member Name</p>";
                exit("Turn back to search form by Return button");
            }
            else if($email == htmlspecialchars($rows['email'])){
                echo "<p>This email have been used</p>";
                exit("Turn back to search form by Return button");
            }
            else if ($phone == $rows['phone']){
                echo "<p>This phone number has been used</p>";
                exit("Turn back to search form by Return button");
            }
        }
        $query = "INSERT INTO $table(fname, lname, gender, email ,phone) VALUES ('$fname', '$lname', '$gender', '$email', '$phone')";
        $result3 = @mysqli_query($conn, $query);
        echo "<p>New vip member added successfully </p>";
        }
    }
    }

    mysqli_close($conn);
}

function validateFormat($fname, $lname, $phone){
if($fname = ""){
    echo "<p>ERROR: Empty first name field</p>";
    exit("Turn back to search form by Return button");
}else if(!preg_match("/^[a-zA-Z]*$/", $fname)){
    echo "<p>ERROR: First Name can only contains alphabet characters.</P>";
    exit("Turn back to search form by Return button");
}

if($lname = ""){
    echo "<p>ERROR: Empty last name field</p>";
    exit("Turn back to search form by Return button");
}else if(!preg_match("/^[a-zA-Z]*$/", $lname)){
    echo "<p>ERROR: Last Name can only contains alphabet characters.</P>";
    exit("Turn back to search form by Return button");
}
if($phone = ""){
    echo "<p>ERROR: Empty phone field</p>";
    exit("Turn back to search form by Return button");
}else if (!preg_match("/^[0-9]*$/", $phone)) {
    echo "<p>ERROR: Phone can only contains number</p>";
    exit("Turn back to search form by Return button");
}
}

?>
<br/><br>
<button onclick="location.href='member_add_form.php'">Add More Member</button><br><br>
<input type="button" onclick="location.href = 'member_display.php'" value="Show Member"><br><br>
<input type="button" onclick="location.href = 'member_search.php'" value="Search Member"><br>
</body>
</html>