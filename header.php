<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/vendor/@fortawesome/fontawesome-free/css/fontawesome.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link rel="stylesheet" type="text/css" href="assets/css/style.css?v=<?php echo time(); ?>">
    <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <!-- =======================================================
  * Creater  :- EKANSH SAXENA
  * Location :- MMMUT, Gorakhpur
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container-fluid d-flex">
      <div class="contact-info mr-auto">
        <a href="#">Login/Register</a>
        <i class="fa fa-cart-plus"></i><a href="#">Order</a>
        <i class="fa fa-line-chart"><a href="#">&nbsp; Track Order</a></i>
        <i class="icofont-envelope"></i><a href="mailto:contact@example.com">contact@example.com</a>
        <i class="icofont-phone phone-icon"></i> +1 5589 55488 55
      </div>
      <div class="last-button">
        <a role="button" href="#" class="btn btn-success">Covid Products</a>
      </div>
    </div>
  </section>
  <!-- =======Logo header ==== -->
  <header id="header1" class="d-flex align-items-center">
    <div class="container-fluid d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="index.html">Intella<span>Services</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>
    </div>
  </header>

  <!-- ======= Header ======= -->
  <header id="topbar" class="d-flex align-items-center">
    <div class="container-fluid d-flex align-items-center">

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="#header"><i class="fa fa-home">&nbsp;Home</i></a></li>
          <li><a href="#solutions"><i class="fa fa-strikethrough">&nbsp; Solutions</i></a></li>
          <li><a href="product1.php"><i class="fa fa-th-large">&nbsp;Products</i></a></li>
          <li><a href="#about"><i class="fa fa-info-circle">&nbsp; About</i></a></li>
          <li><a href="#contact"><i class="fa fa-id-card">&nbsp; Contact</i></a></li>
          
        <?php
                            
                            if(isset($_SESSION["loggedin"])){
                                /*$sql = "SELECT username FROM users WHERE id='$_SESSION[loggedin]'";
                                $query = mysqli_query($users,$sql);
                                $row=mysqli_fetch_array($query);
                                */
                                echo '
                                
                                    <li id="last-drop" class="drop-down">
                                    <a href=""><i class="fa fa-user-o"></i>&nbsp; My Account</a>
                                    <ul>
                                       <li> <a href="#" class="dropdown-item">Profile</a> </li>
                                       <li> <a href="cart.php" class="dropdown-item">Cart</a></li>
                                       <li> <a href="reset-password.php" class="dropdown-item">Reset Password</a><li>
                                       <li> <a href="logout.php" class="dropdown-item">Log out</a><li>
                                    </ul>
                                

                               ';

                            }else{ 
                                echo '
                                <li>
                                <a id="last-login" href="login.php" class="dropdownn" style="margin-top: -45px;"><i class="fa fa-user-o">&nbsp; Login</i></a>';
                                
                            }
                                             ?></li></ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->


