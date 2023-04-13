<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicons -->
    <link href="../../../../assets/img/favicon-32x32.png" rel="icon">
    <link href="../../../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Radio Canada:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">
    
    <!-- Vendor CSS Files -->
    <link href="../../../../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../../../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../../../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../../../../assets/css/custom.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../../../assets/css/style.css" rel="stylesheet">

    <!--<link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">-->
    <link href="style.css" rel="stylesheet">
    <title><?= $title ?? 'Home' ?></title>
</head>
<body style="background-color: #121212;">

  <!-- ======= Mobile nav toggle button ======= -->
  <!-- <button type="button" class="mobile-nav-toggle d-xl-none"><i class="bi bi-list mobile-nav-toggle"></i></button> -->
  <i class="bi bi-list mobile-nav-toggle d-lg-none"></i>
  <!-- ======= Header ======= -->
  <header id="header" class="d-flex flex-column justify-content-center">

    <nav id="navbar" class="navbar nav-menu">
      <ul>
        <li><img src="../../../../assets/img/favicon-56x56.png" class="img-fluid" alt=""></li>
        <li><a href="http://aidcascs210.byethost15.com/#hero" class="nav-link scrollto active"><i
              class="bx bx-home"></i> <span>Home</span></a></li>
        <li><a href="http://aidcascs210.byethost15.com/#about" class="nav-link scrollto"><i class="bx bx-user"></i>
            <span>About Me</span></a></li>
        <li><a href="http://aidcascs210.byethost15.com/#services" class="nav-link scrollto"><i
              class="bx bx-file-blank"></i> <span>Projects</span></a></li>
        <!--<li><a href="#resume" class="nav-link scrollto"><i class="bi bi-chat-square-text"></i> <span>Quotes</span></a></li>-->
        <li><a href="http://aidcascs210.byethost15.com/#portfolio" class="nav-link scrollto"><i class="bi bi-brush"></i>
            <span>Hobbies/Interests</span></a></li>
        <li><a href="http://aidcascs210.byethost15.com/#quotes" class="nav-link scrollto"><i
              class="bi bi-chat-square-text"></i> <span>Quotes</span></a></li>
        <li><a href="http://aidcascs210.byethost15.com/#contact" class="nav-link scrollto"><i
              class="bx bx-envelope"></i> <span>Contact</span></a></li>
      </ul>
    </nav><!-- .nav-menu -->

  </header><!-- End Header -->
<main>
<?php flash() ?>