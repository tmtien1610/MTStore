<?php
    function add(){
        $conn = new mysqli("localhost", "root", "", "mtstore");
        $query = "INSERT INTO KhachHang (HoTenKH, Password, DiaChi, SoDienThoai)
        VALUE ('" . $_POST["name"] . "','" . $_POST["password"] . "','" . $_POST["address"] . "','" . $_POST["phonenumber"] . "');";
        if ($conn->query($query) === TRUE) {
            echo "Tạo bản ghi thành công\n";
        } else {
            echo "Error inserting data: " . $conn->error . "\n";
        }
        $conn->close();
    }
    if(isset($_POST['add'])){
        add();
    }
    
?>