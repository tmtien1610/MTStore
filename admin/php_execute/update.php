<?php
require_once '../database/database.php';
$db = new Database();

if($_GET['table'] == 'product'){
    $query = "UPDATE `product` SET Name = '" . $_POST['name'] . "', Price = '" . $_POST['price'] . "',  I_Price = '"
    . $_POST['iprice'] . "',  Description = '" . $_POST['description'] . "', Brand_ID = '"
    . $_POST['brandID'] . "', Category_ID = '" . $_POST['categoryID'] . "', Amount = Amount + " . $_POST['quantity'] . "  WHERE `product`.`ID` = " . $_GET['id'];
    $db->conn->query($query);
    header('location: ../list-of-content.php?table=product');    
}
if($_GET['table'] == 'staff'){
    $query = "UPDATE `staff` SET FullName = '" . $_POST['fullname'] . "', Contact = '" . $_POST['contact'] . "'  WHERE `staff`.`ID` = " . $_GET['id'];
    $db->conn->query($query);
    $query = "UPDATE `user` SET Password = '" . $_POST['password'] . "'  WHERE `user`.`ID` = " . $_POST['account_id'];
    $db->conn->query($query);
    header('location: ../list-of-content.php?table=staff');
}
if($_GET['table'] == 'client'){
    $query = "UPDATE `customer` SET FullName = '" . $_POST['fullname'] . "', Contact = '" . $_POST['contact'] . "'  WHERE `customer`.`ID` = " . $_GET['id'];
    $db->conn->query($query);
    $query = "UPDATE `user` SET Password = '" . $_POST['password'] . "'  WHERE `user`.`ID` = " . $_POST['account_id'];
    $db->conn->query($query);
    header('location: ../list-of-content.php?table=client');
}
?>