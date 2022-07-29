<?php
$gnum = "";
$Msg = '';
$interval = 60 * 60;
session_set_cookie_params($interval);
session_start();
if(!isset($_SESSION["gnum"]) && !isset($_SESSION["guesses"])){
$rand = rand(1,100);
$_SESSION["gnum"] = $rand;
$_SESSION["guesses"] = 0;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["gnum"]) && $_POST["gnum"] != ''){
            
            $gnum = $_POST["gnum"];
            if(!preg_match("/^[0-9]*$/", $gnum)){
                $Msg = 'Just number in text box.';
            }
            
            if($gnum == $_SESSION["gnum"]){
                $Msg = 'Congratulation! You guessed the hidden number';
            }else{
                $Msg = 'Sorry! You guessed the wrong number';
                $_SESSION["guesses"] += 1;
            }
        
    }
    else{
            $Msg = 'Please enter a number in the text box';
    }
}


?>

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
<h1>Web Programming - Lab09</h1> 
<h1><b>Guessing Game</b></h1>

<p>Enter a number between 1 and 100, <br>
    then press the Guess button</p>
<form action="" method="post">
<input type="text" name="gnum"><input type="submit" value="Guess">
</form>
<div style="padding: 5px;"><p style="color:green;"><?php echo $Msg;?></p></div>

<div style="padding: 5px;"><p><?php echo "Number of guesses: ". $_SESSION["guesses"];?></p></div>

<p><a href="giveup.php">Give Up</a></p>
<p><a href="startover.php">Start Over</a></p>
</body>
</html>