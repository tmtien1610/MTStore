<?php
require '../database/database.php';
$query = 'UPDATE orderr SET Status=' . $_GET['status'] . ' WHERE ID=' . $_GET['id'];
$db = new Database();
$db->conn->query($query);
if($_GET['status'] == 1){
    $query = 'SELECT * FROM order_list WHERE Order_ID=' . $_GET['id'];
    $result = $db->conn->query($query);
    while($row = $result->fetch_assoc()){
        $query = 'UPDATE product SET Amount=Amount-' . $row['Amount'] . ' WHERE ID=' . $row['Product_ID'];
        $db->conn->query($query);
    }
}
if($_GET['status'] == 2){
    $query = 'UPDATE orderr SET Deliver_Day=current_timestamp() WHERE ID=' . $_GET['id'];
    $db->conn->query($query);
}
header('Location: ../order-detail.php?id=' . $_GET['id']);
?>