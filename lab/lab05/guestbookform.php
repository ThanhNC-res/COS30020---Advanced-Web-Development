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
<h1>Web Programming Form - Lab 5</h1> 
<fieldset>
<legend><strong>Enter your details to sign our guest book</strong></legend>
<form action = "guestbooksave.php" method = "post" > 
   <label>First Name: </label>
   <input type="text" name="fname">
   <br/><br/>
   <label>Last Name: </label>
   <input type="text" name="lname">
   <br/><br/>

   <input type="submit" value="Sign">

</form> 
</fieldset>
<br/>
<a href="guestbookshow.php">Show Guest Book</a>
</body> 
</html> 