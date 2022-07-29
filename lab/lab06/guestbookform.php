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
<h1>Web Programming Form - Lab 6</h1> 
<fieldset>
<legend><strong>Enter your details to sign our guest book</strong></legend>
<form action = "guestbooksave.php" method = "post" > 
   <label>Name </label>
   <input type="text" name="name">
   <br/><br/>
   <label>E-Mail </label>
   <input type="text" name="email">
   <br/><br/>

   <input type="submit" value="Sign">
   <input type="Reset" value="Reset Form">

</form> 
</fieldset>
<br/>
<a href="guestbookshow.php">Show Guest Book</a>


</html> 