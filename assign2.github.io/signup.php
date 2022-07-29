<!DOCTYPE html>
<html>
<?php
include (".".DIRECTORY_SEPARATOR."include".DIRECTORY_SEPARATOR."header.php");

require_once(".".DIRECTORY_SEPARATOR."settings".DIRECTORY_SEPARATOR."settings.php");
//require_once(".".DIRECTORY_SEPARATOR."settings".DIRECTORY_SEPARATOR."functions.php");

$interval = 60 * 60 * 24 * 60;
session_set_cookie_params($interval);
session_start();
if(isset($_SESSION)){
  session_unset();
}
$errorMsg = array('email' => '', 'profname' => '', 'pwrd' => '' , 'pwrd_conf' => '');
$errorCode = '';

$email = "";
$profname ="";
$pwrd ="";
$pwrd_conf="";
$conn = @mysqli_connect($host, $user, $pswd, $dbnm);
if(!$conn){
  die("Cannot connect to the database server. ". mysqli_connect_error());
}
else{
  if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
  $email = $_POST["email"];
  $profname = $_POST["profname"];
  $pwrd = $_POST["pwrd"];
  $pwrd_conf = $_POST["pwrd-conf"];

//check if input is in correct format
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errorMsg['email'] = '*Invalid Email Format';
    $errorCode = 1;
 }
if(!preg_match ("/^[a-zA-Z\s]+$/", $profname)){
    $errorMsg['profname'] = '*Profile Name can only contain letters.';
    $errorCode = 1;
 }
if(!preg_match ("/^[a-zA-Z0-9]+$/", $pwrd) || strpos($pwrd, ' ') != ''){
    $errorMsg['pwrd'] = "*Password can only contain letter and number.";
    $errorCode = 1;
}
if(!preg_match ("/^[a-zA-Z0-9]+$/", $pwrd_conf) || strpos($pwrd_conf, ' ') != ''){
    $errorMsg['pwrd_conf'] = "*Confirm Password can only contain letter and number.";
    $errorCode = 1;
}

  // validateForm($email, $profname, $pwrd, $pwrd_conf);
  // duplicateForm($email, $profname, $pwrd, $pwrd_conf);
  $query = "SELECT friend_email, profile_name FROM friends";
  $result = @mysqli_query($conn, $query);

  // Check if it has a dulicate value for email and profile name
  if($errorCode != 1){
    while($rows = @mysqli_fetch_assoc($result)){
        if($email == htmlspecialchars($rows['friend_email'])){
            $errorMsg['email'] = '*This email has been used.';
            $errorCode = 2;
        }
        if($profname == htmlspecialchars($rows['profile_name'])){
            $errorMsg['profname'] = '*This name has been used by other users.';
            $errorCode = 2;
        }
        if($pwrd_conf != $pwrd){
            $errorMsg['pwrd'] = '*Confirm password does not match with declared password';
            $errorCode = 2;
        }
    }
    }
    mysqli_free_result($result);
  
    if($errorCode != 1 && $errorCode != 2){
      $query = "INSERT INTO friends(friend_email, profile_name, password, date_started, num_of_friends) VALUES ('$email', '$profname', '$pwrd', CURDATE(), 0)";
      $result1 = @mysqli_query($conn, $query);

      $query = "SELECT friend_id, friend_email FROM friends WHERE friend_email = '$email'";
      $result2 = mysqli_query($conn, $query);
      while($rows = mysqli_fetch_assoc($result2)){
        $_SESSION["id"] = $rows["friend_id"];
        $_SESSION["email"] = htmlspecialchars($rows["friend_email"]);
      }
      
      header('Location: friendlist.php');
    }
     
  }
}

?>
<body>

<form action="" style="border:30px solid #ccc" method="POST">
  <div class="container">
    <h1>My Friend System</h1>
    <h3>Registration Page</h3>
    <hr>
    <label for="email"><b>Email</b></label><div class="red-text" style="margin-top: 10px; margin-bottom: 5px;"><?php echo '<span style="color:red; font-size:small">' . $errorMsg['email'] . '</span>'; ?></div>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="profname"><b>Profile Name</b></label><div class="red-text" style="margin-top: 10px; margin-bottom: 5px;"><?php echo '<span style="color:red; font-size:small">' . $errorMsg['profname'] . '</span>'; ?></div>
    <input type="text" placeholder="Enter Profile Name" name="profname" required>

    <label for="pwrd"><b>Password</b></label><div class="red-text" style="margin-top: 10px; margin-bottom: 5px;"><?php echo '<span style="color:red; font-size:small">' . $errorMsg['pwrd'] . '</span>'; ?></div>
    <input type="password" placeholder="Enter Password" name="pwrd" required>

    <label for="pwrd-conf"><b>Repeat Password</b></label><div class="red-text" style="margin-top: 10px; margin-bottom: 5px;"><?php echo '<span style="color:red; font-size:small">' . $errorMsg['pwrd_conf'] . '</span>'; ?></div>
    <input type="password" placeholder="Repeat Password" name="pwrd-conf" required>
    
    <!-- <label>
      <input type="checkbox" checked="checked" name="remember" value="on" style="margin-bottom:15px"> Remember me
    </label> -->
    

    <div class="clearfix">
      <button type="reset" class="cancelbtn">Clear</button>
      <button type="submit" class="signupbtn">Sign Up</button>
    </div>
    <p> Already have an account? Change to <a href="login.php" style="color:dodgerblue">Login Page'</a>
    <p><a href="index.php" style="color:dodgerblue">Home Page</a></p>
  </div>
</form>
<?php

?>
</body>
</html>
