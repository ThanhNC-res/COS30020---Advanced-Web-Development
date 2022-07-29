<?php
class account{

    
    private $user_email;
    private $user_profname;
    private $user_id;
    private $user_db;
    private $user_numsOfFriends;

    public function __construct($userid,$db)
    {
        $this->user_id = $userid;
        $this->user_db = $db;
        $this->user_email = null;
        $this->user_profname = ''   ;
        $this->user_numsOfFriends = null;
    }

    //Get currentt user's email
    public function getEmail(){

        $Conn = $this->user_db->getNewConn();
        $id = $this->user_id;
        
        $query = "SELECT friend_email FROM friends WHERE friend_id = '$id'";
        $result = @mysqli_query($Conn, $query);

        if(mysqli_num_rows($result) != 0){
            while($rows = mysqli_fetch_assoc($result)){
                $this->user_email = $rows["friend_email"];
            }
        }

        $this->user_db->closeCon();

        return $this->user_email;
    }

    public function getId(){
        $Conn = $this->user_db->getNewConn();
        $id = $this->user_id;
        
        $query = "SELECT friend_id FROM friends WHERE friend_id = '$id'";
        $result = @mysqli_query($Conn, $query);

        if(mysqli_num_rows($result) != 0){
            while($rows = mysqli_fetch_assoc($result)){
                $this->user_id = $rows["friend_id"];
            }
        }

        $this->user_db->closeCon();

        return $this->user_id;
    }


    public function getProfname(){
        $Conn = $this->user_db->getNewConn();
        $id = $this->user_id;
        
        $query = "SELECT profile_name FROM friends WHERE friend_id = '$id'";
        $result = @mysqli_query($Conn, $query);

        if(mysqli_num_rows($result) != 0){
            while($rows = mysqli_fetch_assoc($result)){
                $this->user_profname = $rows["profile_name"];
            }
        }

        $this->user_db->closeCon();

        return $this->user_profname;
    }

    public function getNumOfFriends(){
        $Conn = $this->user_db->getNewConn();
        $id = $this->user_id;
        
        $query = "SELECT num_of_friends FROM friends WHERE friend_id = '$id'";
        $result = @mysqli_query($Conn, $query);

        if(mysqli_num_rows($result) != 0){
            while($rows = mysqli_fetch_assoc($result)){
                $this->user_numsOfFriends = $rows["nums_of_friends"];
            }
        }

        $this->user_db->closeCon();

        return $this->user_numsOfFriends;
    }

}
?>