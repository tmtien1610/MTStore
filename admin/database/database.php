<?php
class Database{
    private $dbname = "MTStore";
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    public $conn;
    function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    }
    function __destruct(){
        $this->conn->close();
    }
}
?>