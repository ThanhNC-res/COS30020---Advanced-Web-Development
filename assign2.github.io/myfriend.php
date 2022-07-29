<?php
class MyFriend{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getFriendarr($userAcc){
        $newConn = $this->db->getNewConn();
        $userId = $userAcc->getId();

        $friendIdArr = array();

        $query = "SELECT friend_id1,friend_id2 FROM myfriends WHERE friend_id1 = '$userId' OR friend_id2 = '$userId'";
        $result = @mysqli_query($newConn, $query);
        
        while($rows = mysqli_fetch_assoc($result)){

            //when a field in friend_id1 column contains user id
            if($rows["friend_id1"] == $userId){
                array_push($friendIdArr, $rows["friend_id2"]); 
            }
        
            //when a field in friend_id1 column contains user id
            else{
                array_push($friendIdArr, $rows["friend_id1"]); 
            }
        }

        return $friendIdArr;
    }

    public function unFriend($userAcc, $friendAcc){
        $newConn = $this->db->getNewConn();

        $userid = $userAcc->getId();
        $friendid = $friendAcc->getId();
        
        $query = "DELETE FROM myfriends WHERE (friend_id1 = '$userid' AND friend_id2 = '$friendid') OR (friend_id1 = '$friendid' AND friend_id2 = '$userid') ;
                UPDATE friends SET num_of_friends = num_of_friends - 1 WHERE friend_id = $userid ;";

        $result = @mysqli_multi_query($newConn, $query);

        if($result){
            return true;
        }else{
            return false;
        }

    }

    public function addFriend($userAcc, $friendAcc){
        $newConn = $this->db->getNewConn();

        $userid = $userAcc->getId();
        $friendid = $friendAcc->getId();

        $query = "INSERT INTO myfriends VALUES ($userid, $friendid);
                UPDATE friends SET num_of_friends = num_of_friends + 1 WHERE friend_id = $userid ;";

        $result = @mysqli_multi_query($newConn, $query);

        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function getMutualFriendArr($userAcc, $friendAcc){
        $newConn = $this->db->getNewConn();

        $fUser = $this->getFriendarr($userAcc);
        $fAcc = $this->getFriendarr($friendAcc);

        $mutualFriend = array_intersect($fUser, $fAcc);
        return $mutualFriend;
        
    }

    public function getMutualFriendCount($userAcc, $friendAcc){

        $count = count($this->getMutualFriendArr($userAcc, $friendAcc));
        
        return $count;

    }

}
?>