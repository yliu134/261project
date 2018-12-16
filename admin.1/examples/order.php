<?php
session_start();
var_dump($_SESSION);
echo session_id();
echo ini_get('session.cookie_domain');
if(isset($_POST['a'])){
    $_SESSION['loggedin']= true;
 }

if (!empty($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "Welcome, administrator";
} else {
    session_destroy();
    $_SESSION['loggedin'] = NULL;
    header("Location:../../User/login-reg.php");
    session_write_close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Black Dashboard by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper">
    <div class="sidebar">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="./food.php">
              <i class="tim-icons icon-bag-16"></i>
              <p>Food</p>
            </a>
          </li>
          <li>
            <a href="./customer.php">
              <i class="tim-icons icon-bullet-list-67"></i>
              <p>Customers</p>
            </a>
          </li>
          <li class="active ">
            <a href="./order.php">
              <i class="tim-icons icon-calendar-60"></i>
              <p>Orders</p>
            </a>
          </li>
          <li >
            <a href="./delivery.php">
              <i class="tim-icons icon-bus-front-12"></i>
              <p><p>Delivery groups</p></p>
            </a>
          </li>
        </ul>
        <div class="logo">
        </div>
        <ul class="nav">
          <li>
            <a href="./newFood.php">
              <i class="tim-icons icon-bag-16"></i>
              <p>Add new food</p>
            </a>
          </li>
          <li>
            <a href="./newDelivery.php">
              <i class="tim-icons icon-bus-front-12"></i>
              <p>Add new Delivery group</p>
            </a>
          </li>
        </ul>
        <div class="logo">
        </div>
        <ul class="nav">
          <li>
            <a href="./updateFood.php">
              <i class="tim-icons icon-bag-16"></i>
              <p>Update/Delete food</p>
            </a>
          </li>
          <li>
            <a href="./updateDelivery.php">
              <i class="tim-icons icon-bus-front-12"></i>
              <p>Update/Delete Delivery group</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:void(0)">Table List</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
              <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="photo">
                    <img src="../assets/img/anime3.png">
                  </div>
                  <b class="caret d-none d-lg-block d-xl-block"></b>
                  <p class="d-lg-none">
                    Log out
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                  <li class="nav-link">
                    <a href="../../User/login-reg.php" class="nav-item dropdown-item">Log out
                        <i class="tim-icons icon-bus-front-12" onclick = "<?php
                        session_destroy();
                        $_SESSION['loggedin'] = NULL;
                        session_write_close();
              ?>"></i>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="separator d-lg-none"></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Navbar -->

      <!-- Select -->
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Search by Customer ID</h5>
              </div>
              <form action="./order.php" method="POST">
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 pr-md-1">
                      <div class="form-group">
                        <label>ID</label>
                        <input type="text" class="form-control" name="cid">
                      </div>
                    </div>
                  </div>

              </div>
              <div class="card-footer">
                <input type="submit" class="btn btn-fill btn-primary"/>
              </div>
            </form>
            </div>
          </div>
            </div>

      <!-- End Select -->

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Order List</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                      <tr>
                        <th>
                          Order ID
                        </th>
                        <th>
                          Address
                        </th>
                        <th>
                          Time
                        </th>
                        <th>
                          Delivery Group
                        </th>
                        <th>
                          Customer ID
                        </th>
                        <th>
                          Description
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $conn = mysqli_connect("localhost", "dpan6", "%NNN5m-A");
                      if($conn->connect_error){
                        die("connection falied:". $conn-> connect_error);
                      }

						$sql = "USE dpan6_3;";
						if ($conn->query($sql) === TRUE) {

						} else {
						   echo "Error using  database: " . $conn->error;
						}

                      if (!empty($_POST))
                      {
                        if (!isset($_POST[cid]) || empty($_POST[cid])) {
                          $sql = "SELECT Onum, Addr, Time, LocID, CID from ORDERS";
                        }else{
                          $sql = "SELECT Onum, Addr, Time, LocID, CID from ORDERS WHERE CID=$_POST[cid]";
                        }
                      }else{
                        $sql = "SELECT Onum, Addr, Time, LocID, CID from ORDERS";
                      }

                      $result = $conn->query($sql);



                      if($result -> num_rows > 0){
                        while ($row = $result -> fetch_assoc()){
                          echo "<tr><td>". $row["Onum"] ."</td><td>". $row["Addr"] ."</td><td>". $row["Time"] ."</td><td>". $row["LocID"] ."</td><td>". $row["CID"] ."</td><td>aaa</td></tr>";
                        }
                      }else{
                        echo "0 result";
                      }

                      $conn -> close();
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!-- Place this tag in your head or just before your close body tag. -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/black-dashboard.min.js?v=1.0.0"></script>
  <!-- Black Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');
        $navbar = $('.navbar');
        $main_panel = $('.main-panel');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');
        sidebar_mini_active = true;
        white_color = false;

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



        $('.fixed-plugin a').click(function(event) {
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .background-color span').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data', new_color);
          }

          if ($main_panel.length != 0) {
            $main_panel.attr('data', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data', new_color);
          }
        });

        $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            sidebar_mini_active = false;
            blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
          } else {
            $('body').addClass('sidebar-mini');
            sidebar_mini_active = true;
            blackDashboard.showSidebarMessage('Sidebar mini activated...');
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);
        });

        $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (white_color == true) {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').removeClass('white-content');
            }, 900);
            white_color = false;
          } else {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').addClass('white-content');
            }, 900);

            white_color = true;
          }


        });

        $('.light-badge').click(function() {
          $('body').addClass('white-content');
        });

        $('.dark-badge').click(function() {
          $('body').removeClass('white-content');
        });
      });
    });
  </script>
</body>

</html>
