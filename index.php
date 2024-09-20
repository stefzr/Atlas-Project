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
    <title>ΑΤΛΑΣ - Κόμβος Πρακτικής Άσκησης</title>
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
    <?php 
        require './topbar.php';
        require './navbar.php';
    ?>

    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid position-relative d-flex flex-column p-0 align-items-center m-0 flex-grow-1" style="height: 1200px;">
        <div class="container text-center" style="max-width: 1000px; margin: auto 0;">
            <!-- to margin bottom den allazei aftomata analoga tin analisi-->
            <h1 class="stroketext2" style="font-size:50px; margin-bottom: 150px;">Σύστημα Κεντρικής Υποστήριξης της Πρακτικής Άσκησης Φοιτητών ΑΕΙ</h1>
            <h4 class="stroketext" style="font-size:30px;">Βρες τη θέση πρακτικής που σου ταιριάζει!</h4>
            <div class="container-fluid bg-primary mb-5  " data-wow-delay="0.1s" style="padding: 15px;">
                <div class="container">
                    <form action="search-internship.php" method="get" class="row align-items-center">
                        <div class="col-md-12">
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <label for="internship-title" class="text-white" style="font-size:20px;">Τίτλος θέσης:</label>
                                    <input type="text" id="internship-title" name="internship-title" class="form-control" style="align-self: center; padding: 30px 25px;" placeholder="π.χ. Web designer">
                                </div>
                                <div class="col-md-4" style="display: flex; flex-direction: column;">
                                    <label for="internship_date" class="text-white" style="font-size:20px;">Ημερομηνία έναρξης:</label>
                                    <input type="date" id="internship_date" name="internship_date" style="width:fit-content; align-self:center; margin: auto 0; padding: 15px;">
                                </div>
                                <div class="col-md-4">
                                    <label for="location" class="text-white" style="font-size:20px;">Τοποθεσία πρακτικής:</label>
                                    <input class="form-control" list="locations" id="location" name="location" style="align-self: center; padding: 30px 25px;" placeholder="π.χ.  Αθήνα - Περιστέρι">
                                        <datalist id="locations">
                                            <option value="Αθήνα - Κέντρο">
                                            <option value="Αθήνα - Περιστέρι">
                                            <option value="Αθήνα - Καλλιθέα">
                                            <option value="Αθήνα - Νίκαια">
                                            <option value="Αθήνα - Χαλάνδρι">
                                            <option value="Αθήνα - Μαρούσι">
                                            <option value="Αθήνα - Αιγάλεω">
                                            <option value="Αθήνα - Πειραιάς">
                                            <option value="Αθήνα - Γλυφάδα">
                                            <option value="Θεσσαλονίκη - Κέντρο">
                                            <option value="Θεσσαλονίκη - Εύοσμος">
                                            <option value="Θεσσαλονίκη - Αμπελόκηποι">
                                            <option value="Θεσσαλονίκη - Καλαμαριά">
                                            <option value="Θεσσαλονίκη - Άνω Τούμπα">
                                            <option value="Θεσσαλονίκη - Κάτω Τούμπα">
                                            <option value="Πάτρα - Κέντρο">
                                            <option value="Πάτρα - Ανθούπολη">
                                            <option value="Πάτρα - Κωνσταντινουπόλεως">
                                            <option value="Ηράκλειο - Κέντρο">
                                            <option value="Ηράκλειο - Ξεροπόταμος">
                                            <option value="Ηράκλειο - Νέα Αλικαρνασσός">
                                            <option value="Λάρισα - Κέντρο">
                                            <option value="Λάρισα - Γιάννουλη">
                                        </datalist>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2" style="margin: 0 auto;">
                            <button class="btn btn-dark border-0 w-100 py-3 mt-2">Αναζήτηση</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div>
            <a href="information_students.php" style="font-size:30px;"><b>Διαδικασία</b> </a>
            <h1 class="stroketext" style="font-size:30px; display:inline;">Εύρεσης Πρακτικής Άσκησης</h1>
        </div>
        <div class="container text-center">
            <div class="row" style="background-color:#F5F6F8;">
                <div class="col-md-12">
                    <div class="how-image text-center"><img src="img/howworks.jpg" alt=""></div>
                </div>
            </div>
            <div class="row" style="margin-bottom: 100px; background-color:#f5f6f8;">
                <div class="col-md-4 text-center">
                    <a href="search-internship.php" style="font-size: 20px;"><b>Αναζήτηση</b></a>
                    <h2 class="stroketext" style="display: inline; font-size:20px;">θέσεων<br> πρακτικής άσκησης</h2>
                </div>
                <div class="col-md-4">
                    <h2 class="stroketext" style="font-size:20px;">Προβολή λεπτομερειών<br> της θέσης που σε ενδιαφέρει</h2>
                </div>
                <div class="col-md-4 text-center">
                    <h2 class="stroketext" style="font-size:20px;">Υποβολή αίτησης<br> για τη θέση που σε ενδιαφέρει</h2>
                </div>
            </div>
        </div>

        <div class="mb-5" style="background-color: white; padding: 8px 16px; border-radius: 12px;">
            <span style="color: grey;"> Ψάχνεις φοιτητές/τριες για πρακτική;
            </span> <a href="publish-internship_posting.php">Δημιούργησε αγγελία</a> 
        </div>
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