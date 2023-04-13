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

        button[type='submit']:hover {
            color: #a03d2d;
        }

    </style>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>CS210 - Aiden Castillo - Fibonacci Sequence</title>
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
                <h2>Fibonacci Sequence</h2>
                <p>This page will demonstrate how php can be used to display the Fibonacci Sequence with a user input.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <form method="post">
                        <p style="font-size: 18px; margin-right: 110px;">Iterations: <input type="number" name="iter" style="width: 9em" placeholder="Input Iterations"></input></p><br>
                        <button type="submit" class="btn btn-light" name="Generate" style="font-size: 17px;"><i class="bi bi-calculator"></i> Generate Series</button>
                    </form>
                </div>
            </div>

            <?php
                if(isset($_POST['Generate'])) {
                    $iterations = (int)$_POST['iter'];
                    
                    // Check if input is negative
                    if($iterations <= 0) {
                        echo '<script language="JavaScript">'."\n".'alert("Invalid input");'."\n";
                        echo "window.location=('phpFibSeq.php');\n";
                        echo '</script>';
                    } 
                    else {
                        // Calculate Fibonacci series
                        $fibonacci_series = array(1);
                        if($iterations > 1) {
                            $fibonacci_series[1] = 1;
                            for($i = 2; $i < $iterations; $i++) {
                                $fibonacci_series[$i] = $fibonacci_series[$i-1] + $fibonacci_series[$i-2];
                            }
                        }
                        
                        // Output result as table
                        echo "<div class='col-md-6 mx-auto mt-2 mb-2'>";
                        echo "<table class='table table-dark table-bordered table-striped table-hover text-center'>";
                        echo "<thead><tr><th style='width: 20px'>Iteration</th>
                                <th style='width: 20px'>Fibonacci Number</th></tr></thead>";
                        echo "<tbody>";
                        foreach($fibonacci_series as $key => $value) {
                            $iteration = $key + 1;
                            echo "<tr><td>$iteration</td><td>$value</td></tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    }
                }
            ?>

            <div class="section-title text-center" style="padding-top: 20px;">
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
