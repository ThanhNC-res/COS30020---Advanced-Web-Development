<?php

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
    
    $user = $_POST["uname"];
    $pwrd = $_POST["pwrd"];
    $dbnm = $_POST["dbnm"];
    $host = "feenix-mariadb.swin.edu.au";

    $conn = @mysqli_connect($host, $user, $pwrd, $dbnm);
    if(!$conn){
        echo "Cannot connect to database server.";
    }
    else{
        $filedir = ".".DIRECTORY_SEPARATOR."filekeys.txt";
        if(!file_exists($filedir)){
            fopen($filedir, "w");
        }
            $Content = $host.",".$user.",".$pwrd.",".$dbnm;
            $fileContent = file_get_contents($filedir);
            $logstr = explode('\n', $fileContent);
                if(!in_array($Content, $logstr)){
                    $Content1 = $host.",".$user.",".$pwrd.",".$dbnm;
                    file_put_contents($filedir, $Content1, FILE_APPEND);
                }else{
                    echo "<p>You already sign in.</p>";
                }
            
        
          
        $query = "SHOW TABLES LIKE '%hitcounter'";
        $result2 = @mysqli_query($conn, $query);
        if(mysqli_num_rows($result2) == 0){

        $query = "CREATE TABLE IF NOT EXISTS hitcounter(
            id SMALLINT NOT NULL PRIMARY KEY,
            hits SMALLINT NOT NULL
        );
        INSERT INTO hitcounter VALUES (1,0); ";
        $result = @mysqli_multi_query($conn, $query);
        echo "<p>Setup is OK.</p>";
        }
        
        else{
        echo "<p>Database has already been setup.</p>";
        }

    }
    mysqli_close($conn);
}

?>
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
<h1>Web Programming – Lab10</h1> 

<form action="" method="post">
<p><label>Username: </label> <input type="text" name="uname" ></p>
<p><label>Password: </label> <input type="password" name="pwrd" ></p>
<p><label>Database Name: </label> <input type="text" name="dbnm" ></p>
<p><input type="submit" value="Submit"></p>
<p><input type="reset" value="Clear"></p>
<p><input type="button" onclick="location.href='countvisits.php';" value="Hit Counter"></p>
</form>
</body>
</html>