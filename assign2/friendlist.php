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

//user account init

$userAcc = new account($id,$DbConn);
$myfriends = new MyFriend($DbConn);

//get profile name for the title
$query = "SELECT profile_name FROM friends Where friend_id = '$id'";
$result1 = mysqli_query($Conn, $query);
$row = mysqli_fetch_assoc($result1);
echo "<h2 style=\"text-align: center;\"><b>".strtoupper($row["profile_name"])."'s Friend List Page</b></h2>";

//get friend query
$query = "SELECT friend_id1,friend_id2 FROM myfriends WHERE friend_id1 = '$id' OR friend_id2 = '$id'";
$result = @mysqli_query($Conn, $query);


if(mysqli_num_rows($result) != 0){   //check if user has any friend
    

echo "<p style=\"text-align: center;\"><b>Total number of friends is: ". mysqli_num_rows($result)."</b></p>";
//table start
echo "  <div class=\"table\" style=\"padding: 50px\">
        <table style=\"border-collapse: collapse;width: 100%;\">
        <tr>
        <th style=\"text-align: left;padding: 8px; background-color: black; color: white; text-align:center;\">Name</th>
        <th style=\"text-align: left;padding: 8px;background-color: black;color: white; text-align:center;\">Button</th>
        </tr>";

//print friend name and an unfriend button
while($rows = mysqli_fetch_assoc($result)){
    $fprofname = '';

    //when a field in friend_id1 column contains user id
    if($rows["friend_id1"] == $id){
        $friend = new account($rows["friend_id2"], $DbConn);
        $fid = $rows["friend_id2"];
        $fprofname = $friend->getProfname();
        $fid = $friend->getId();
    }

    //when a field in friend_id1 column contains user id
    else{
        $friend = new account($rows["friend_id1"], $DbConn);
        $fid = $rows["friend_id1"];
        $fprofname = $friend->getProfname();
        $fid = $friend->getId();
    }

    echo "<tr>";
    echo "<form action=\"\" method=\"get\">";
    echo "<td style=\"text-align: left;padding: 8px; text-align:center;\">",$fprofname,"</td>";
    echo "<td style=\"text-align: left;padding: 8px; text-align:center;\">","<input type=\"submit\" value = \"unfriend\">","</td>";
    echo "<td><input type=\"hidden\" name=\"unfriend\" value=\"$fid\"></td>"; 
    echo "</form>";
    echo "</tr>";

    
}

echo "</table>";

echo "</div>";

//unfriend button's behaviour
if($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET)){
    if(isset($_GET["unfriend"]) && !empty($_GET["unfriend"]) ){
        $friendid = $_GET["unfriend"];
        echo "<p>$friendid</p>";
        $friendAcc = new account($friendid, $DbConn);
        $friendState = $myfriends->unFriend($userAcc, $friendAcc);
        if($friendState){
            header("location:friendlist.php");
        }
    }

}

}
else{  
    echo "<p style=\"text-align: center;\">Unfortunately, you don't have friend.<br>
            Go to Add Friend page to have some more friends.</p>";
}


include("footer.php");

}
else{
    echo "<p style=\"text-align: center;\"><strong>You have to sign in first!</strong></p>
    <p style=\"text-align: center;\"><input type=\"button\" onclick=\"location.href='login.php'\" value=\"Sign In\"></p>";

}

?>