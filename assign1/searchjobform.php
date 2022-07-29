<!DOCTYPE html> 
<html lang="en" lang="en" > 
<head> 
<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
<meta name="description" content="Web Application Development :: Lab 3" /> 
<meta name="keywords" content="Web,programming" /> 
<title>Assignment 1</title> 
</head> 
<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
?>
<body> 
<h1 style="text-align: center;">Job Vacancy Posting System</h1> 
<fieldset>
<legend><h3>Search Job Form</h3></legend>
<form action="searchjobprocess.php" method = "GET" >

<label>Job Title:</label>
    <input type="text" name="title" id="title">

<br><br>

<label>Position:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
    <label for="posi1"><input type="radio" name="posi" id="posi1" value="Full Time">Full Time</label>
    <label for="posi2"><input type="radio" name="posi" id="posi2" value="Part Time">Part Time</label>

    <br/><br/>

    <label>Contract:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
    <input type="radio" name="contract" id="contract" value="On Going"/> <label for="contract">On Going</label>
    <input type="radio" name="contract" id="contract" value="Fixed Term"/> <label for="contract">Fixed Term</label>

    <br/><br/>

    <label>Apllication by:&nbsp&nbsp&nbsp&nbsp&nbsp</label>
    <label for="apply"><input type="checkbox" name="apply[]" id="apply1" value = "Post"> Post</label>
    <label for="apply"><input type="checkbox" name="apply[]" id="apply2" value = "Mail"> Mail</label>

    <br/><br/>
    <label for="location">Location: &nbsp&nbsp&nbsp&nbsp&nbsp</label>
    <select name="location" id="location">
        <option value="">--</option>
        <option value="ACT">ACT</option>
        <option value="NSW">NSW</option>
        <option value="NT">NT</option>
        <option value="QLD">QLD</option>
        <option value="SA">SA</option>
        <option value="TAS">TAS</option>
        <option value="VIC">VIC</option>
        <option value="WA">WA</option>
    </select>

    <br/><br/></br/>

    <input type="submit" name="search" value="Search">
    <input type="reset" name="reset" value="Reset">

</form> 
</fieldset>
<footer>
    <p><a href="index.php">Return to home page</a></p>
</footer>
</body> 
</html> 


