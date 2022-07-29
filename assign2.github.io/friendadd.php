<?php
include(".".DIRECTORY_SEPARATOR."include".DIRECTORY_SEPARATOR."header.php");
include("navbar.php");

require_once("dbCon.php");
require_once("account.php");
require_once("myfriend.php");

session_start();

//check if user already signed in 
if(!empty($_SESSION)){ 

$id = $_SESSION["id"];

//get database connection
$DbConn = new dbCon();
$Conn = $DbConn->getNewConn();

$pageNumber = 0;

if(isset($_GET["page"])){
    $pageNumber = $_GET["page"];
}

//user account init

$userAcc = new account($id,$DbConn);
$myfriends = new MyFriend($DbConn);
$friendid = array();

//unfriend button's behaviour
if($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET)){
    if(isset($_GET["addfriend"]) && !empty($_GET["addfriend"]) ){
        $friendid = $_GET["addfriend"];
        echo "<p>$friendid</p>";
        $friendAcc = new account($friendid, $DbConn);
        $friendState = $myfriends->addFriend($userAcc, $friendAcc);
        if($friendState){
            header("location:friendadd.php");
        }
    }

}

//get profile name
echo "<h2 style=\"text-align: center;\"><b>".strtoupper($userAcc->getProfname())."'s Friend List Page</b></h2>";

//get user's friends query
$friendid = $myfriends->getFriendarr($userAcc);

array_push($friendid,$id);
$query = "SELECT friend_id, profile_name FROM friends ORDER BY profile_name ASC;";
$result2 = @mysqli_query($Conn, $query);

$allAccount = array();
while($rows = mysqli_fetch_assoc($result2)){
    array_push($allAccount, $rows["friend_id"]);
}

//Pagination declare and setup
$notFriendarr = array_diff($allAccount, $friendid);
$pagedArray = array_chunk($notFriendarr, 5, TRUE);
$nthPageList = array();

if(array_key_exists(($pageNumber), $pagedArray)){
    $nthPageList = $pagedArray[$pageNumber];
}


echo "<p style=\"text-align: center;\"><b>Total number of friends is: ". count($myfriends->getFriendarr($userAcc)) ."</b></p>";
//table start
echo "  <div class=\"table\" style=\"padding: 20px\">
        <table style=\"border-collapse: collapse;width: 100%;\">
        <tr>
        <th style=\"text-align: left;padding: 8px; background-color: black; color: white; text-align:center;\">Name</th>
        <th style=\"text-align: left;padding: 8px;background-color: black;color: white; text-align:center;\">Number of mutual friends</th>
        <th style=\"text-align: left;padding: 8px;background-color: black;color: white; text-align:center;\">Button</th>
        </tr>";    

   
  
  
//print friend name and an unfriend button
if(!empty($nthPageList)){
foreach($nthPageList as $page){

    
    $notFriend = new account($page, $DbConn);
    $fprofname = $notFriend->getProfname();
    $fid = $notFriend->getId();

    $mutualF = $myfriends->getMutualFriendCount($userAcc, $notFriend);
    $mutualFStr = $mutualF == 1 ? "$mutualF mutual friend" : "$mutualF mutual friends";

    echo "<tr>";
    echo "<form action=\"\" method=\"get\">";
    echo "<td style=\"text-align: left;padding: 8px; text-align:center;\">",$fprofname,"</td>";
    echo "<td style=\"text-align: left;padding: 8px; text-align:center;\">",$mutualFStr,"</td>";
    echo "<td style=\"text-align: left;padding: 8px; text-align:center;\">","<input type=\"submit\" value = \"addfriend\">","</td>";
    echo "<td><input type=\"hidden\" name=\"addfriend\" value=\"$fid\"></td>"; 
    echo "</form>";
    echo "</tr>";

    
}

echo "</table>";

echo "</div>";
}
else{
    echo "<p>Huray! All people became your friend!</p>";   
}

$pagedArray; $pageNumber; include "pagination.php";
include("footer.php");
}

else{
    echo "<p style=\"text-align: center;\"><strong>You have to sign in first!</strong></p>
    <p style=\"text-align: center;\"><input type=\"button\" onclick=\"location.href='login.php'\" value=\"Sign In\"></p>";
}
?>