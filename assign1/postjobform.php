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
<legend><h3>Post Job Form</h3></legend>
<form action="postjobprocess.php" method = "POST" >
    <label>Position ID: </label>
    <input type="text" name="PosID"><br/><br/>

    <label> Title: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
    <input type="text"  maxlength="20" name="title"><br/><br/>

    <label>Description: </label>
    <textarea name="descrip"  maxlenth = "260" style="width:200px; height: 50px ;"></textarea><br/><br/>

    <label> Closing Date: </label>
    <input type="date"  name="closeDate" value="<?php echo date('Y-m-d');?>">

    <br/><br/>

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
        <option value="--">--</option>
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

    <input type="submit" name="post" value="Post">
    <input type="reset" name="reset" value="Reset">

    <p>Return to <a href="index.php">Home Page</a></p>
    <p>Go to <a href="searchjobform.php">Search Job Form</a></p>


</form> 
</fieldset>
</body> 
</html> 