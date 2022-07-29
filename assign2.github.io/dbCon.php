<?php
class dbCon{
    private $db_host;
    private $db_user;
    private $db_pswd;
    private $db_dbnm;

    private $db_conn;

    public function __construct()
    {
        require_once(".".DIRECTORY_SEPARATOR."settings".DIRECTORY_SEPARATOR."settings.php");
        $this->db_host = $host;
        $this->db_user = $user;
        $this->db_pswd = $pswd;
        $this->db_dbnm = $dbnm;
    }

    public function closeCon(){
        if ($this->db_conn) {
            
                mysqli_close($this->db_conn);

        }
    }

    public function setNewConn(){
        $this->db_conn = @mysqli_connect($this->db_host, $this->db_user, $this->db_pswd, $this->db_dbnm );
    }

    public function getNewConn(){
        $this->setNewConn();
        return $this->db_conn;
    }

    public function getConn()
    {
        return $this->db_conn;
    }

    public function initDB(){
        if(!mysqli_ping($this->db_conn)){
            $this->setNewConn();
        }
        $query = "CREATE TABLE IF NOT EXISTS friends (
            friend_id INT NOT NULL AUTO_INCREMENT,
            friend_email varchar(50) NOT NULL,
            password varchar(20) NOT NULL,
            profile_name varchar(30) NOT NULL, 
            date_started date NOT NULL,
            num_of_friends int UNSIGNED,
            PRIMARY KEY(friend_id)
            );
            CREATE TABLE IF NOT EXISTS myfriends (
            friend_id1 INT NOT NULL,
            friend_id2 INT NOT NULL,
            CHECK(friend_id1 != friend_id2)
            );
            INSERT INTO friends(friend_email,password,profile_name, date_started, num_of_friends) VALUES ('testmail1@gmail.com','12345','camel', CURDATE(), 2);
            INSERT INTO friends(friend_email,password,profile_name, date_started, num_of_friends) VALUES ('testmail2@gmail.com','12345','deer', CURDATE(), 1);
            INSERT INTO friends(friend_email,password,profile_name, date_started, num_of_friends) VALUES ('testmail3@gmail.com','12345','waterbuck', CURDATE(), 1);
            INSERT INTO friends(friend_email,password,profile_name, date_started, num_of_friends) VALUES ('testmail4@gmail.com','12345','whale', CURDATE(), 1);
            INSERT INTO friends(friend_email,password,profile_name, date_started, num_of_friends) VALUES ('testmail5@gmail.com','12345','duckbill platypus', CURDATE(), 1);
            INSERT INTO friends(friend_email,password,profile_name, date_started, num_of_friends) VALUES ('testmail6@gmail.com','12345','basilisk', CURDATE(), 1);
            INSERT INTO friends(friend_email,password,profile_name, date_started, num_of_friends) VALUES ('testmail7@gmail.com','12345','reindeer', CURDATE(), 1);
            INSERT INTO friends(friend_email,password,profile_name, date_started, num_of_friends) VALUES ('testmail8@gmail.com','12345','eagle owl', CURDATE(), 1);
            INSERT INTO friends(friend_email,password,profile_name, date_started, num_of_friends) VALUES ('testmail9@gmail.com','12345','dung beetle', CURDATE(), 1);
            INSERT INTO friends(friend_email,password,profile_name, date_started, num_of_friends) VALUES ('testmail10@gmail.com','12345','toad', CURDATE(), 1);
            INSERT INTO friends(friend_email,password,profile_name, date_started, num_of_friends) VALUES ('testmail11@gmail.com','12345','gemsbok', CURDATE(), 1);
            INSERT INTO friends(friend_email,password,profile_name, date_started, num_of_friends) VALUES ('testmail12@gmail.com','12345','puma', CURDATE(), 1);

            INSERT INTO myfriends(friend_id1, friend_id2) VALUES (1,2);
            INSERT INTO myfriends(friend_id1, friend_id2) VALUES (2,3);
            INSERT INTO myfriends(friend_id1, friend_id2) VALUES (3,4);
            INSERT INTO myfriends(friend_id1, friend_id2) VALUES (4,5);
            INSERT INTO myfriends(friend_id1, friend_id2) VALUES (5,6);
            INSERT INTO myfriends(friend_id1, friend_id2) VALUES (6,7);
            INSERT INTO myfriends(friend_id1, friend_id2) VALUES (7,8);
            INSERT INTO myfriends(friend_id1, friend_id2) VALUES (8,9);
            INSERT INTO myfriends(friend_id1, friend_id2) VALUES (9,10);
            INSERT INTO myfriends(friend_id1, friend_id2) VALUES (10,11);
            INSERT INTO myfriends(friend_id1, friend_id2) VALUES (11,12);
            INSERT INTO myfriends(friend_id1, friend_id2) VALUES (12,1);";

        $result = mysqli_multi_query($this->db_conn, $query);

        if ($result) {
            return true;
        }

        return false;
}
}
?>