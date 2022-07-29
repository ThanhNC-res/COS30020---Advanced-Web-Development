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
<h1>Lab 6 - Task 2</h1> 
<?php 

if(isset($_POST["name"]) && isset($_POST["email"]) && trim($_POST["name"]) != '' && trim($_POST["email"]) != ''){
    $name = $_POST["name"];
    $email = $_POST["email"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p>Invalid email format</p>";
        echo"Use the Browser's 'Go Back' button to return to the Guestbook.";
    }

    $filename = ".".DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR."visitor.txt";
    $all_data = array();
    if (file_exists($filename)) { 
        $emaildata = array();                          
        $namedata = array();                 
       $handle = fopen($filename, "r");  
            while (! feof ($handle)) {             
              $onedata = fgets($handle);      
              if ($onedata != "") {               
                $data = explode(",", $onedata);                    
                $alldata [] = $data;     
                $namedata[] = $data[0]; 
                $namedata[] = preg_replace('/[^A-Za-z0-9\-]/', '',$data[1]);        
              }   
       } 
            fclose ($handle);

        if (in_array($name, $namedata)){
            echo "You have already signed the guest book"; 
        }         
        else if(!in_array($name, $namedata) && in_array(preg_replace('/[^A-Za-z0-9\-]/', '',$email), $namedata)){
             echo "You have already use this mail address";
        } 
        else{    
            echo "Thank you for sign our guest book <br><br>";    
            
            echo "<strong>Name: </strong>" . $name. "<br>";
            echo "<strong>Email: </strong>" . $email. "<br>";
        }
        $newdata = !(in_array($name, $namedata)) && !(in_array(preg_replace('/[^A-Za-z0-9\-]/', '',$email), $namedata)); 
 
    } else { 
        $newdata = true;   
    } 
        if ($newdata) { 
             $handle = fopen($filename, "a");   
             $data = $name . "," . $email ."\n"; 
                                                
             fputs($handle, $data);             
             fclose ($handle);
         
       
         $alldata [] = array($name, $email);  

        } 
}
else{
    echo"You must enter your name and email. <br>";
    echo"Use the Browser's 'Go Back' button to return to the Guestbook.";
}

?> 
</body>
<footer >
  <a href = "guestbookform.php">Add Another Visitor</a> <br>
  <a href= "guestbookshow.php">View Guest Book</a>
 </footer> 
</html> 