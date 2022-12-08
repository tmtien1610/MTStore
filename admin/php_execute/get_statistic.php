<?php
require '../database/database.php';
$db = new Database();
$time = $_GET['date'];
echo '<h2 class="w-100 text-center p-2"><b>Thống kê doanh thu chi tiết từ ngày ' . date('d-m-Y', strtotime($time)) . ' đến ngày ' . date('d-m-Y', strtotime("+1 Month", strtotime($time))) . '</b></h2>';


$query = 'SELECT * FROM `orderr` WHERE Deliver_Day > "' .
    date('Y-m-d', strtotime($time)) . '" AND Deliver_Day < "' .
    date('Y-m-d', strtotime("+1 Month", strtotime($time))) . '"';
$result = $db->conn->query($query);
if (mysqli_num_rows($result)) {
    echo '<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên hàng hóa</th>
            <th scope="col">Giá mua vào</th>
            <th scope="col">Giá bán ra</th>
            <th scope="col">Số lượng đã bán</th>
            <th scope="col">Lợi nhuận</th>
        </tr>
    </thead>
    <tbody>';
    $total = 0;
    $row = $result->fetch_assoc();
    $query = 'SELECT *, SUM(Amount) AS Total_Amount FROM `order_list` WHERE Order_ID=' . $row['ID'];
    while ($row = $result->fetch_assoc()) {
        $query = $query . ' OR Order_ID=' . $row['ID'];
    }
    $query = $query . ' GROUP BY Product_ID ORDER BY Total_Amount DESC';
    $prod_list = $db->conn->query($query);
    $i = 1;
    while ($prod = $prod_list->fetch_assoc()) {
        $query = 'SELECT Name, Price, I_Price FROM `product` WHERE ID=' . $prod['Product_ID'];
        $product = $db->conn->query($query)->fetch_assoc();
        $profit = ($product['Price'] - $product['I_Price']) * $prod['Total_Amount'];
        $total += $profit;
        echo '<tr>
    <th scope="row">' . $i . '</th>
    <td><a href="../product-page.php?id=' . $prod['Product_ID'] . '">' . $product['Name'] . '</a></td>
    <td style="color: red">' . number_format($product['I_Price'], 0, ',', '.') . 'đ</td>
    <td style="color: green">' . number_format($product['Price'], 0, ',', '.') . 'đ</td>
    <td>' . $prod['Total_Amount'] . '</td>
    <td style="color: green">' . number_format($profit, 0, ',', '.') . 'đ</td>
</tr>';
        $i += 1;
    }
    echo '<tr>
<th colspan="5">Tổng</th>
<td class="border-left" style="color: green">' . number_format($total, 0, ',', '.') . 'đ</td>
</tr>
</tbody>
</table>';
} else{
    echo '<h2 class="w-100 text-center p-2 mt-3" style="color: red">Không có báo cáo doanh thu cho khoảng thời gian này</h2>';
}
