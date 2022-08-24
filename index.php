<?php 
include "koneksi.php";
if (isset($_POST['login'])) {
  $email    = $_POST['email'];
  $password = md5($_POST['password']);

  $sql = mysqli_query($con," SELECT * FROM user WHERE user_email = '$email' and user_password = '$password' ");
  if (mysqli_num_rows($sql) > 0) {
    $ses = mysqli_fetch_object($sql);
    $_SESSION['user_id']    = $ses->user_id;
    $_SESSION['user_nama']  = $ses->user_nama;
    echo "<script>window.location.href = 'home.php';</script>";
  }
  else
  {
    echo "<script>alert('Ops! User tidak ditemukan'); window.location.href = 'index.php';</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Monitoring Ketinggian Air - Login</title>

  <!-- Custom fonts for this template-->
  <link href="src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="src/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                    <h6>Masukan email dan password anda</h6>
                  </div>
                  <form class="user" method="post" action="">
                    <div class="form-group">
                      <input type="email" required="" class="form-control form-control-user" name="email" aria-describedby="emailHelp" placeholder="Masukan email anda">
                    </div>
                    <div class="form-group">
                      <input type="password" required="" class="form-control form-control-user" name="password" placeholder="Masukan password anda">
                    </div>
                    <div class="form-group">
                      
                    </div>
                    <button name="login" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="src/vendor/jquery/jquery.min.js"></script>
  <script src="src/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="src/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="src/js/sb-admin-2.min.js"></script>

</body>

</html>
