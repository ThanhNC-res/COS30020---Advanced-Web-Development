<?php
class hitcounter{
    private $db;
    private $host;
    private $user;
    private $pswd;
    private $dbnm;

    public function __construct($host, $user, $pswd, $dbnm)
    {
        $this->host = $host;
        $this->user = $user;
        $this->pswd = $pswd;
        $this->dbnm = $dbnm;

    }

    public function setNewConn(){
        $this->db = @mysqli_connect($this->host, $this->user, $this->pswd, $this->dbnm );
    }

    public function getNewConn(){
        $this->setNewConn();
        return $this->db;
    }

    public function closeConn(){
        if ($this->db) {
            if(!mysqli_ping($this->db)){
            mysqli_close($this->db);
            }
        }
    }
    public function getConn(){
        return $this->db;
    }

    public function getHits(){
        $this->setNewConn();

        $query = "SELECT hits FROM hitcounter WHERE id = 1";
        $result = @mysqli_query($this->db, $query);

        $row = mysqli_fetch_assoc($result);
        $hits = $row["hits"];
        echo "This page recieved $hits hits.";

    }

    public function setHits(){

        $this->setNewConn();

        $query = "UPDATE hitcounter SET hits = hits + 1 WHERE id = 1";
        $result = @mysqli_query($this->db, $query);
    }

    public function startOver(){
            $this->setNewConn();

        $query = "UPDATE hitcounter SET hits = 0 WHERE id = 1";
        $result = @mysqli_query($this->db, $query);
        if($result){
            return true;
        }
        else{
        return false;}
    }


}
?>