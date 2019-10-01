<?php
session_start();
//Skrip koneksi
include '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Login | AnjasStore</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/css/dashboard.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/all.min.js"></script>
  </head>
  <body>

    <div class="col-md-4 col-md-offset-4" style="margin-top:50px">
      <center>
        <a href="../index.php"><h2 style="font-family:'Lobster', cursive;font-size:50px;color:#b49dc2">AnjasStore</h2></a>
        <h2 style="margin-top:10px;margin-bottom:20px">ADMIN LOGIN</h2>
      </center>

      <div class="panel panel-default">
        <div class="panel-body" style="padding-top:30px">
          <form role="form" method="post">
            <div class="form-group">
              <label>Username :</label>
              <input class="form-control" type="text" name="user" required>
            </div>
            <div class="form-group">
              <label>Password :</label>
              <input class="form-control" type="password" name="pass" required>
            </div>
            <div class="form-group">
              <label class="checkbox-inline">
                <input type="checkbox"> Remember me
              </label>
              <span class="pull-right">
                <a href="#">Forget Password?</a>
              </span>
            </div>
            <button name="login" class="btn btn-main">Login</button>
          </form>
          <?php
            if (isset($_POST['login']))
            {
              $ambil = $koneksi->query("SELECT * FROM admin WHERE username='$_POST[user]' AND password='$_POST[pass]'");
              $yangcocok = $ambil->num_rows;
              if ($yangcocok==1)
              {
                $_SESSION['admin']=$ambil->fetch_assoc();
                echo "<div class='alert alert-info'>Login Sukses</div>";
                echo "<meta http-equiv='refresh' content='1;url=index.php'>";
              }
              else
              {
                echo "<div class='alert alert-danger'>Login Gagal</div>";
                echo "<meta http-equiv='refresh' content='1;url=login.php'>";
              }
            }
          ?>
        </div>
      </div>
    </div>

  </body>
</html>
