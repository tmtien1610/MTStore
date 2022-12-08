<?php
include_once '../database/database.php';
class Staff{
    private $fullname;
    private $password;
    private $contact;
    private $database;
    private $username;
    function __construct($fullname, $username, $password, $contact){
        $this->fullname = $fullname;
        $this->password = $password;
        $this->contact = $contact;
        $this->username = $username;
        $this->database = new Database();
    }
    function add(){
        $query = "INSERT INTO User (UserName, Password, role)
        VALUE ('" . $this->username . "', '" . $this->password . "', '1');";
        $this->database->conn->query($query);
        $userID = $this->database->conn->insert_id;
        $query = "INSERT INTO Staff (FullName, UserID, Contact)
        VALUE ('" . $this->fullname . "','" . $userID . "','" . $this->contact . "');";
        $this->database->conn->query($query);
    }
}
?>