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
 $mark = array(
     85,
     85,
     95
 );

$mark[1] = 90; 

$avg = array_sum($mark) / count($mark);
$status = ($avg >= 50) ?
    "PASSED" : "FAILED";
echo "The average score is ", $status, "<br/>";

?>
</body> 
</html> 
