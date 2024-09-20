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
<head>
    <meta charset="utf-8">
    <title>ΑΤΛΑΣ - Πληροφόρηση Φορέα</title>
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
        <li class="breadcrumb-item">
            <a href="#">Φορείς</a>
        </li>
        <li class="breadcrumb-item active">
            Πληροφόρηση
        </li>
    </ul>
    <!-- Breadcrumb End -->


    <!-- Step Section Start -->
    <link rel="stylesheet" href="css/step-section.css">

    <section>
        <ul class="steps-list">
            <div class="row">
                <li class="step">
                    <header>
                        <h4>
                            Βήμα 1
                        </h4>
                    </header>
                    <header>
                        <h6>
                        <a href="publish-internship_posting.php">Δημιουργία Αγγελίας</a> Πρακτικής Άσκησης
                        </h6>
                    </header>
                    <span>Οι Φορείς Υποδοχής δημιουργούν την αγγελία τους για Πρακτική Άσκηση. Πρέπει να συμπληρώσουν απαραίτητες πληροφορίες όπως ο τίτλος της θέσης, 
                        το Τμήμα που αφορά, την τοποθεσία της θέσης, την ημερομηνία έναρξης, την διάρκεια και τύπο απασχόλησης, το ποσό αμοιβής και ένα αναλυτικό 
                        κείμενο περιγραφής της. <br>Η αγγελία μπορεί να αποθηκευτεί προσωρινά.</span>
                </li>
                <li class="step">
                    <header>
                        <h4>
                            Βήμα 2 (Προϋποθέτει <a href="login.php">Σύνδεση</a>)
                        </h4>
                    </header>
                    <header>
                        <h6>
                            Οριστική Υποβολή Αγγελίας
                        </h6>
                    </header>
                    <span>Για να γίνει οριστική υποβολή της Αγγελίας πρέπει να έχει προηγηθεί σύνδεση του Φορέα. Μετά την οριστική υποβολή ο Φορέας μπορεί να κάνει προεπισκόπηση της αγγελίας 
                        αλλά δεν μπορεί να την επεξεργαστεί.<br> Ακολουθούν οι αιτήσεις εκδήλωσης ενδιαφέροντος απο φοιτητές/τριες</span>
                </li>
                <li class="step">
                    <header>
                        <h4>
                            Βήμα 3
                        </h4>
                    </header>
                    <header>
                        <h6>
                            Επιλογή Φοιτητών για την θέση Πρακτικής Άσκησης
                        </h6>
                    </header>
                    <span>Στο τελικό βήμα ο Φορέας μπορεί να δει λεπτομέρειες κάθε αίτησης ενδιαφέροντος και να τις αποδεχτεί ή να τις απορρίψει από την 
                        λίστα αιτήσεων κάθε αγγελίας.<br> Μετά αναλόγως, ενημερώνεται ο αιτών/ούσα με αναγνωριστικό μήνυμα ότι εγκρίθηκε ή απορρίφθηκε μαζί με 
                        τους λόγους απόρριψης της αίτησης.</span>
                </li>
            </div>
        </ul>
    </section>
    <!-- Step Section End -->


    <!-- Information Section Start -->
    <link rel="stylesheet" href="css/information-section.css">

    <script src="js/toggleAnswer.js"></script>

    <ul class="information-list">
        <li class="information-item">
            <header id="contact-info" onclick="toggleAnswer(event, 'contact-info')">
                <h4>Τρόποι επικοινωνίας με το Γραφείο Βοήθειας Χρηστών</h4>
                <i class="fa fa-minus d-none"></i>
                <i class="fa fa-plus"></i>
            </header>
            <span class="d-none">Για τυχόν προβλήματα με την πλατφόρμα ΑΤΛΑΣ μπορείτε να επικοινωνήσετε με το Γραφείο Βοήθειας μέσω της <a href="contact.php">φόρμας</a> ή τηλεφωνικά στο 2152157860 (Δευτέρα-Παρασκευή, 09:00-17:00).</span>
        </li>
        
        <li class="information-item">
            <header id="calculate-wage" onclick="toggleAnswer(event, 'calculate-wage')">
                <h4>Υπολογισμός αμοιβής Πρακτικής Άσκησης</h4>
                <i class="fa fa-minus d-none"></i>
                <i class="fa fa-plus"></i>
            </header>
            <span class="d-none">Η αμοιβή εξαρτάται από τον Φορέα Υποδοχής αλλά το ελάχιστο ποσό που μπορεί να δωθεί είναι ο κατώτατος μισθός, δηλαδή 713,00 €.</span>
        </li>
        
        <li class="information-item">
            <header id="begin-internship" onclick="toggleAnswer(event, 'begin-internship')">
                <h4>Δικαίωμα έναρξης Πρακτικής Άσκησης</h4>
                <i class="fa fa-minus d-none"></i>
                <i class="fa fa-plus"></i>
            </header>
            <span class="d-none">Από την στιγμή που συμφωνηθεί η ανάληψη της θέσης, ο φοιτητής/τρια δύναται να ξεκινήσει άμεσα την πρακτική άσκηση.</span>
        </li>
        
        <li class="information-item">
            <header id="work-safety" onclick="toggleAnswer(event, 'work-safety')">
                <h4>Ασφάλεια στην εργασία</h4>
                <i class="fa fa-minus d-none"></i>
                <i class="fa fa-plus"></i>
            </header>
            <span class="d-none">Ο Φορέας Υποδοχής οφείλει να παρέχει ασφάλεια για τον φοιτητή/τρια που θα αναλάβει την θέση.</span>
        </li>
        
        <li class="information-item">
            <header id="duration-and-type-of-internship" onclick="toggleAnswer(event, 'duration-and-type-of-internship')">
                <h4> Διάρκεια και Τύπος Πρακτικής Άσκησης</h4>
                <i class="fa fa-minus d-none"></i>
                <i class="fa fa-plus"></i>
            </header>
            <span class="d-none">Ο Φορέας Υποδοχής ορίζει είτε τρίμηνη, είτε εξάμηνη μερική ή πλήρη απασχόληση για την θέση Πρακτικής Άσκησης.</span>
        </li>
    </ul>
    <!-- Information Section End -->

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