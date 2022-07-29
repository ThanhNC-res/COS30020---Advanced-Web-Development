<!DOCTYPE html> 
<html lang="en"> 
<head> 
  <meta charset="utf-8" /> 
  <meta name="description" content="Web application development" /> 
  <meta name="keywords" content="PHP" /> 
  <meta name="author"   content="Your Name" /> 
  <title>TITLE</title> 
</head> 
<style>
table, th, td {
  border:1px solid black;
}
</style>
<body> 
<h1>Lab 6 - Task 2</h1> 
<?php 
$filename = ".".DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR."visitor.txt";

if(file_exists($filename)){
  $fileContent = file_get_contents($filename);
  $arr = explode("\n", $fileContent);
  sort($arr);
  echo "<table>";
  echo "<tr>";
  echo"<th>Name</th>";
  echo"<th>Email</th>";
  echo"</tr>";
  foreach($arr as $line){
    $l = explode(",", $line);
    echo "<tr>";
    echo "<td>" . $l[0]."</td>";
    echo "<td>" . $l[1]."</td>";
    echo "</tr>";
  }
  echo "</table>";
}
?> 
<br/>
</body> 
<footer >
  <a href = "guestbookform.php">Add Another Visitor</a> <br>
</footer> 
</html> 