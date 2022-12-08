<?php
require_once '../database/database.php';
class Product{
    private $name;
    private $brandID;
    private $price;
    private $quantity;
    private $description;
    private $featureImagePath;
    private $database;
    private $iprice;
    private $staffID;
    private $categoryID;
    function __construct($name, $brandID, $price, $iprice, $quantity, $description, $categoryID, $featureImagePath, $staffID){
        $this->name = $name;
        $this->brandID = $brandID;
        $this->price = $price;
        $this->iprice = $iprice;
        $this->quantity = $quantity;
        $this->description = $description;
        $this->featureImagePath = $featureImagePath;
        $this->staffID = $staffID;
        $this->categoryID = $categoryID;
        $this->database = new Database();
    }
    function add(){
        $query = 'INSERT INTO Product (Name, Price, I_Price, Brand_ID, Amount, Description, Category_ID, Feature_Image_Path, Staff_ID) 
        VALUE ("' . $this->name . '", "' . $this->price . '", "' . $this->iprice . '", "'
        . $this->brandID . '", "' . $this->quantity . '", "' . $this->description . '", "'
        . $this->categoryID . '", "' . $this->featureImagePath . '", "' . $this->staffID . '")';
        $this->database->conn->query($query);
    }
}
?>