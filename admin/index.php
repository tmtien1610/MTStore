<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../assets/css/adminlte.min.css">
</head>

<body>

  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <?php require 'auth-check.php'; ?>
      <?php require 'page_partials/nav-n-sidebar.php'; ?>
      <?php require 'database/database.php'; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <section class="pt-3 content">
          <div class="container-fluid">
            <div class="row">
              <?php
              $db = new Database();
              $query = 'SELECT * FROM orderr ORDER BY Status';
              $result = $db->conn->query($query);
              while ($row = $result->fetch_assoc()) {
                $btn_display = '';
                if ($row['Status'] == 0) {
                  $status = 'Đang chờ xác nhận';
                  $d_day = '-';
                }
                if ($row['Status'] == 1) {
                  $status = 'Đang vận chuyển';
                  $d_day = '-';
                }
                if ($row['Status'] == 2) {
                  $status = 'Đã giao';
                  $d_day = $row['Deliver_Day'];
                  $btn_display = 'd-none';
                }
                echo '<div class="col-md-4 mb-4" id="order-' . $row['ID'] . '">
        <div class="card border border-primary rounded">
            <h3 class="h3 mt-3 blue-text text-center"><u>Chi tiết đơn hàng</u></h3>
            <div class="pl-3 pr-3 row justify-content-between">
                <p class="pl-3"><b>Họ tên:</b></p>
                <p class="pr-3">' . $row['Name'] . '</p>
            </div>

            <div class="pl-3 pr-3 row justify-content-between">
                <p class="pl-3"><b>Số điện thoại:</b></p>
                <p class="pr-3">' . $row['Phone'] . '</p>
            </div>

            <div class="pl-3 pr-3 row justify-content-between">
                <p class="pl-3"><b>Tổng tiền:</b></p>
                <p class="pr-3">' . number_format($row['Total'], 0, ',', '.') . 'đ</p>
            </div>

            <div class="pl-3 pr-3 row justify-content-between">
                <p class="pl-3"><b>Địa chỉ:</b></p>
                <p class="pr-3 pl-3 w-100">' . $row['Address'] . '</p>
            </div>

            <hr class="ml-3 mr-3">

            <div class="pl-3 pr-3 row justify-content-between">
                <p class="pl-3"><b>Ngày lập hóa đơn:</b></p>
                <p class="pr-3">' . $row['Make_Day'] . '</p>
            </div>

            <div class="pl-3 pr-3 row justify-content-between">
                <p class="pl-3"><b>Ngày giao hàng:</b></p>
                <p class="pr-3">' . $d_day . '</p>
            </div>

            <div class="pl-3 pr-3 row justify-content-between">
                <p class="pl-3"><b>Trạng thái:</b></p>
                <p class="pr-3">' . $status . '</p>
            </div>

            <div class="pl-4 pr-4 mb-3 row justify-content-between">
                <a class="btn btn-primary" href="order-detail.php?id=' . $row['ID'] . '">Chi tiết</a>
                <a class="btn btn-danger ' . $btn_display . '" onClick="deleteOrder(' . $row['ID'] . ')">Xóa đơn</a>
            </div>
        </div>
    </div>';
              }
              ?>
            </div>
          </div>
        </section>

      </div>
    </div>
    <script src="https://kit.fontawesome.com/bc4c6e35db.js" crossorigin="anonymous"></script>
    <script src="js/all.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>

</html>