<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
<!-- https://www.free-css.com/free-css-templates/page282/edukate -->

<head>
    <meta charset="utf-8">
    <title>ATLAS - Centralized Internship Support</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="img/atlas_favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Topbar Stylesheet -->
    <link href="css/top-bar.css" rel="stylesheet">
</head>

<!-- Custom classes -->
<style>
    .kubi {
      background-color: transparent;
      border: none;
      color: white;
      padding: 0px 12px;
      font-size: 16px;
      cursor: pointer;
    }
    /* Darker background on mouse-over */
    .kubi:hover {
      background-color:rgb(141, 141, 179);
    }
    /* Has 4 shadows. Add or remove for stroke intensity. */
    .stroketext2 {
        color: white;
        text-shadow: -2px -2px 0 #000, 2px -2px 0 #000, -2px 2px 0 #000, 2px 2px 0 #000; 
    }
    .stroketext {
        color: white;
        text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000; 
    }
</style>

<body class="d-flex flex-column" style="min-height: 100vh;">
    <!-- Topbar Start -->
    <div class="top-bar container-fluid bg-dark">
        <a class="kubi" href="index.php"><img src="img/cif_gr.png" alt="Greek flag" width="40" height="23"><span style="margin-left: 4px;">Ελληνικά</span></a>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <style> /* hover functionality */
        .navbar .nav-item .dropdown-menu{ display: none; }
        .navbar .nav-item:hover .dropdown-menu{ display: block; }
        .navbar .nav-item .dropdown-menu{ margin-top:0; }
    </style>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
            <a href="index.php" class="navbar-brand ml-lg-3">
                <img src="img/atlas_logo.png" width="125" height="125" class="img-fluid" alt="Responsive image" style="border: 1px solid rgb(134, 134, 134);">
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-0 align-items-center">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle mr-5" style="padding: 0;" data-toggle="dropdown">STUDENTS</a>
                        <div class="dropdown-menu m-0">
                            <a href="information_students.php" class="dropdown-item">Information</a>
                            <a href="search-internship.php" class="dropdown-item">Search for Intership</a>
                            <a href="prof_std_applic.php" class="dropdown-item">My Applications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle mr-5" style="padding: 0;" data-toggle="dropdown">INTERNSHIP PROVIDERS</a>
                        <div class="dropdown-menu m-0">
                            <a href="information_providers.php" class="dropdown-item">Information</a>
                            <a href="publish-internship_posting.php" class="dropdown-item">Create Job Posting</a>
                            <a href="team.php" class="dropdown-item">My Job Postings</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" style="padding: 0;" data-toggle="dropdown">HELP</a>
                        <div class="dropdown-menu m-0">
                            <a href="FAQ.php" class="dropdown-item">FAQ</a>
                            <a href="contact.php" class="dropdown-item">Contact us</a>
                        </div>
                    </div>
                </div>

                <?php if (isset($user)): ?>

                    <?php if($user['user_type'] === 'student'): ?>
                        <a href="prof_std_info.php">
                            <i class="fa fa-user fa-lg" title="Στοιχεία Φοιτητή/τριας"></i>
                        </a>

                        <a href="prof_std_applic.php" style="margin: 0 1rem;">
                            <i class="fa fa-file-alt fa-lg" title="Οι Αιτήσεις μου"></i>
                        </a>
                    <?php else: ?>
                        <a href="prof_prov_info.php">
                            <i class="fa fa-user fa-lg" title="Στοιχεία Φορέα Υποδοχής"></i>
                        </a>

                        <a href="prof_prov_post.php" style="margin: 0 1rem;">
                            <i class="fa fa-file-alt fa-lg" title="Οι Αγγελίες μου"></i>
                        </a>
                    <?php endif; ?>
                    <a href="logout.php">
                        <i class="fa fa-sign-out-alt fa-lg" title="Αποσύνδεση"></i>
                    </a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-primary py-3 px-5 mr-3 d-none d-lg-block" id="loginButton">LOG IN</a>
                    <div class="nav-item dropdown">
                        <button href="#" class="btn btn-secondary py-3 px-5 dropdown-toggle" style="padding: 0;" data-toggle="dropdown">SIGN UP</button>
                        <div class="dropdown-menu m-0">
                            <a href="signup-student.php" class="dropdown-item">as a Student</a>
                            <a href="signup-internship-provider.php" class="dropdown-item">as an Internship Provider</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid position-relative d-flex flex-column p-0 align-items-center m-0 flex-grow-1" style="height: 1200px;">
        <div class="container text-center" style="max-width: 1000px; margin: auto 0;">
            <!-- to margin bottom den allazei aftomata analoga tin analisi-->
            <h1 class="stroketext2" style="font-size:50px; margin-bottom: 150px;">Central Internship support system for university students</h1>
            <h4 class="stroketext" style="font-size:30px;">Find the internship that suits you!</h4>
            <div class="container-fluid bg-primary mb-5  " data-wow-delay="0.1s" style="padding: 15px;">
                <div class="container">
                    <form action="search-internship.php" method="get" class="row align-items-center">
                        <div class="col-md-12">
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <label for="internship-title" class="text-white" style="font-size:20px;">Job Title:</label>
                                    <input type="text" id="internship-title" name="internship-title" class="form-control" style="align-self: center; padding: 30px 25px;" placeholder="π.χ. Web designer">
                                </div>
                                <div class="col-md-4" style="display: flex; flex-direction: column;">
                                    <label for="internship_date" class="text-white" style="font-size:20px;">Start Date:</label>
                                    <input type="date" id="internship_date" name="internship_date" style="width:fit-content; align-self:center; margin: auto 0; padding: 15px;">
                                </div>
                                <div class="col-md-4">
                                    <label for="location" class="text-white" style="font-size:20px;">Location:</label>
                                    <input class="form-control" list="locations" id="location" name="location" style="align-self: center; padding: 30px 25px;" placeholder="π.χ. Athens - Peristeri">
                                        <datalist id="locations">
                                            <option value="Athens - Center">
                                            <option value="Athens - Peristeri">
                                            <option value="Athens - Kalithea">
                                            <option value="Athens - Nikaia">
                                            <option value="Athens - Halandri">
                                            <option value="Athens - Marousi">
                                            <option value="Athens - Aigaleo">
                                            <option value="Athens - Peiraias">
                                            <option value="Athens - Glyfada">
                                            <option value="Thessaloniki - Center">
                                            <option value="Thessaloniki - Evosmos">
                                            <option value="Thessaloniki - Ampelokipoi">
                                            <option value="Thessaloniki - Klamaria">
                                            <option value="Thessaloniki - Ano Toumpa">
                                            <option value="Thessaloniki - Kato Toumpa">
                                            <option value="Patra - Center">
                                            <option value="Patra - Anthoupoli">
                                            <option value="Patra - Konstantinoupoleos">
                                            <option value="Heraklio - Center">
                                            <option value="Heraklio - Xeropotamos">
                                            <option value="Heraklio - Nea Alikarnassos">
                                            <option value="Larisa - Center">
                                            <option value="Larisa - Giannouli">
                                        </datalist>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2" style="margin: 0 auto;">
                            <button class="btn btn-dark border-0 w-100 py-3 mt-2">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <h1 class="stroketext" style="font-size:30px;">Process steps for Students</h1>
        <div class="container text-center">
            <div class="row" style="background-color:#F5F6F8;">
                <div class="col-md-12">
                    <div class="how-image text-center"><img src="img/howworks.jpg" alt=""></div>
                </div>
            </div>
            <div class="row" style="margin-bottom: 100px; background-color:#f5f6f8;">
                <div class="col-md-4 text-center">
                    <h2 class="stroketext" style="font-size:20px;">Search for internship<br> job postings</h2>
                    <!-- <span> Βρες τον ιδιώτη φιλόζωο που θα φιλοξενήσει το ζωάκι σου όπως εσύ επιθυμείς. Δες ποιος είναι κοντά σου, τι εμπειρία έχει, τι υπηρεσίες προσφέρει και επίλεξε τον καλύτερο. </span> -->
                </div>
                <div class="col-md-4">
                    <h2 class="stroketext" style="font-size:20px;">See more details about the<br> ones you're interested in</h2>
                    <!-- <span> Απλά και εύκολα κάνε κράτηση για τις ημερομηνίες που θέλεις και πλήρωσε ηλεκτρονικά ώστε να απολαύσεις όλα τα προνόμια του Keeppet. Μπορείς πριν προχωρήσεις να συναντήσεις τον keeper, ζητώντας meet ’n’ greet μαζί του. </span> -->
                </div>
                <div class="col-md-4 text-center">
                    <h2 class="stroketext" style="font-size:20px;">Submit your application<br> for each one</h2>
                    <!-- <span> Ο keeper θα φροντίσει ώστε να μην του λείψει η φροντίδα, η αγάπη και τα χάδια που έχει συνηθίσει. Είναι καθημερινά σε επικοινωνία μαζί σου και σου στέλνει φωτογραφίες. </span> -->
                </div>
            </div>
        </div>

        <div class="mb-5" style="background-color: white; padding: 8px 16px; border-radius: 12px;"><span style="color: grey;">Looking for intern? </span><a href="dimiourgia_aggelias.php">Publish a job post</a></div>

    </div>
    <!-- Header End -->


    <?php // Include footer of website
        require './footer.php';
    ?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary rounded-0 btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>