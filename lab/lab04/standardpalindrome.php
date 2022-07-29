<!DOCTYPE html> 
<html lang="en"> 
<head> 
  <meta charset="utf-8" /> 
  <meta name="description" content="Web application development" /> 
  <meta name="keywords" content="PHP" /> 
  <meta name="author"   content="Your Name" /> 
  <title>Task-3</title> 
</head> 
<body> 
<h1>Web Programming - Lab 4</h1> 
<?php 
  if (isset ($_POST["string"]) && trim($_POST["string"]) != ''){ 
    $str = $_POST["string"]; 
    $rev_Str = strrev($str);  
    if(strcmp($str, $rev_Str) == 0){
        echo"the text you entered \"".$_POST["string"]."\" is a perfect palindrome.";
    }
    else {
      $str_2 = strtolower(str_replace(' ', '', $str));
      
      $str_3 = preg_replace("/[^A-Za-z0-9]/", "", $str_2);
     
      $rev_Str_2 = strrev($str_3);
      if(strcmp($str_3, $rev_Str_2) == 0){
          echo"the text you entered \"".$_POST["string"]."\" is a standard palindrome.";
       }
       else {
          echo "the text you entered \"".$_POST["string"]."\" is not palindrome.";
       }
    }
    
  } else {      
      echo "<p>Please enter string from the input form.</p>"; 
  } 
?> 
</body> 
</html>