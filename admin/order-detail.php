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
    <link rel="stylesheet" href="./css/custom-css.css">
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
                            <div class="col-md-6 mb-4">
                                <?php
                                $db = new Database();
                                $query = 'SELECT * FROM `order_list` WHERE Order_ID=' . $_GET['id'];
                                $result = $db->conn->query($query);
                                ?>
                                <h4 class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">Danh sách đặt mua</span>
                                    <span class="badge badge-secondary badge-pill">
                                        <?php echo $result->num_rows ?>
                                    </span>
                                </h4>
                                <ul class="list-group mb-3 z-depth-1">
                                    <?php
                                    $confirm_error = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        $query = 'SELECT * FROM `product` WHERE ID=' . $row['Product_ID'];
                                        $result2 = $db->conn->query($query);
                                        $item = $result2->fetch_assoc();
                                        if ($row['Amount'] > $item['Amount']){
                                            $confirm_error = 1;
                                        }
                                        echo '<li class="list-group-item d-flex lh-condensed">
          <div class="mr-3">
            <img src="' . $item['Feature_Image_Path'] . '" alt="" class="cart-image">
          </div>
          <div class="mr-3 w-100">
            <h6 class="my-0"><p>' . $item['Name'] . '</p></h6>
            <small class="text-muted">Số lượng: ' . $row['Amount'] . '</small>
            <small class="text-muted"><br>Số lượng còn lại: ' . $item['Amount'] . '</small>
          </div>
          <div class="d-block">
            <span class="text-muted">' . number_format($item['Price'], 0, ',', '.') . 'đ</span>
          </div>
        </li>';
                                    } ?>
                                </ul>
                            </div>
                            <?php
                            $query = 'SELECT * FROM `orderr` WHERE ID=' . $_GET['id'];
                            $result = $db->conn->query($query);
                            $row = $result->fetch_assoc();
                            if ($row['Status'] == 0) {
                                $status = 'Đang chờ xác nhận';
                                $d_day = '-';
                            }
                            if ($confirm_error == 1){
                                $status = 'Không đủ lượng hàng';
                                $d_day = '-';
                            }
                            if ($row['Status'] == 1) {
                                $status = 'Đang vận chuyển';
                                $d_day = '-';
                            }
                            if ($row['Status'] == 2) {
                                $status = 'Đã giao';
                                $d_day = $row['Deliver_Day'];
                            }
                            ?>
                            <div class="col-md-6 mb-4">
                                <div class="card border border-primary rounded">
                                    <h3 class="h3 mt-3 pb-3 blue-text text-center"><u>Chi tiết đơn hàng</u></h3>
                                    <div class="pl-3 pr-3 pb-3 row justify-content-between">
                                        <p class="pl-3"><b>Họ tên:</b></p>
                                        <p class="pr-3"><?php echo $row['Name'] ?></p>
                                    </div>
                                    <div class="pl-3 pr-3 pb-3 row justify-content-between">
                                        <p class="pl-3"><b>Số điện thoại:</b></p>
                                        <p class="pr-3"><?php echo $row['Phone'] ?></p>
                                    </div>

                                    <div class="pl-3 pr-3 pb-3 row justify-content-between">
                                        <p class="pl-3"><b>Tổng tiền:</b></p>
                                        <p class="pr-3"><?php echo number_format($row['Total'], 0, ',', '.') ?>đ</p>
                                    </div>

                                    <div class="pl-3 pr-3 row justify-content-between">
                                        <p class="pl-3"><b>Địa chỉ:</b></p>
                                        <p class="pr-3"><?php echo $row['Address'] ?></p>
                                    </div>

                                    <hr class="ml-3 mr-3">

                                    <div class="pl-3 pr-3 row justify-content-between">
                                        <p class="pl-3"><b>Ngày lập hóa đơn:</b></p>
                                        <p class="pr-3"><?php echo $row['Make_Day'] ?></p>
                                    </div>

                                    <div class="pl-3 pr-3 row justify-content-between">
                                        <p class="pl-3"><b>Ngày giao hàng:</b></p>
                                        <p class="pr-3"><?php echo $d_day ?></p>
                                    </div>

                                    <div class="pl-3 pr-3 row justify-content-between">
                                        <p class="pl-3"><b>Trạng thái:</b></p>
                                        <p class="pr-3"><?php echo $status ?></p>
                                    </div>

                                    <div class="pl-4 pr-4 mb-3 row justify-content-between <?php if ($row['Status'] == 2) {
                                                                                                echo 'd-none';
                                                                                            } ?>">
                                        <?php
                                        if ($row['Status'] == 0 && $confirm_error == 0) {
                                            echo '<a class="btn width-45 btn-primary" href="php_execute/confirm.php?id=' . $row['ID'] . '&status=1">Xác nhận</a>';
                                            echo '<a class="btn width-45 btn-danger" onClick="deleteOrder(' . $row['ID']  . ')">Hủy đơn</a>';
                                        }
                                        if ($row['Status'] == 1) {
                                            echo '<a class="btn width-45 btn-primary" href="php_execute/confirm.php?id=' . $row['ID'] . '&status=2">Xác nhận đã giao hàng</a>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <script src="https://kit.fontawesome.com/bc4c6e35db.js" crossorigin="anonymous"></script>
    </body>

</html>