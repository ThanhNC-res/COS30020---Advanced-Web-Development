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
<h1>Web Programming - Lab 5</h1> 
<?php 
$data = file_get_contents(".".DIRECTORY_SEPARATOR."data"
.DIRECTORY_SEPARATOR."guestbook.txt");

$data_2 = explode("," , $data);
foreach($data_2 as $d){
  echo stripslashes($d) . "<br>";
}
?> 
<br/>
<a href="guestbookform.php">Sign Guest Book</a>
</body> 
</html> 