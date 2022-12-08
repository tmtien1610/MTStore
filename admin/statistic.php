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
        <div class="wrapper h-100">
            <?php require_once 'auth-check.php'; ?>
            <?php require_once 'page_partials/nav-n-sidebar.php'; ?>
            <?php require_once 'database/database.php'; ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <section class="pt-3 content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date">Nhập ngày bắt đầu</label>
                                    <input type="date" class="form-control" required id="date" placeholder="dd-mm-yyyy">
                                </div>
                                <a class="btn btn-primary mb-2" onclick="getStatistic()">Nhận thống kê</a>
                            </div>
                        </div>
                        <div class="row" id="result">
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