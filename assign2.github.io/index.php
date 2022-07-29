<!DOCTYPE html>
<html>
<?php
include (".".DIRECTORY_SEPARATOR."include".DIRECTORY_SEPARATOR."header.php");
require_once("dbCon.php");
?>
<link href="style.css" rel="stylesheet"/>
<body>

<h2 id= "indtitle" style="text-align: center;">My Friend Application </h2>
<h2 id = "indtitle"style="text-align: center;">Assignment Home Page</h2>
<br>

<p>Name:&nbsp Thanh Ngo Cong &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Student ID: 103433609</p>
<p>Email: <a href="" style="color:blue;">103433609@student.swin.edu.au</a></p>
<br>    
<p>I declare that this assignment is my individual work. I have not worked collaboratively nor <br>
have I copied from any other student's work or from any source.</p>

<?php
session_start();
if(isset($_SESSION)){
    session_unset();
    session_destroy();
}

$db_con = new dbCon();
$Conn = $db_con->getNewConn();

//Drop tables to test below syntax 
// $query = "DROP TABLES friends, myfriends";
// $result_3 = @mysqli_query($db_con->getNewConn(), $query);

$query = "SHOW TABLES LIKE '%friends'";
$result = @mysqli_query($Conn, $query);

if(@mysqli_num_rows($result) != 0){
    echo "<p>Tables already exist<p>";
}
else{
if($db_con->initDB()){
    echo "<p>Tables successfully created and populated.</p>";
}else{ echo"<p>Something has gone wrong when creating tables.</p>"; }
}

$db_con->closeCon();
?>
</body>
<footer>
    <p style="text-align:center; color:blue;"><a href="login.php">Login</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href = "signup.php">Sign Up</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="about.php">About</a></p>
</footer>

</html>
