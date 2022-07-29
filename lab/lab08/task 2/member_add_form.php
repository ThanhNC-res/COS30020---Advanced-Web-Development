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
<legend><h2>Enter Your Information: </h2></legend>
<form action="member_add.php" method="post">
    <label>First Name: </label>
   <input type="text" name="fname">
   <br/><br/>
   <label>Last Name: </label>
   <input type="text" name="lname">
   <br/><br/>
   <label>Choose Gender:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </label>
   <input type="radio" name="gender" id="gender1" value="M"/> <label for="gender1">Male</label>
   <input type="radio" name="gender" id="gender2" value="F"/> <label for="gender2">Female</label>
   <br><br>
   <label>E-Mail: </label>
   <input type="text" name="email">
   <br/><br/>
   <label>Phone: </label>
   <input type="text" name="phone">
   <br/><br/>
   <input type="submit" value="Add Member">

</form>
</fieldset>
<br/><br>
<button onclick="location.href='vip_member.php'">Home Page</button><br><br>
<input type="button" onclick="location.href = 'member_display.php'" value="Show Member"><br><br>
<input type="button" onclick="location.href = 'member_search.php'" value="Search Member"><br>
</body>
</html> 