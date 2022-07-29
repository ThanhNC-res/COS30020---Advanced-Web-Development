<!DOCTYPE html> 
<html lang="en" lang="en" > 
<head> 
<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
<meta name="description" content="Web Application Development :: Lab 3" /> 
<meta name="keywords" content="Web,programming" /> 
</head>
<body>
<?php
error_reporting(1);
$function = ".".DIRECTORY_SEPARATOR."functions".DIRECTORY_SEPARATOR."functions.php" ;
include ($function);

$Title="";
$Position="";
$Contract="";
$Application=array();
$Location= "";


  if (!empty($_GET)){

    if (isset($_GET['title'])  && $_GET['title'] != "" ){
        $Title=$_GET['title'];

    }


    if (isset($_GET['posi'])  && $_GET['posi'] !="" ){
   
        $Position=$_GET['posi'];

    }

        
    if (isset($_GET['contract'])  && $_GET['contract'] !="" ){
   
        $Contract=$_GET['contract'];

    }
      

    if (isset($_GET['apply'])  && $_GET['apply'] !="" ){
   
        $Application=$_GET['apply'];

    }


    if (isset($_GET['location'])  && $_GET['location'] != "" ){
   
        $Location = $_GET['location'];

    }

      
  }

  searchFromFile($Title,$Position,$Contract,$Application,$Location);
  
  echo "<p>Return to <a href=\"index.php\"> Home Page</a> or <a href=\"searchjobform.php\"> Search for another Job Vacancy </a></p></br>";
  ?>
</body>