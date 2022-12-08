<?php require_once 'client/page_partials/head.php'; ?>
<?php
$db = new Database();
$query = 'SELECT * FROM `orderr` WHERE ID=' . $_GET['id'];
$result = $db->conn->query($query);
$row = $result->fetch_assoc();
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
}
?>
<main class="mt-5 pt-4">
    <div class="container min-height-650">
        <h2 class="mb-5 h2 text-center"><u>Đơn hàng của bạn</u></h2>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card border border-primary rounded">
                    <h3 class="h3 mt-3 pb-3 blue-text text-center"><u>Chi tiết đơn hàng</u></h3>
                    <form action="client/php-execute/edit-order.php?id=<?php echo $row['ID'] ?>" method="post">
                        <div class="pl-3 pr-3 pb-3 row justify-content-between">
                            <p class="pl-3"><b>Họ tên:</b></p>
                            <input type="text" name="name" class="d-block p-1 mr-3 border border-primary" required value="<?php echo $row['Name'] ?>">
                        </div>
                        <div class="pl-3 pr-3 pb-3 row justify-content-between">
                            <p class="pl-3"><b>Số điện thoại:</b></p>
                            <input type="text" name="phone" class="d-block p-1 mr-3 border border-primary" required value="<?php echo $row['Phone'] ?>">
                        </div>

                        <div class="pl-3 pr-3 pb-3 row justify-content-between">
                            <p class="pl-3"><b>Tổng tiền:</b></p>
                            <p class="pr-3"><?php echo number_format($row['Total'], 0, ',', '.') ?>đ</p>
                        </div>

                        <div class="pl-3 pr-3 row justify-content-between">
                            <p class="pl-3"><b>Địa chỉ:</b></p>
                            <input type="text" name="address" class="border border-primary form-control mr-3 ml-3" required value="<?php echo $row['Address'] ?>">
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

                        <div class="pl-4 pr-4 mb-3 row justify-content-between">
                            <button class="btn width-45 btn-primary" type="submit">Xác nhận</button>
                            <a class="btn width-45 btn-danger" onClick="deleteOrder(<?php echo $row['ID'] ?>)">Hủy đơn</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <?php
                $query = 'SELECT * FROM `order_list` WHERE Order_ID=' . $_GET['id'];
                $result = $db->conn->query($query);
                ?>
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Danh sách đặt mua</span>
                    <span class="badge badge-secondary badge-pill">
                        <?php echo $result->num_rows?>
                    </span>
                </h4>

                <!-- Cart -->
                <ul class="list-group mb-3 z-depth-1">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $query = 'SELECT * FROM `product` WHERE ID=' . $row['Product_ID'];
                        $result2 = $db->conn->query($query);
                        $item = $result2->fetch_assoc();
                        echo '<li class="list-group-item d-flex lh-condensed">
          <div class="mr-3">
            <img src="' . $item['Feature_Image_Path'] . '" alt="" class="cart-image">
          </div>
          <div class="mr-3 w-100">
            <h6 class="my-0"><a href="product-page.php?id=' . $item['ID'] . '">' . $item['Name'] . '</a></h6>
            <small class="text-muted">Số lượng: ' . $row['Amount'] . '</small>
          </div>
          <div class="d-block">
            <span class="text-muted">' . number_format($item['Price'], 0, ',', '.') . 'đ</span>
            <div class="d-flex btn-container">
              <a class="btn btn-info custom-button" href="client/php-execute/edit-order-items.php?action=add&id=' . $row['ID'] . '">+</a>
              <a class="btn btn-info custom-button" href="client/php-execute/edit-order-items.php?action=minus&id=' . $row['ID'] . '">-</a>
              <a class="btn btn-danger custom-button" href="client/php-execute/edit-order-items.php?action=remove&id=' . $row['ID'] . '">X</a>
            </div>
          </div>
        </li>';
                    } ?>
                </ul>
            </div>
        </div>
    </div>
</main>
<?php require_once 'client/page_partials/tail.php' ?>