<?php
session_start();
include_once '../objects/staff.php';
include_once '../objects/client.php';
include_once '../objects/product.php';
$action = $_REQUEST['action'];
if ($action == "add-staff"){
    $staff = new Staff($_POST['fullname'], $_POST['username'], $_POST['password'], $_POST['contact']);
    $staff->add();
    header('location: ../list-of-content.php?table=staff');
}
if ($action == "add-client"){
    $client = new Client($_POST['fullname'], $_POST['username'], $_POST['password'], $_POST['contact']);
    $client->add();
    header('location: ../list-of-content.php?table=client');
}
if ($action == "add-product"){
    $db_storage_dir_name = '/MTStore/assets/images/';
    $storage_dir = $_SERVER['DOCUMENT_ROOT'] . $db_storage_dir_name;
    $file_path = $storage_dir . basename($_FILES["featureImage"]["name"]);
    $db_file_path = $db_storage_dir_name . basename($_FILES["featureImage"]["name"]);
    $upload = 1;
    if (file_exists($file_path)){
        $upload = 0;
    }
    $product = new Product($_POST['name'], $_POST['brandID'], $_POST['price'], $_POST['iprice'], $_POST['quantity'], $_POST['description'], $_POST['categoryID'], $db_file_path, $_SESSION['a_id']);
    $product->add();
    if ($upload == 1) {
        move_uploaded_file($_FILES["featureImage"]["tmp_name"], $file_path);
    }
    header('location: ../list-of-content.php?table=product');
}
if($action == 'add-brand'){
    $db_storage_dir_name = '/MTStore/assets/images/';
    $storage_dir = $_SERVER['DOCUMENT_ROOT'] . $db_storage_dir_name;
    $file_path = $storage_dir . basename($_FILES["logo"]["name"]);
    $db_file_path = $db_storage_dir_name . basename($_FILES["logo"]["name"]);
    $db = new Database();
    $upload = 1;
    if (file_exists($file_path)) {
        $upload = 0;
    }
    $query = 'INSERT IGNORE INTO Brand (Brand, Brand_Icon_Image_Path) VALUE("' . $_POST['brand'] . '", "' . $db_file_path . '")';
    $db->conn->query($query);
    if ($upload == 1) {
        move_uploaded_file($_FILES["logo"]["tmp_name"], $file_path);
    }
    header('location: ../add.php?table=product');
}
?>