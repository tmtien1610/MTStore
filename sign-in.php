<?php
ob_start();
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/templates/login-form-18/css/style.css">
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Login</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <?php
                        include_once 'admin/database/database.php';
                        $db = new Database();
                        if (isset($_POST['login'])){
                            $query = 'SELECT * FROM User WHERE User.UserName = "' . $_POST['username'] . '"';
                            $result = $db->conn->query($query);
                            if(mysqli_num_rows($result) == 0){
                                echo 'Sai tên đăng nhập';
                            }else{
                                $user = $result->fetch_assoc();
                                if($user['Password'] != $_POST['password']){
                                    echo 'Sai mật khẩu';
                                }else{
                                    if($user['role'] == 1){
                                        $_SESSION['access'] = 1;
                                        $_SESSION['id'] = $user['ID'];
                                        $_SESSION['role'] = $user['role'];
                                        $_SESSION['username'] = $user['UserName'];
                                        $query = 'SELECT * FROM Staff WHERE Staff.UserID = "' . $_SESSION['id'] . '"';
                                        $result = $db->conn->query($query);
                                        $user = $result->fetch_assoc();
                                        $_SESSION['a_id'] = $user['ID'];
                                        $_SESSION['name'] = $user['FullName'];
                                        $_SESSION['contact'] = $user['Contact'];
                                        header('location: admin');
                                    }else{
                                        $_SESSION['access'] = 1;
                                        $_SESSION['id']=$user['ID'];
                                        $_SESSION['role'] = $user['role'];
                                        $_SESSION['username'] = $user['UserName'];
                                        $query = 'SELECT * FROM Customer WHERE Customer.UserID = "' . $_SESSION['id'] . '"';
                                        $result = $db->conn->query($query);
                                        $user = $result->fetch_assoc();
                                        $_SESSION['c_id'] = $user['ID'];
                                        $_SESSION['name'] = $user['FullName'];
                                        $_SESSION['contact'] = $user['Contact'];
                                        header('location: index.php');
                                    }
                                }
                            }
                        }
                        ?>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="login-form">
                            <div class="form-group">
                                <input type="text" class="form-control rounded-left" name="username" placeholder="Username" required>
                            </div>
                            <div class="form-group d-flex">
                                <input type="password" class="form-control rounded-left" name="password" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="login" class="btn btn-primary rounded submit p-3 px-5">Log in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="./assets/templates/login-form-18/js/jquery.min.js"></script>
    <script src="./assets/templates/login-form-18/js/popper.js"></script>
    <script src="./assets/templates/login-form-18/js/bootstrap.min.js"></script>
    <script src="./assets/templates/login-form-18/js/main.js"></script>
</body>

</html>