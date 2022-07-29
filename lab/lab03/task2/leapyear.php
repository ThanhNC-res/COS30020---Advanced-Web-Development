<!DOCTYPE html> 
<head> 
<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
<meta name="description" content="Web Application Development :: Lab 1" /> 
<meta name="keywords" content="Web,programming" /> 
<title>Using if and while statements</title> 
</head> 
<body> 
<?php

function is_leapyear($num){
    if($num >= 0){
       if($num < 100){ 
           if($num % 4 == 0){
               return true;
           }
           else{
               return false;
           }
       }
       else{
           if($num % 4 == 0 && $num % 100 == 0 && $num % 400 == 0){
               return true ;
           }
           elseif($num % 4 == 0 && $num % 100 != 0 ){
            return true ;
           }
           else {
            return false;
           }
        }
    
    }
    else {
        echo "Enter a positive number"; }
}
if (isset ($_GET["number"])) {
    $n = $_GET["number"];
    if(is_numeric($n)){
        $n = intval($n); 
        if(gettype($n) == "integer"){

            if(is_leapyear($n)){
                echo "the year you entered $n is a leap year";
            }
            else{
                echo "the year you entered $n is not a leap year";
            }
        }
        else{
            echo "Not a natural number";
        }
    }
    else
        echo "not a number"; 
}
else{
    echo "Cannot access number value"; 
}
?>

</body>
</html>