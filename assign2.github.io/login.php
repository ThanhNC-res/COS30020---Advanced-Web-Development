<!DOCTYPE html>
<html>
<?php
include (".".DIRECTORY_SEPARATOR."include".DIRECTORY_SEPARATOR."header.php");

require_once(".".DIRECTORY_SEPARATOR."settings".DIRECTORY_SEPARATOR."settings.php");
require_once("account.php");

$interval = 60 * 60 * 24 * 62;
session_set_cookie_params($interval);
session_start();
if(isset($_SESSION)){
  session_unset();
}
$errorMsg = array('email' => '', 'pwrd' => '');
$Code = "";
$email = "";
$pwrd = "";

$conn = @mysqli_connect($host, $user, $pswd, $dbnm);
if(!$conn){
    die("Cannot connect to the database server. ". mysqli_connect_error());
  }
  else{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

        if(!filter_var(htmlspecialchars($_POST['email']), FILTER_VALIDATE_EMAIL)){
            $errorMsg['email'] = '*Email does not exist';
            $Code = 1;
        }

        if(!preg_match ("/^[a-zA-Z0-9]/", $_POST['pwrd']) || strpos($pwrd, " ") != ''){
            $errorMsg['pwrd'] = "*The password you have typed in is incorrect.";
            $Code = 1;
        }

        $email = htmlspecialchars($_POST['email']);
        $pwrd = $_POST['pwrd'];

        if($Code != 1){
        $query = "SELECT friend_email, password FROM friends WHERE friend_email = '$email' AND password = '$pwrd'";
        $result = @mysqli_query($conn, $query);


        if(mysqli_num_rows($result) == 1){
            $Code = 2;
        }
        else if(mysqli_num_rows($result) != 1){
            $query = "SELECT friend_email, password FROM friends WHERE friend_email = '$email' OR password ='$pwrd'";
            $result1 = @mysqli_query($conn, $query);

            if(mysqli_num_rows($result1) == 0){
                $errorMsg['email'] = '*Email does not exist';
                $errorMsg['pwrd'] = "*The password you have typed in is incorrect.";
                $Code = 1;
            }
            else{
              while($rows = mysqli_fetch_assoc($result1)){
                  if( $email != htmlspecialchars($rows['friend_email']) && $pwrd == $rows['password']){
                      $errorMsg['email'] = '*Email does not exist';
                      $Code = 1;
                  }
                  if($pwrd != $rows['password'] && $email == htmlspecialchars($rows['friend_email'])){
                      $errorMsg['pwrd'] = "*The password you have typed in is incorrect.";
                      $Code = 1;
                  }
              }
            }
        }
        }   

        if($Code == 2){
          if(!isset($_SESSION["id"]) && !isset($_SESSION["email"])){
            $query = "SELECT friend_id, friend_email from friends WHERE friend_email = '$email'";
            $result_2 = @mysqli_query($conn, $query);

            while($rows = @mysqli_fetch_assoc($result_2)){
              $_SESSION["id"] = $rows["friend_id"];
              $_SESSION["email"] = htmlspecialchars($rows["friend_email"]);
            }

          }
          
          header('Location: friendlist.php') ;
        }
    }
  }
mysqli_close($conn);
?>
<body>

<form action="" style="border:30px solid #ccc" method="POST">
  <div class="container">
    <h1>My Friend System</h1>
    <h3>Log In Page</h3>
    <hr>
    <label for="email"><b>Email</b></label><div class="red-text" style="margin-top: 10px; margin-bottom: 5px;"><?php echo '<span style="color:red; font-size:small">' . $errorMsg['email'] . '</span>'; ?></div>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="pwrd"><b>Password</b></label><div class="red-text" style="margin-top: 10px; margin-bottom: 5px;"><?php echo '<span style="color:red; font-size:small">' . $errorMsg['pwrd'] . '</span>'; ?></div>
    <input type="password" placeholder="Enter Password" name="pwrd" required>

    
    <label>
      <input type="checkbox" checked="checked" name="remember" value="on" style="margin-bottom:15px"> Remember me
    </label> 
    

    <div class="clearfix">
      <button type="reset" class="cancelbtn">Clear</button>
      <button type="submit" class="signupbtn">Sign In</button>
    </div>

    <p>Don't have an account? Go to <a href="signup.php" style="color:dodgerblue">Sign up page</a></p>
    <p><a href="index.php" style="color:dodgerblue">Home Page</a></p>
  </div>
</form>
<?php

?>
</body>
</html>
