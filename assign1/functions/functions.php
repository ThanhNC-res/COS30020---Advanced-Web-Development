<?php

//check if the inputs format í correct 
function validateFormat($ID, $Title, $Description, $Date, $Position, $Contract, $Application, $Location, $errMsg){
      if ($ID=="") {
      $errMsg .= "<p>Error ID: Empty ID Fill. </p>
      <p>Go to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>";

      }else if( !preg_match ("/^[P]\d{4}$/", $ID)){
        $errMsg .= "<p>Error ID: ID must start with an uppercase letter “P” followed by 4 digits. </p>
        <p>Go to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>";
      
      }else if(strlen($ID) != 5){
        $errMsg .= "<p>Error ID: ID must have 5 characters in length. </p>
        <p>Go to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>";

      }
    
      if ($Title=="") {
        $errMsg .= "<p>Error Title: Empty Title Fill. </p>
        <p>Go to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>";;
  
        }else if( !preg_match ("/^[a-zA-Z0-9,.! ]*$/", $Title)){
          $errMsg .= "<p>Error Title: Title can only contain alphanumeric characters including spaces, comma, period, and exclamation point </p>
          <p>Go to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>";
        
        }else if(strlen($Title) > 20){
          $errMsg .= "<p>Error Title: Title can only contain a maximum of 20 alphanumeric characters </p>
          <p>Go to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>";
  
        }
             
  
      if ($Description=="") {
        $errMsg .= "<p>Error Description: Empty Description Fill. </p>
        <p>Go to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>";
  
        }else if(strlen($Description) > 260){
          $errMsg = "<p>Error Description: Description can only contain a maximum of 260 characters </p>
          <p>Go to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>";
  
        }
        
       if ($Date=="") {
        $errMsg .= "<p>Error Date: Empty Date Fill. </p>
        <p>Go to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>";
        }
        else if(validateDate($Date, 'Y-m-d') == false){
          $errMsg .= "<p>Error Date: Date must be in format YYYY-MM-DD </p>
          <p>Go to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>";
  
        }

        if($errMsg!=""){
          echo $errMsg;
          exit;
        }
  
}



function validateDate($Date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $Date);
    return $d && $d->format($format) == $Date;
}


// sale data to txt file
function saveDataToFile($ID, $Title, $Description, $Date, $Position, $Contract, $Application, $Location){
    $dir = ".." .DIRECTORY_SEPARATOR.".." .DIRECTORY_SEPARATOR."data";
    $filename = $dir .DIRECTORY_SEPARATOR."jobposts.txt" ;
    if (file_exists($filename)) {   
      $fileContent = file_get_contents($filename);
      $arrayLine = explode("\n", $fileContent);
      array_pop($arrayLine);
      foreach ($arrayLine as $line){ 
        $arr = explode("\t", $line);
        for ($x = 0; $x <count($arrayLine)-1 ; $x++) {
  
          if($arr[0] == $ID){
            echo " <p>Duplicate Postion ID found. </p>
            <p>Go to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>";
            exit;
          }
        }
  
      }  
    }
    else{  
      if (!is_dir($dir)) mkdir($dir, 0777, true);
      fopen($filename, "w");
    }
    
    $contents = $ID ."\t".
                  $Title ."\t" .
                  $Description ."\t". 
                  $Date."\t" .
                  $Position ."\t".
                  $Contract ."\t";
    foreach ($Application as $checkbox){ 
      $contents.=$checkbox."\t";
    }
  
    $contents.= $Location ."\t\r\n";                         
  
      file_put_contents($filename, $contents,FILE_APPEND);     // Save our content to the file.
      echo " <p>Successfully Saved into File </p>
      <p>Go to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>" ;    
        
  
}

function sortFunction( $a, $b ) {
  return strtotime($a) - strtotime($b);
}

// Search job from the stored file
function searchFromFile($Title,$Position,$Contract,$Application,$Location){
    $folder = ".." .DIRECTORY_SEPARATOR.".." .DIRECTORY_SEPARATOR."data";
    $file = $folder .DIRECTORY_SEPARATOR. "jobposts.txt";
    $foundPosition = false;
    $str = array();
    $newArrayLine = array();
    if (file_exists($file)) {  
      $fileContent = file_get_contents($file);
      $arrayLine = explode("\n", $fileContent);
      array_pop($arrayLine);
      sort($arrayLine);
      foreach($arrayLine as $line){
        $arr = explode("\t", $line);
        array_push($str, $arr[3]);
      }

      usort($str, "sortFunction");
      foreach ($str as $t){
        foreach($arrayLine as $n){
          if(strpos($n, $t) !== false){
            array_push($newArrayLine, $n);
          }
        }
      } 
      array_pop($newArrayLine);
      sort($newArrayLine);
      foreach ($newArrayLine as $line){ 
        $arr = explode("\t", $line);
            if(strpos(strtolower($arr[1]), strtolower($Title)) !== false){
                $date=date('Y-m-d');
                $str = date('Y-m-d', strtotime($arr[3]));
                if(date('Y-m-d', strtotime($arr[3])) >= $date){
                    if($Position != "" && $arr[4]!=$Position){
                        continue;
                     }

                     if($Contract != "" && $arr[5]!=$Contract){
                        continue;
                     }

                     if(count($arr)==9 && count($Application)==2){
                        continue;
                     }
                    
                     if(!empty($Application)  && count($arr)==9 ){
                            if($Application[0] != $arr[6]){
                                continue;
                            }
                    }
                   
                    if(!empty($Application) && count($arr)==10){
                        if($Application[0]!=$arr[6] || $Application[1]!=$arr[7] ){
                            continue;
                        }
                     }

                     if($Location != "" && count($arr)==9 && $arr[7]!=$Location){
                        continue;
                     }
                     if($Location != "" && count($arr)==10 && $arr[8]!=$Location){
                        continue;
                     }
    
            $foundPosition = true;
            displayJob($arr);
            }
        }
        
      }

      if(!$foundPosition){
          echo "<h5>No Postion Found...</h5>";
          echo "<p>Go to <a href=\"index.php\"> Home Page</a> or <a href=\"postjobform.php\"> Post Job Form Page</a></p></br>";
      }
    }
  
}


//Display the search Job
function displayJob($arr){
    echo " <h4>Job Vacancy Information</h4>";
    echo "Job Title: ". $arr[1] ."</br>";
    echo "Description: ". $arr[2] ."</br>";
    echo "Closing Date: ". $arr[3] ."</br>";
    echo "Position: ". $arr[4] . " , ".$arr[5]. "</br>";
    
    if(count($arr)==9){
        echo "Application By : ". $arr[6] ."</br>";
        echo "Location : ". $arr[7] ."</br>";

    }

    if(count($arr)==10){
        echo "Application By : ". $arr[6]."," .$arr[7] ."</br>";
        echo "Location : ". $arr[8] ."</br>";

    }

}

?>