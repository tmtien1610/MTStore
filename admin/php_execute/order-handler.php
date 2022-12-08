<?php
session_start();
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once "$rootDir/MTStore_NienLuan/admin/database/database.php";
$db = new Database();
$query = 'DELETE FROM `order_list` WHERE `order_list`.`Order_ID` = ' . $_GET['id'];
$db->conn->query($query);
$query = 'DELETE FROM `orderr` WHERE `orderr`.`ID` = ' . $_GET['id'];
$db->conn->query($query);
?>