<?php
require_once 'database/database.php';
$db = new Database();
if ($_REQUEST['table'] == 'staff') {
  $query = "SELECT * FROM Staff WHERE ID=" . $_GET['id'];
  $staff = $db->conn->query($query)->fetch_assoc();
  $query = "SELECT * FROM User WHERE ID=" . $staff['UserID'];
  $account = $db->conn->query($query)->fetch_assoc();
  echo '<div class="row">
    <div class="col-6">
        <form action="php_execute/update.php?table=staff&id=' . $_GET['id'] . '" method="post">
            <div class="form-group">
                <label for="fullname">Họ tên</label>
                <input type="text" class="form-control" required name="fullname" value="' . $staff['FullName'] . '" placeholder="Họ và Tên">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" required name="password" value="' . $account['Password'] . '" placeholder="Password">
            </div>
            <input type="text" class="d-none" required name="account_id" value="' . $account['ID'] . '">
            <div class="form-group">
                <label for="contact">Nhập Email hoặc số điện thoại</label>
                <input type="text" class="form-control" required name="contact" value="' . $staff['Contact'] . '" placeholder="Email hoặc số điện thoại">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>';
}
if ($_REQUEST['table'] == 'client') {
  $query = "SELECT * FROM customer WHERE ID=" . $_GET['id'];
  $client = $db->conn->query($query)->fetch_assoc();
  $query = "SELECT * FROM User WHERE ID=" . $client['UserID'];
  $account = $db->conn->query($query)->fetch_assoc();
  echo '<div class="row">
  <div class="col-6">
      <form action="php_execute/update.php?table=client&id=' . $_GET['id'] . '" method="post">
          <div class="form-group">
              <label for="fullname">Họ tên</label>
              <input type="text" class="form-control" required name="fullname" value="' . $client['FullName'] . '" placeholder="Họ và Tên">
          </div>
          <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" required name="password" value="' . $account['Password'] . '" placeholder="Password">
          </div>
          <input type="text" class="d-none" required name="account_id" value="' . $account['ID'] . '">
          <div class="form-group">
              <label for="contact">Nhập Email hoặc số điện thoại</label>
              <input type="text" class="form-control" required name="contact" value="' . $client['Contact'] . '" placeholder="Email hoặc số điện thoại">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
  </div>
</div>';
}
if ($_REQUEST['table'] == 'product') {
  $query = "SELECT * FROM Product WHERE ID=" . $_GET['id'];
  $product = $db->conn->query($query)->fetch_assoc();
  echo '<div class="row justify-content-between">
    <div class="col-6">
    <form action="php_execute/update.php?table=product&id=' . $_GET['id'] . '" method="post">
      <div class="form-group">
        <label for="name">Tên sản phẩm</label>
        <input type="text" class="form-control" required name="name" value="' . $product['Name'] . '" placeholder="Nhập tên sản phẩm">
      </div>

      <div class="form-group">
      <label for="categoryID">Loại sản phẩm</label>
      <select id="select-state" name="categoryID" placeholder="Chọn loại sản phẩm">
        <option value="">Chọn 1 loại</option>';
  $query = 'SELECT * FROM categories';
  $table = $db->conn->query($query);
  while ($row = $table->fetch_assoc()) {
    $select = '';
    if ($row['ID'] == $product['Category_ID']) {
      $select = 'selected';
    }
    echo '<option ' . $select . ' value="' . $row['ID'] . '">' . $row['Name'] . '</option>';
  }
  echo '</select>
      </div>

      <div class="form-group">
      <label for="brandID">Thương hiệu sản phẩm</label>
      <select id="select-state" onchange="showBrandAddForm(this.value)" name="brandID" placeholder="Chọn 1 thương hiệu">
        <option value="">Chọn 1 thương hiệu</option>
        <option value="0">--Thêm thương hiệu--</option>';
  $query = 'SELECT * FROM Brand';
  $table = $db->conn->query($query);
  while ($row = $table->fetch_assoc()) {
    $select = '';
    if ($row['ID'] == $product['Brand_ID']) {
      $select = 'selected';
    }
    echo '<option ' . $select . ' value="' . $row['ID'] . '">' . $row['Brand'] . '</option>';
  }
  echo '</select>
      </div>

      <div class="form-group">
        <label for="iprice">Giá nhập sản phẩm</label>
        <input type="number" class="form-control" value="' . $product['I_Price'] . '" required name="iprice" placeholder="Giá nhập">
      </div>

      <div class="form-group">
        <label for="price">Giá bán sản phẩm</label>
        <input type="number" class="form-control" value="' . $product['Price'] . '" required name="price" placeholder="Giá bán">
      </div>

      <div class="form-group">
        <label for="quantity">Nhập số lượng thêm vào<br>Số lượng hiện tại: ' . $product['Amount'] . '</label>
        <input type="number" class="form-control" required name="quantity" placeholder="Số lượng sản phẩm nhập kho" value="0">
      </div>

      <div class="form-group">
        <label for="desciption">Mô tả sản phẩm</label>
        <textarea name="description" class="form-control" rows="5">' . $product['Description'] . '</textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
    <div class="col-4 d-none" id="add-brand-form">
      <form action="php_execute/add.php?action=add-brand" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="brand">Tên thương hiệu</label>
          <input type="text" class="form-control" required name="brand" placeholder="Nhập tên sản phẩm">
        </div>
        <div class="form-group">
          <label for="logo">Logo</label>
          <input type="file" class="form-control" required name="logo">
        </div>
        <button type="submit" id="submit-button" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>';
}
