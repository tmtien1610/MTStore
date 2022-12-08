<?php require_once 'client/page_partials/head.php' ?>
<!-- Navbar -->

<!--Main layout-->
<main class="mt-5 pt-4">
  <div class="container wow fadeIn min-height-650">

    <!-- Heading -->
    <h2 class="mb-5 h2 text-center">Checkout form</h2>

    <!--Grid row-->
    <div class="row">

      <!--Grid column-->
      <div class="col-md-6 mb-4">

        <!--Card-->
        <div class="card">

          <!--Card content-->
          <form class="card-body" action="./client/php-execute/checkout.php" method="post">

            <!--Grid row-->
            <div class="row">

              <!--Grid column-->
              <div class="col-md-6 mb-2">

                <!--firstName-->
                <div class="md-form ">
                  <input type="text" name="firstName" class="form-control" required>
                  <label for="firstName">Họ</label>
                </div>

              </div>
              <!--Grid column-->

              <!--Grid column-->
              <div class="col-md-6 mb-2">

                <!--lastName-->
                <div class="md-form">
                  <input type="text" name="lastName" class="form-control" required>
                  <label for="lastName">Tên</label>
                </div>

              </div>
              <!--Grid column-->

            </div>
            <!--Grid row-->

            <!-- Phone -->
            <div class="md-form mb-5">
              <input type="text" name="phone" class="form-control" required>
              <label for="phone">Số điện thoại</label>
            </div>

            <!--address-->
            <div class="md-form mb-5">
              <input type="text" name="address" class="form-control" placeholder="1234 Main St" required>
              <label for="address">Địa chỉ giao hàng:</label>
            </div>

            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Đặt hàng</button>
          </form>

        </div>
        <!--/.Card-->

      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-md-6 mb-4">

        <!-- Heading -->
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Giỏ hàng của bạn</span>
          <span class="badge badge-secondary badge-pill">
            <?php
            if (isset($_SESSION['cart']['count'])) {
              echo $_SESSION['cart']['count'];
            } else {
              echo 0;
            } ?>
          </span>
        </h4>

        <!-- Cart -->
        <ul class="list-group mb-3 z-depth-1 <?php if (!isset($_SESSION['cart']['count']) || $_SESSION['cart']['count'] == 0) {
                                                echo 'd-none';
                                              } ?>">
          <?php
          $total = 0;
          foreach ($_SESSION['cart']['items'] as $item) {
            echo '<li class="list-group-item d-flex lh-condensed">
          <div class="mr-3">
            <img src="' . $item['image'] . '" alt="" class="cart-image">
          </div>
          <div class="mr-3 w-100">
            <h6 class="my-0"><a href="product-page.php?id=' . $item['id'] . '">' . $item['name'] . '</a></h6>
            <small class="text-muted">Số lượng: ' . $item['amount'] . '</small>
          </div>
          <div class="d-block">
            <span class="text-muted">' . number_format($item['price'], 0, ',', '.') . 'đ</span>
            <div class="d-flex btn-container">
              <a class="btn btn-info custom-button" href="client/php-execute/edit-cart.php?action=add&id=' . $item['id'] . '">+</a>
              <a class="btn btn-info custom-button" href="client/php-execute/edit-cart.php?action=minus&id=' . $item['id'] . '">-</a>
              <a class="btn btn-danger custom-button" href="client/php-execute/edit-cart.php?action=remove&id=' . $item['id'] . '">X</a>
            </div>
          </div>
        </li>';
            $total += $item['price'] * $item['amount'];
          } ?>

          <li class="list-group-item d-flex justify-content-between 
          <?php if (!isset($_SESSION['cart']['count']) || $_SESSION['cart']['count'] == 0) {
            echo 'd-none';
          } ?>">
            <span>Tổng (VND)</span>
            <strong><?php echo number_format($total, 0, ',', '.');
                    $_SESSION['cart']['total'] = $total; ?>đ</strong>
          </li>
        </ul>
        <!-- Cart -->
      </div>
      <!--Grid column-->

    </div>
    <!--Grid row-->

  </div>
</main>
<!--Main layout-->

<?php require_once 'client/page_partials/tail.php' ?>