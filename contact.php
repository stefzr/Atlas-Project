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
    <title>ΑΤΛΑΣ - Δημιουργία Αγγελίας</title>
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
<body class="d-flex flex-column" style="min-height: 100vh;">
    <?php 
        require './topbar.php';
        require './navbar.php';
    ?>

    <!-- Breadcrumb Start -->
    <ul class="breadcrumb" style="margin: 0;">
        <li class="breadcrumb-item">
            <a href="index.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active">
            <a>Επικοινωνία</a>
        </li>
    </ul>
    <!-- Breadcrumb End -->


    <!-- Internship Posting Section Start -->
    <link rel="stylesheet" href="css/form-styling.css">

    <h4>
        Επικοινωνία με το Γραφείο Βοήθειας Χρηστών
    </h4>

    <form style="display: flex; flex-direction: column; margin: 1rem auto;" action="         .php" method="post" autocomplete="off ">
        <div class="form-item">
            <header>
                <h5> Φόρμα Αναφοράς </h5>
            </header>

            <div class="form-group">
                <label for="internship-title"> <span class="required-field" title="Αυτό το πεδίο είναι υποχρεωτικό.">*</span>Ονοματεπώνυμο</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="internship-title">Τηλέφωνο</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>

            <div class="form-group">
                <label for="internship-title"> <span class="required-field" title="Αυτό το πεδίο είναι υποχρεωτικό.">*</span>E-mail</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>

            <!-- θελουν αλλαγες -->
            <div class="form-group" style="display: flex; justify-content: space-between;">
                <label for="internship-duration" class="mb-0"> <span class="required-field" title="Αυτό το πεδίο είναι υποχρεωτικό.">*</span>Τύπος Χρήστη</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="internship-duration" id="internship-duration" value="3-Months" required>
                    <label class="form-check-label" for="internship-duration">Φοιτητής</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="internship-duration" id="internship-duration" value="6-Months">
                    <label class="form-check-label" for="internship-duration">Φορέας</label>
                </div>
            </div>  

            <div class="form-group">
                <label for="location"> <span class="required-field" title="Αυτό το πεδίο είναι υποχρεωτικό.">*</span>Θέμα Αναφοράς</label>
                <input class="form-control" type="text" name="subject" id="subject" required>
            </div>

            <div class="form-group">
                <label for="internship-description"><span class="required-field" title="Αυτό το πεδίο είναι υποχρεωτικό.">*</span>Κείμενο Αναφοράς</label>
                <textarea style="min-height: 100px;" class="form-control" id="text" name="text" rows="4" cols="50" required></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" style="align-self: center;">Αποστολή</button>
    </form>
    <!-- Internship Posting Section End -->

    <div class="alert alert-warning text-center data-mdb-right " role="alert" style="margin-top: 100px;">
        Μπορείτε να επικοινωνείτε με το Γραφείο Βοήθειας Χρηστών και τηλεφωνικά στο 215 215 7860 , (Δευτέρα-Παρασκευή, 09:00-17:00)
    </div>


    <?php require './footer.php' ?>


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

<!-- For language change -->
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
    </style>

</html>