<?php
    date_default_timezone_set('America/Belize');

    $mytime = date("H");
    $greetings = '';

    if (($mytime >= 2) && ($mytime < 6)){
        $img = 'img/srdawn.gif';
        $greetings = 'It&#39s Dawn!,&iexcl;Es Amanecer!,&#x30C9&#x30FC&#x30F3&excl;&#x3067&#x3059&#x25CB';
    }

    elseif (($mytime >= 6) && ($mytime < 12)){
        $img = 'img/flmorning.gif';
        $greetings = 'Good Morning!,&iexcl;Buenos D&#237as!,&#x304A&#x306F&#x3088&#x3046&#x3054&#x3056&#x3044&#x307E&#x3059&#x25CB';
    }
    
    elseif (($mytime == 12)){
        $img = 'img/acnoon.gif';
        $greetings = 'It&#39s Already Noon!,&iexcl;Ya es Mediod&#237a!,&#x3082&#x3046&#x304A&#26172&#x3067&#x3059&#x25CB';
    }

    elseif (($mytime >= 13) && ($mytime < 18)){
        $img = 'img/mrafternoon.gif';
        $greetings = 'Good Afternoon!,&iexcl;Buenas Tardes!,&#x3053&#x3093&#x306B&#x3061&#x306F&#x25CB';
    }

    elseif (($mytime >= 18) && ($mytime < 21)){
        $img = 'img/stevening.gif';
        $greetings = 'Good Evening!,&iexcl;Buenas Noches!,&#x3053&#x3093&#x3070&#x3093&#x306F&#x25CB';
    }

    elseif ((($mytime >= 21) && ($mytime < 24)) || (($mytime >= 1) && ($mytime < 2))) {
        $img = 'img/cpnight.gif';
        $greetings = 'Good Night!,&iexcl;Buenas Noches!,&#x304A&#x3084&#x3059&#x307F&#x306A&#x3055&#x3044&#x25CB';
    }

    elseif (($mytime == 0)) {
        $img = 'img/rnmidnight.gif';
        $greetings = 'It&#39s Midnight!,&iexcl;Es Medianoche!,&#30495&#22812&#20013&#x3067&#x3059&#x25CB';
    }
?>
        

