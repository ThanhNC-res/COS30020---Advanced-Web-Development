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
$days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");

echo "The Days of the week in English are: ";
foreach($days as $s){
    echo $s, " ,";
}
echo "<br/>";

$days[0] = "Dimanche"; 
$days[1] = 'Lunch';
$days[2] = 'Mardi';
$days[3] = 'Mercredi';
$days[4] = 'Jeudi';
$days[5] = 'Vendredi';
$days[6] = 'Samedi';

echo "The Days of the week in English are: "; 
foreach($days as $s){
    echo $s, " ,";
}
?>
</body> 
</html> 
