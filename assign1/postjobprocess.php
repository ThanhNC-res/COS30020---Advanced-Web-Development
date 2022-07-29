<!DOCTYPE html> 
<html lang="en" lang="en" > 
<head> 
<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
<meta name="description" content="Web Application Development" /> 
<meta name="keywords" content="Web,programming" /> 
<title>Assignment 1</title> 
</head> 
<body>
<?php
$funtion = ".".DIRECTORY_SEPARATOR."functions".DIRECTORY_SEPARATOR."functions.php" ;
include $funtion;
error_reporting(0);

$ID="";
$Title="";
$Description="";
$Date="";
$Position="";
$Contract="";
$Application=array();
$Location="";
$errMsg = "";



if(isset($_POST["post"])) {
if (!empty($_POST)){
    if (isset($_POST["PosID"]) && $_POST["PosID"] !="" ){
        $ID=$_POST["PosID"];

    }else {
      $errMsg .= "<p>Enter a job position </p>
      <p>Return back to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>";
    }
    

    if (isset($_POST["title"])  && $_POST["title"] !="" ){
        $Title=$_POST["title"];

    }else {
      $errMsg .= "<p>Enter a job title </p>
      <p>Return back to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>";
    }

    
    if (isset($_POST["descrip"])  && $_POST["descrip"] != "" ){
   
        $Description=$_POST["descrip"];

    }else {
      $errMsg .= "<p>Enter job description</p>
      <p>Return back to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>";
    }


    if (isset($_POST["closeDate"])  && $_POST["closeDate"] !="" ){
   
        $Date=$_POST["closeDate"];

    }else {
      $errMsg .= "<p>Choose a valid date </p>
      <p>Return back to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>";
    }
    

    if (isset($_POST["posi"])  && $_POST["posi"] !="" ){

        $Position=$_POST["posi"];

    }else {
      $errMsg .= "<pchoose a position type</p>
      <p>Return back to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>";
    }

        
    if (isset($_POST["contract"])  && $_POST["contract"] !="" ){
   
        $Contract=$_POST["contract"];

    }else {
      $errMsg .= "<p>Choose a type a contract </p>
      <p>Return back to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>";
    }
      

    if (isset($_POST['apply'])  && $_POST['apply'] !="" ){
   
        $Application = $_POST['apply'];

    }else {
      $errMsg .= "<p>Choose application type</p>
      <p>Return back to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>";
    }


    if (isset($_POST["location"])  && $_POST["location"] !="" ){
   
        $Location=$_POST["location"];

    }else{
      $errMsg .= "<p>Choose a location </p>
      <p>Return back to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>";
    }


      validateFormat($ID, $Title, $Description, $Date, $Position, $Contract, $Application, $Location, $errMsg);


     
      saveDataToFile($ID, $Title, $Description, $Date, $Position, $Contract, $Application, $Location);
  
  }
}



?>
</body>
