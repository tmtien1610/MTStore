<?php require_once 'client/page_partials/head.php' ?>
<?php require_once 'auth-check.php' ?>


<?php
$db = new Database();
$query = 'SELECT * FROM `product` WHERE ID=' . $_GET['id'];
$result = $db->conn->query($query);
$product = $result->fetch_assoc();
$query = 'SELECT * FROM `brand` WHERE ID=' . $product['Brand_ID'];
$result = $db->conn->query($query);
$brand = $result->fetch_assoc();
?>
<!--Main layout-->
<main class="mt-2 pt-2">
  <div class="container dark-grey-text mt-5">

    <!--Grid row-->
    <div class="row wow fadeIn">

      <!--Grid column-->
      <div class="col-md-6 mb-4">
        <img src="<?php echo $product['Feature_Image_Path']; ?>" class="img-fluid" alt="">
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-md-6 mb-4">

        <!--Content-->
        <div class="p-4">
          <h1 class="blue-text font-weight-bold"><?php echo $product['Name'] ?></h1>

          <div class="mb-3 font-weight-bold">
            <span><img class="logo" src="<?php echo $brand['Brand_Icon_Image_Path']; ?>" alt=""></span>
            <?php echo $brand['Brand']; ?>
          </div>

          <p class="lead">
            <span><?php echo number_format($product['Price'], 0, ',', '.') . 'đ' ?></span>
          </p>
          <p class="grey-text">
            Số lượng còn lại: <?php echo $product['Amount']; ?>
          </p>
          <p class="lead font-weight-bold">Mô tả</p>

          <p class="description wow fadeIn"><?php echo $product['Description'] ?></p>
          <a href="#description" class="d-flex justify-content-center mb-3">Xem thêm ▼</a>
          <form class="d-flex justify-content-left" name="cart">
            <!-- Default input -->
            <input type="number" value="1" aria-label="Search" name="amount" class="form-control" style="width: 100px">
            <button class="btn btn-primary btn-md my-0 p" onClick="addCart(<?php echo $_GET['id'] . ', ' . $product['Amount']; ?>);">Thêm vào giỏ hàng
              <i class="fas fa-shopping-cart ml-1"></i>
            </button>
          </form>

        </div>
        <!--Content-->

      </div>
      <!--Grid column-->

    </div>
    <!--Grid row-->

    <hr>

    <!--Grid row-->
    <div class="row d-flex justify-content-center wow fadeIn">

      <!--Grid column-->
      <div class="col-md-12">

        <h4 class="my-4 h4 text-center">Thông tin chi tiết</h4>

        <p class="text-justify" id="description"><?php echo $product['Description'] ?></p>

      </div>
      <!--Grid column-->

    </div>
    <!--Grid row-->

    <!-- Grid row -->
    <!-- <div class="row wow fadeIn"> -->

    <!--Grid column-->
    <!-- <div class="col-lg-4 col-md-12 mb-4">

        <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/11.jpg" class="img-fluid" alt="">

      </div> -->
    <!--Grid column-->

    <!--Grid column-->
    <!-- <div class="col-lg-4 col-md-6 mb-4">

        <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/12.jpg" class="img-fluid" alt="">

      </div> -->
    <!--Grid column-->

    <!--Grid column-->
    <!-- <div class="col-lg-4 col-md-6 mb-4">

        <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/13.jpg" class="img-fluid" alt="">

      </div> -->
    <!--Grid column-->

    <!-- </div>  -->
    <!--Grid row-->

  </div>
</main>
<!--Main layout-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php require 'client/page_partials/tail.php' ?>