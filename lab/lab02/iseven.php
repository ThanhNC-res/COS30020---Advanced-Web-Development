<!DOCTYPE html> 
<html lang="en"> 
<head> 
<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
<meta name="description" content="Web Programming :: Lab 2" /> 
<meta name="keywords" content="Web,programming" /> 
<title>Using variables, arrays and operators</title> 
</head> 
<body> 
<h1>Web Programming - Lab 2</h1> 
<?php
$i = $_GET["variable"]; 
if(is_numeric($i)){
    if((round($i) % 2) == 0 ){
        echo 'This is a even number';
    }else{
    echo'this is number but not even';}
}
else{
    echo 'this is not number'; 
}
?>
</body> 
</html> 
