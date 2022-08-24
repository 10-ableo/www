<?php 
  include "koneksi.php";
  //cek apakah user sudah login atau belum, jika belum maka arahkan ke halaman login
  if (empty($_SESSION['user_id'])) {
    echo "<script>alert('Ops! Anda belum login'); window.location.href = 'index.php';</script>";
  }
  $page = 'home.php';

  //cek apakah ada parameter p yang dikirim dengan method get, jika ada maka masuk ke pengkondisian dibawahnya
  if (isset($_GET['p'])) {
    if ($_GET['p'] == 'air') {
      $page = 'air.php'; //untuk menentukan nama file di folder page
    }
    elseif ($_GET['p'] == 'grafik') {
      $page = 'grafik.php'; //untuk menentukan nama file di folder page
    }
    elseif ($_GET['p'] == 'user') {
      $page = 'user.php'; //untuk menentukan nama file di folder page
    }
    elseif ($_GET['p'] == 'useradd') {
      $page = 'userform.php'; //untuk menentukan nama file di folder page
    }
    elseif ($_GET['p'] == 'useredit') {
      $page = 'userform.php'; //untuk menentukan nama file di folder page
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

  <title>Monitoring Ketinggian Air</title>

  <!-- Custom fonts for this template-->
  <link href="src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="src/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="src/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
        <div class="sidebar-brand-icon ">
          <i class="fas fa-signal"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Monitoring</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?=empty($_GET['p'])?'active':''?>">
        <a class="nav-link" href="home.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Menu :
      </div>

      <!-- Nav Item - Charts -->
      <li class="nav-item <?=isset($_GET['p']) && $_GET['p'] == 'air'?'active':''?>">
        <a class="nav-link" href="?p=air">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Data Ketinggian Air</span></a>
      </li>

      <li class="nav-item <?=isset($_GET['p']) && $_GET['p'] == 'grafik'?'active':''?>">
        <a class="nav-link" href="?p=grafik">
          <i class="fas fa-fw fa-chart-pie"></i>
          <span>Grafik Ketinggian Air</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item <?=isset($_GET['p']) && $_GET['p'] == 'user'?'active':''?>">
        <a class="nav-link" href="?p=user">
          <i class="fas fa-fw fa-user"></i>
          <span>User</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$_SESSION['user_nama']?></span>
                <img class="img-profile rounded-circle" src="src/img/admin-settings-male.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a onclick="return confirm('apakah anda yakin ?')" class="dropdown-item" href="logout.php" >
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <?php
        //inialisasi page awal adalah menu home
        

        include "page/".$page;
        ?>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; <b>Monitoring Ketinggian Air</b> <?=date('Y')?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- Bootstrap core JavaScript-->
  <script src="src/vendor/jquery/jquery.min.js"></script>
  <script src="src/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="src/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="src/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="src/vendor/chart.js/Chart.min.js"></script>
  <!-- Page level plugins -->
  <script src="src/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="src/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="src/js/demo/datatables-demo.js"></script>
  <script>
    <?php if (empty($_GET['p'])) { ?>
    $(document).ready(function() {
      data();
    });
    function data()
    {
      $.ajax({
            url: "data.php",
            method: "GET",
            dataType : "json",
            success: function(data) {
                var ctx = document.getElementById('graphCanvas').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.label,
                        datasets: [{
                            label: 'Ketinggian Air',
                            backgroundColor: 'rgb(252, 116, 101)',
                            borderColor: 'rgb(255, 255, 255)',
                            data: data.tinggi_air
                        }]
                    },
                    options: {
                        scales: {
                            xAxis: {
                                ticks: {
                                    maxTicksLimit: 10
                                }
                            }
                        }
                    }
                });
            }
        });
    }
    setInterval(function () { data()}, 1000);

  <?php } ?>
</script>

</body>

</html>
