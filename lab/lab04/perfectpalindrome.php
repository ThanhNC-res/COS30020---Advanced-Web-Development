<!DOCTYPE html> 
<html lang="en"> 
<head> 
  <meta charset="utf-8" /> 
  <meta name="description" content="Web application development" /> 
  <meta name="keywords" content="PHP" /> 
  <meta name="author"   content="Your Name" /> 
  <title>task-2</title> 
</head> 
<body> 
<h1>Web Programming - Lab 4</h1> 
<?php 
  if (isset ($_POST["string"])){ 
    $str = $_POST["string"]; 
    $rev_Str = strrev($str);
    if(strcmp($str, $rev_Str) == 0){
        echo"the text you entered \"".$_POST["string"]."\" is a perfect palindrome.";
    }
    else {
        echo "the text you entered \"".$_POST["string"]."\" is a not perfect palindrome.";
    }
    
  } else {      
    echo "<p>Please enter string from the input form.</p>"; 
  } 
?> 
</body> 
</html>