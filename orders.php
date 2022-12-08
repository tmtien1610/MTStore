<?php require_once 'client/page_partials/head.php'; ?>
<?php
$query = 'SELECT * FROM `orderr` WHERE User_ID=' . $_SESSION['id'] . ' ORDER BY Status';
$db = new Database();
$result = $db->conn->query($query);
?>
<main class="mt-5 pt-4">
    <div class="container wow fadeIn min-height-650">
        <h2 class="mb-5 h2 text-center"><u>Đơn hàng của bạn</u></h2>
        <div class="row">
            <?php
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

                    <div class="pl-4 pr-4 mb-3 row justify-content-between ' . $btn_display . '">
                        <a class="btn width-45 btn-primary" href="order-list.php?id=' . $row['ID'] . '">Chỉnh sửa</a>
                        <a class="btn width-45 btn-danger" onClick="deleteOrder(' . $row['ID'] . ')">Hủy đơn</a>
                    </div>
                </div>
            </div>';
            }
            ?>

        </div>
    </div>
</main>

<?php require_once 'client/page_partials/tail.php' ?>