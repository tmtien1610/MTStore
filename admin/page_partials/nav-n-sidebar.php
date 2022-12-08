  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="./" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../" class="nav-link">Client page</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../sign-out.php" class="nav-link">Đăng xuất</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <span class="brand-text ml-3 font-weight-bold">MTStore</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="index.php" class="nav-link <?php if(!isset($_GET['table'])){echo 'active';}?>">
              <p>
                Đơn hàng
              </p>
            </a>
          </li>  
        <li class="nav-item">
            <a href="list-of-content.php?table=client" class="nav-link <?php if(isset($_GET['table'])){if($_GET['table'] == 'client'){ echo 'active';}}?>">
              <p>
                Khách Hàng
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="list-of-content.php?table=staff" class="nav-link <?php if(isset($_GET['table'])){if($_GET['table'] == 'staff'){ echo 'active';}}?>">
              <p>
                Nhân Viên
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="list-of-content.php?table=product" class="nav-link <?php if(isset($_GET['table'])){if($_GET['table'] == 'product'){ echo 'active';}}?>">
              <p>
                Hàng hóa
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="statistic.php?table=statistics" class="nav-link <?php if(isset($_GET['table'])){if($_GET['table'] == 'statistics'){ echo 'active';}}?>">
              <p>
                Thống kê doanh thu
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>