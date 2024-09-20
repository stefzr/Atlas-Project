<!DOCTYPE html>
<html>
<!-- https://www.free-css.com/free-css-templates/page282/edukate -->

<head>
    <meta charset="utf-8">
    <title>ΑΤΛΑΣ - Εγγραφή Φορέα Υποδοχής</title>
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

    <!-- Import JavaScript function for password visibility -->
    <script src="js/togglePasswordVisibility.js"></script>
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
            Εγγραφή Φορέα Υποδοχής
        </li>
    </ul>
    <!-- Breadcrumb End -->


    <!-- Sign-up Form Section Start -->
    <link rel="stylesheet" href="css/form-styling.css">

    <h4>
        Εγγραφή στο σύστημα ΑΤΛΑΣ
    </h4>

    <form style="display: flex; flex-direction: column; margin: 1rem auto; max-width: 500px;" action="process-signup-internship_provider.php" method="post">
        <div class="form-item">
            <header>
                <h5> Στοιχεία Υπεύθυνου του Φορέα για το Σύστημα ΑΤΛΑΣ </h5>
            </header>

            <div class="form-group">
                <label for="firstName"> <span class="required-field" title="Αυτό το πεδίο είναι υποχρεωτικό.">*</span>Όνομα</label>
                <input type="firstName" class="form-control" id="firstName" name="firstName" pattern="[\u0370-\u03ff\u1f00-\u1fffA-Za-z]+" required autofocus>
            </div>

            <div class="form-group">
                <label for="lastName"> <span class="required-field" title="Αυτό το πεδίο είναι υποχρεωτικό.">*</span>Επίθετο</label>
                <input type="lastName" class="form-control" id="lastName" name="lastName" pattern="[\u0370-\u03ff\u1f00-\u1fffA-Za-z]+" required>
            </div>
        </div>

         <div class="form-item">
            <header>
                <h5> Στοιχεία Φορέα Υποδοχής Πρακτικής Άσκησης</h5>
            </header>

            <div class="form-group">
                <label for="taxID"> <span class="required-field" title="Αυτό το πεδίο είναι υποχρεωτικό.">*</span>ΑΦΜ</label>
                <input type="text" pattern="[0-9]+" class="form-control" id="taxID" minlength="9" maxlength="9" name="taxID" required>
            </div>

            <div class="form-group">
                <label for="companyName"><span class="required-field" title="Αυτό το πεδίο είναι υποχρεωτικό.">*</span>Επωνυμία</label>
                <input type="text" class="form-control" id="companyName" name="companyName" required>
            </div>
        </div>
        
        <div class="form-item">
            <header>
                <h5> Στοιχεία Λογαριασμού Χρήστη </h5>
            </header>

            <div class="form-group">
                <label for="email"> <span class="required-field" title="Αυτό το πεδίο είναι υποχρεωτικό.">*</span>Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password"> <span class="required-field" title="Αυτό το πεδίο είναι υποχρεωτικό.">*</span>Κωδικός Πρόσβασης</label>
                <div class="row">
                    <div class="col col-md-11" style="padding-right: 0px;">
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="col col-md-1 px-0 d-flex justify-content-center" data-placement="right" title="Ο κωδικός πρόσβασης πρέπει να αποτελείται μόνο από &#010 λατινικούς χαρακτήρες και να έχει τουλάχιστον ένα ψηφίο">
                        <i class="fa fa-info-circle" style="padding-top:6px; font-size:25px;"></i>
                    </div>
                </div>
                <input type="checkbox" id="passwordVisibility" onclick="togglePasswordVisibility()" style="margin: 1em 0;"> 
                <label for="passwordVisibility">Εμφάνιση Κωδικού</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" style="align-self: center;">Δημιουργία Λογαριασμού</button>
    </form>
    <!-- Sign-up Form Section End -->

    <?php require './footer.php'; ?>

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

    .tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
    }

    /* .tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    top: -5px;
    left: 110%;
    }

    .tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 50%;
    right: 100%;
    margin-top: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: transparent black transparent transparent;
    }
    .tooltip:hover .tooltiptext {
    visibility: visible;
    } */
</style>

</html>