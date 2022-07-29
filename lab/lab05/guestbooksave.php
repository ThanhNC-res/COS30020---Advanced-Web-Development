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

if(isset($_POST["fname"]) && isset($_POST["lname"]) && trim($_POST["fname"]) != '' && trim($_POST["lname"]) != ''){
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $file = ".".DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR."guestbook.txt";
    $handle = fopen($file, "a") or die("Unable to open file!");
    $data = addslashes($fname." ".$lname.",". PHP_EOL); 
    if(!feof($handle)){
        if(is_writable($file)){
            fwrite($handle, $data);
            echo "Thank you for signing the Guest book";
        }
        else{
            echo "Cannot add your name to the Guest book";
        }
    }
    fclose($handle);
} 
else{
    echo"You must enter your first and last name". PHP_EOL;
    echo"Use the Browser's 'Go Back' button to return to the Guestbook";
}

?> 
<br/>
<a href="guestbookshow.php">Show Guest Book</a>
</body> 
</html> 