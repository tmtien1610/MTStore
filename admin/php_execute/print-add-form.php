<?php
include_once 'database/database.php';
$db = new Database();
if ($_REQUEST['table'] == 'staff') {
  echo '<div class="row">
    <div class="col-6">
        <form action="php_execute/add.php?action=add-staff" method="post">
            <div class="form-group">
                <label for="fullname">Họ tên</label>
                <input type="text" class="form-control" required name="fullname" placeholder="Họ và Tên">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" required name="username" placeholder="Nhập username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" required name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="contact">Nhập Email hoặc số điện thoại</label>
                <input type="text" class="form-control" required name="contact" placeholder="Email hoặc số điện thoại">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>';
}
if ($_REQUEST['table'] == 'client') {
  echo '<div class="row">
    <div class="col-6">
    <form action="php_execute/add.php?action=add-client" method="post">
      <div class="form-group">
        <label for="fullname">Họ tên</label>
        <input type="text" class="form-control" required name="fullname" placeholder="Họ và Tên">
      </div>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" required name="username" placeholder="Nhập username">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" required name="password" placeholder="Password">
      </div>
      <div class="form-group">
        <label for="contact">Nhập Email hoặc số điện thoại</label>
        <input type="text" class="form-control" required name="contact" placeholder="Email hoặc số điện thoại">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</div>';
}
if ($_REQUEST['table'] == 'product') {
  echo '<div class="row justify-content-between">
    <div class="col-6">
    <form action="php_execute/add.php?action=add-product" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Tên sản phẩm</label>
        <input type="text" class="form-control" required name="name" placeholder="Nhập tên sản phẩm">
      </div>

      <div class="form-group">
      <label for="categoryID">Loại sản phẩm</label>
      <select id="select-state" name="categoryID" placeholder="Chọn loại sản phẩm">
        <option value="">Chọn 1 loại</option>';
  $query = 'SELECT * FROM categories';
  $table = $db->conn->query($query);
  while ($row = $table->fetch_assoc()) {
    echo '<option value="' . $row['ID'] . '">' . $row['Name'] . '</option>';
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
    echo '<option value="' . $row['ID'] . '">' . $row['Brand'] . '</option>';
  }
  echo '</select>
      </div>

      <div class="form-group">
        <label for="iprice">Giá nhập sản phẩm</label>
        <input type="number" class="form-control" required name="iprice" placeholder="Giá nhập">
      </div>

      <div class="form-group">
        <label for="price">Giá bán sản phẩm</label>
        <input type="number" class="form-control" required name="price" placeholder="Giá bán">
      </div>

      <div class="form-group">
        <label for="quantity">Nhập số lượng sản phẩm</label>
        <input type="number" class="form-control" required name="quantity" placeholder="Số lượng sản phẩm">
      </div>

      <div class="form-group">
        <label for="featureImage">Ảnh đại diện</label>
        <div class="custom-file">
          <input type="file" class="custom-file-input" required name="featureImage">
          <label class="custom-file-label" for="featureImage">Chọn ảnh đại diện</label>
        </div>
      </div>

      <div class="form-group">
        <label for="desciption">Mô tả sản phẩm</label>
        <textarea name="description" class="form-control" rows="5"></textarea>
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
