<?php
include_once '../database/database.php';
$database = new Database();

if ($_GET['table'] == 'staff'){
    $query = 'SELECT UserID FROM Staff WHERE ID = ' . $_GET['id'];
    $result = $database->conn->query($query);
    $row = $result->fetch_assoc();
    $query = 'DELETE FROM Staff WHERE Staff.ID = ' . $_GET['id'];
    $database->conn->query($query);
    $query = 'DELETE FROM User WHERE User.ID = ' . $row['UserID'];
    $database->conn->query($query);
}
if ($_GET['table'] == 'client'){
    $query = 'SELECT UserID FROM Customer WHERE ID = ' . $_GET['id'];
    $result = $database->conn->query($query);
    $row = $result->fetch_assoc();
    $query = 'DELETE FROM Customer WHERE Customer.ID = ' . $_GET['id'];
    $database->conn->query($query);
    $query = 'DELETE FROM User WHERE User.ID = ' . $row['UserID'];
    $database->conn->query($query);
}
if ($_GET['table'] == 'product'){
    $query = 'DELETE FROM Product_Tag WHERE Product_ID = ' . $_GET['id'];
    $database->conn->query($query);
    $query = 'DELETE FROM Product WHERE Product.ID = ' . $_GET['id'];
    $database->conn->query($query);
}
?>