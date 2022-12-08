<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../assets/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
</head>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php require 'auth-check.php';?>
    <?php require 'page_partials/nav-n-sidebar.php'; ?>

    <div class="content-wrapper">
      <section class="pt-3 content">
        <div class="container-fluid">
          <?php include_once 'php_execute/print-add-form.php'; ?>
        </div>
      </section>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/bc4c6e35db.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      $('select').selectize({
        sortField: 'text'
      });
    });
  </script>
  <script>
    function showBrandAddForm(str) {
      if (str == "0") {
        var element = document.getElementById("add-brand-form");
        element.classList.remove("d-none");
      } else{
        var element = document.getElementById("add-brand-form");
        element.classList.add("d-none");
      }
    }
  </script>
</body>

</html>