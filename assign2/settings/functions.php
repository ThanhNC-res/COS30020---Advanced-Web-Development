<?php
require_once ('settings.php');
$errorMsg = array('email' => '', 'profname' => '', 'pwrd' => '' , 'pwrd_conf' => '');
$errorCode = '';
function validateForm($email, $profname, $pwrd, $pwrd_conf){
 if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errorMsg['email'] = '*Invalid Email Format';
    $errorCode = 1;
 }
 if(!preg_match ("/^[a-zA-Z]^\S.*\s.*\S$/", $profname)){
    $errorMsg['profname'] = '*Profile Name can only contain letters.';
    $errorCode = 1;
 }
 if(!preg_match ("/^[a-zA-Z0-9]/", $pwrd)){
    $errorMsg['pwrd'] = "*Password can only cantain letter and number.";
    $errorCode = 1;
}
if(!preg_match ("/^[a-zA-Z0-9]/", $pwrd_conf)){
    $errorMsg['pwrd_conf'] = "*Confirm Password can only cantain letter and number.";
    $errorCode = 1;
}
}

// function duplicateForm($email, $profname, $pwrd, $pwrd_conf){
//     $query = "SELECT * FROM friends";
//     $conn = @mysqli_connect($host,$user,$pswd,$dbnm);
//     $result = @mysqli_query($conn, $query);
//     if($errorCode != 1){
//     while($row = @mysqli_fetch_row($result)){
//         if($email == htmlspecialchars($row['friend_email'])){
//             $errorMsg['email'] = '*This email has been used.';
//             $errorCode = 2;
//         }
//         if($profname == htmlspecialchars($row['profile_name'])){
//             $errorMsg['profname'] = '*This name has been used by other users.';
//             $errorCode = 2;
//         }
//         if($pwrd_conf != $pwrd){
//             $errorMsg['pwrd'] = '*Confirm password does not match with declared password';
//             $errorCode = 2;
//         }
//     }
//     }
// }
?>