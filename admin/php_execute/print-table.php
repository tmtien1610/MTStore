<?php
include_once 'database/database.php';
$database = new Database();

if($_REQUEST['table'] == 'client'){
    $query = "SELECT ID, FullName, Contact FROM Customer";
    $table = $database->conn->query($query);
    echo '
            <a href="add.php?table=client" class="btn btn-success m-3 float-right">Add</a>
            <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Full Name</th>
                <th scope="col">Contact</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>';
    while($row = $table->fetch_assoc()){
        echo '
        <tr id="row-id-' . $row['ID'] . '" class="client">
        <th scope="row">'. $row['ID'] .'</th>
        <td>' . $row['FullName'] . '</td>
        <td>' . $row['Contact'] . '</td>
        <td>
            <a href="./edit.php?table=client&id=' . $row['ID'] . '" class="btn btn-primary btn-sm">Edit</a>
            <a onclick="deleteButton(' . $row['ID'] . ')" class="btn btn-danger btn-sm">Delete</a>
        </td>
        </tr>';
    }
    echo '
        </tbody>
        </table>';
}
if($_REQUEST['table'] == 'staff'){
    $query = "SELECT ID, FullName, Contact FROM Staff";
    $table = $database->conn->query($query);
    echo '
            <a href="add.php?table=staff" class="btn btn-success m-3 float-right">Add</a>
            <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Full Name</th>
                <th scope="col">Contact</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>';
    while($row = $table->fetch_assoc()){
        echo '
        <tr id="row-id-' . $row['ID'] . '" class="staff">
        <th scope="row">'. $row['ID'] .'</th>
        <td>' . $row['FullName'] . '</td>
        <td>' . $row['Contact'] . '</td>
        <td>
            <a href="./edit.php?table=staff&id=' . $row['ID'] . '" class="btn btn-primary btn-sm">Edit</a>
            <a href="#" onclick="deleteButton(' . $row['ID'] . ')" class="btn btn-danger btn-sm">Delete</a>
        </td>
        </tr>';
    }
    echo '
        </tbody>
        </table>';
}
if($_REQUEST['table'] == 'product'){
    $query = "SELECT * FROM Product";
    $table = $database->conn->query($query);
    echo '
            <a href="add.php?table=product" class="btn btn-success m-3 float-right">Add</a>
            <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Thương hiệu</th>
                <th scope="col">Giá nhập</th>
                <th scope="col">Giá bán</th>
                <th scope="col">Loại</th>
                <th scope="col">Ảnh đại diện</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>';
    while($row = $table->fetch_assoc()){
        $query = 'SELECT Brand FROM Brand WHERE ID = ' . $row['Brand_ID'];
        $result = $database->conn->query($query);
        $brand = $result->fetch_assoc();
        $query = 'SELECT Name FROM Categories WHERE ID = ' . $row['Category_ID'];
        $result = $database->conn->query($query);
        $category = $result->fetch_assoc();
        echo '
        <tr id="row-id-' . $row['ID'] . '" class="product" >
        <th scope="row" class="align-middle">'. $row['ID'] .'</th>
        <td class="align-middle"><a href="../product-page.php?id=' . $row['ID'] . '">' . $row['Name'] . '</a></td>
        <td class="align-middle">' . $brand['Brand'] . '</td>
        <td class="align-middle">' . number_format($row['Price'], 0, ',', '.') . 'đ</td>
        <td class="align-middle">' . number_format($row['I_Price'], 0, ',', '.') . 'đ</td>
        <td class="align-middle">' . $category['Name'] . '</td>
        <td class="align-middle"><img src="' . $row['Feature_Image_Path'] . '" class="feature-img"></td>
        <td class="align-middle">' . $row['Amount'] . '</td>
        <td class="align-middle">
            <a href="./edit.php?table=product&id=' . $row['ID'] . '" class="btn btn-primary btn-sm w-75">Edit</a>
            <a onclick="deleteButton(' . $row['ID'] . ')" class="btn btn-danger btn-sm mt-2 w-75">Delete</a>
        </td>
        </tr>';
    }
    echo '
        </tbody>
        </table>';
}

?>