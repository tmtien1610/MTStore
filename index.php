<?php require_once 'client/page_partials/head.php' ?>
<?php require_once 'client/page_partials/slider.php' ?>

<?php
if (isset($_GET['ct'])) {
  $ct = $_GET['ct'];
} else {
  $ct = 0;
}
$sub_query = '';
if ($ct != 0) {
  $sub_query = 'WHERE Category_ID = ' . $ct;
}
$db = new Database;
$query = "SELECT * FROM `categories` ORDER BY ID";
$result = $db->conn->query($query);
$query = "SELECT Brand_ID FROM product " . $sub_query . " GROUP BY Brand_ID";
$result2 = $db->conn->query($query);

if (isset($_GET['br'])) {
  $br = $_GET['br'];
} else {
  $br = 0;
}
?>
<!--Main layout-->
<main>
  <div class="container p-0" id="products">

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3">
      <!-- Collapsible content -->
      <div class="collapse navbar-collapse content-right" id="basicExampleNav">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php if ($ct == 0) {
                                echo 'active disabled';
                              } ?>">
            <a class="nav-link" href="?ct=0">All</a>
          </li>
          <?php
          while ($row = $result->fetch_assoc()) {
            echo '<li class="nav-item ';
            if ($ct == $row['ID']) {
              echo 'active disabled';
            }
            echo '">
            <a class="nav-link" href="?ct=' . $row['ID'] . '">' . $row['Name'] . '</a>
          </li>';
          }
          ?>
        </ul>
      </div>
    </nav>
    <div class="w-100 ml-1 row wow fadeIn brand-wrapper mb-3">
      <?php
      while ($row = $result2->fetch_assoc()){
        $query = "SELECT * FROM brand WHERE ID=" . $row['Brand_ID'];
        $brand = $db->conn->query($query)->fetch_assoc();
        echo '<a href="?ct=' . $ct . '&br=' . $brand['ID'] . '" class="brand-link waves-effect waves-dark"><span><img class="logo mr-1" src=' . $brand['Brand_Icon_Image_Path'] . ' alt=""></span>' . $brand['Brand'] . '</a>';
      }
      echo '<a href="?ct=' . $ct . '" class="brand-link waves-effect waves-dark">All</a>';
      ?>
      
    </div>
    <!--/.Navbar-->
    <?php require 'client/php-execute/load-cards.php'; ?>
  </div>
</main>
<script type="text/javascript" src="client/js/load-product.js"></script>
<?php require 'client/page_partials/tail.php' ?>