<html>
<head>
    <style>
        .center-image {
            display: flex;
            justify-content: center;
        }

        #activities p span {
            color: #a03d2d;
            font-size: 26px;
            letter-spacing: 1px;
        }
    </style>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>CS210 - Aiden Castillo - Automatic Time of Day</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../assets/img/favicon-32x32.png" rel="icon">
  <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Radio Canada:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="../../assets/css/custom.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: MyResume - v4.10.0
  * Template URL: https://bootstrapmade.com/free-html-bootstrap-template-my-resume/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body style="background-color: #121212;">

    <!-- ======= Mobile nav toggle button ======= -->
    <!-- <button type="button" class="mobile-nav-toggle d-xl-none"><i class="bi bi-list mobile-nav-toggle"></i></button> -->
    <i class="bi bi-list mobile-nav-toggle d-lg-none"></i>
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex flex-column justify-content-center">

        <nav id="navbar" class="navbar nav-menu">
        <ul>
            <li><img src="../../assets/img/favicon-56x56.png" class="img-fluid" alt=""></li>
            <li><a href="http://aidcascs210.byethost15.com/#hero" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Home</span></a></li>
            <li><a href="http://aidcascs210.byethost15.com/#about" class="nav-link scrollto"><i class="bx bx-user"></i> <span>About Me</span></a></li>
            <li><a href="http://aidcascs210.byethost15.com/#services" class="nav-link scrollto"><i class="bx bx-file-blank"></i> <span>Projects</span></a></li>
            <!--<li><a href="#resume" class="nav-link scrollto"><i class="bi bi-chat-square-text"></i> <span>Quotes</span></a></li>-->
            <li><a href="http://aidcascs210.byethost15.com/#portfolio" class="nav-link scrollto"><i class="bi bi-brush"></i> <span>Hobbies/Interests</span></a></li>
            <li><a href="http://aidcascs210.byethost15.com/#quotes" class="nav-link scrollto"><i class="bi bi-chat-square-text"></i> <span>Quotes</span></a></li>
            <li><a href="http://aidcascs210.byethost15.com/#contact" class="nav-link scrollto"><i class="bx bx-envelope"></i> <span>Contact</span></a></li>
        </ul>
        </nav><!-- .nav-menu -->

    </header><!-- End Header -->

    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="activities" class="activities">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Automatic - Time of Day</h2>
                <p>This page will demonstrate how php can be used to display different images depending on the time of the day.</p>
                <p class="mt-3" style="color: #fff; font-size: 32px"><?php echo date('h:i:s A'); ?></p>
            </div>

            <div class="center-image">
                <img src='<?php echo $img; ?>' style="border-radius: 4px;">
            </div>
            <div class="section-title text-center mt-4 mb-1">
                <p><span class="typed" data-typed-items="<?php echo $greetings; ?>"></span></p>
                <!--<p><span class="typed" data-typed-items="Good Morning!,Buenos D&#237as!,&#x304A&#x306F&#x3088&#x3046&#x3054&#x3056&#x3044&#x307E&#x3059"></span></p>-->
            </div>
            <br>
            <br>
            <div class="section-title text-center mt-1 mb-1">
                <button type="button" class="btn btn-light"><a href="http://aidcascs210.byethost15.com/projects/pa3/index.html"><i class="bi bi-arrow-left-circle"></i> Back to PA3</a></button>
                <button type="button" class="btn btn-light"><a href="http://aidcascs210.byethost15.com/"><i class="bi bi-house-door"></i> Home</a></button>
            </div>
        </div>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
        <h3>Web Development</h3>
        <p>Website Landing page for CS210, where anyone can see the various practical activities and exercises that I've
            completed.</p>

        <!-- Section: Links -->

        <!--Grid row-->
        <div class="row justify-content-md-center">
            <!--Grid column-->
            <div class="col-6 col-lg-2 mb-3">
            <h5>AC</h5>

            <ul class="list-unstyled">
                <li>
                <a href="http://aidcascs210.byethost15.com/#hero">Home</a>
                </li>
                <li>
                <a href="http://aidcascs210.byethost15.com/#about">About Me</a>
                </li>
                <li>
                <a href="http://aidcascs210.byethost15.com/#services">Projects</a>
                </li>
                <li>
                <a href="http://aidcascs210.byethost15.com/#portfolio">Hobbies/Interests</a>
                </li>
                <li>
                <a href="http://aidcascs210.byethost15.com/#quotes">Quotes</a>
                </li>
                <li>
                <a href="http://aidcascs210.byethost15.com/#contact">Contact</a>
                </li>
            </ul>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-6 col-lg-2 mb-3">
            <h5>Quick Links</h5>

            <ul class="list-unstyled">
                <li>
                <a href="https://www.youtube.com/" target="_blank">YouTube</a>
                </li>
                <li>
                <a href="https://bandcamp.com/" target="_blank">BandCamp</a>
                </li>
                <li>
                <a href="https://anilist.co/home" target="_blank">AniList</a>
                </li>
                <li>
                <a href="https://www.amazon.com/" target="_blank">Amazon</a>
                </li>
                <li>
                <a href="https://www.twitch.tv/" target="_blank">Twitch</a>
                </li>
            </ul>
            </div>
            <!--Grid column-->
        </div>
        <!--Grid row-->
        <!-- Section: Links -->

        <div class="social-links">
            <a href="https://twitter.com/?lang=en" target="_blank" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="https://www.facebook.com/" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="https://store.steampowered.com/" target="_blank"><i class="bi bi-steam"></i></a>
            <a href="https://www.linkedin.com/" target="_blank" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>

        <div class="copyright">
            &copy; Copyright <strong><span>MyResume</span></strong>. All Rights Reserved
        </div>
        <div class="copyright">
            The template used for this site <a href="https://bootstrapmade.com/free-html-bootstrap-template-my-resume/"
            target="_blank">MyResume</a>
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: [license-url] -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-html-bootstrap-template-my-resume/ -->
            Designed by <a href="https://bootstrapmade.com/" target="_blank">BootstrapMade</a>
        </div>
        </div>
    </footer><!-- End Footer -->

    <!-- Vendor JS Files -->
    <script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../../assets/vendor/aos/aos.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../../assets/vendor/typed.js/typed.min.js"></script>
    <script src="../../assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="../../assets/vendor/php-email-form/validate.js"></script>
    <!--<script src="assets/js/script.js"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>-->

    <!-- Template Main JS File -->
    <script src="../../assets/js/main.js"></script>

</body>
</html>
