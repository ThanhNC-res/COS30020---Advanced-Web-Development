<?php
if (isset ($_GET["number"])) {  
    $n = $_GET["number"];
    if(is_numeric($n)){
        $n = intval($n); 
        if(gettype($n) == "integer"){
        
            if(is_prime($n) == true){
                echo "The number you have entered $n is a prime number" ;
            }
            else {
                echo "The number you have entered $n is not a prime number";
            }
        }
        else{
            echo "Not a natural number";
        }
    }
    else
        echo "not a number"; 

}
function is_prime($num){
    if($num == 0 && $num == 1){
        return true;
    }
    else{
        for($i = 2; $i <= $num; ++$i){
            if($num % $i == 0 ){
                return false;
            }
            else{
                return true;
            }
        }
    }
}
?>