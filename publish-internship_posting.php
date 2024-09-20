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

    <!-- Count characters in text-area field -->
    <script defer src="js/countCharacters.js"></script>

    <!-- Library Used for Alerts -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
            Δημιουργία Αγγελίας
        </li>
    </ul>
    <!-- Breadcrumb End -->

    <!-- Progress Tracker Start -->
    <link rel="stylesheet" href="css/progress-tracker.css" type="text/css">

    <section class="step-wizard" style="padding: 1rem 0;">
        <ul class="step-wizard-list" style="margin: auto;">
            <li class="step-wizard-item current-item">
                <span class="progress-count">1</span>
                <span class="progress-label">Δημιουργία Αγγελίας</span>
            </li>

            <li class="step-wizard-item">
                <span class="progress-count">2</span>
                <span class="progress-label">Αναμονή για Αιτήσεις</span>
            </li>

            <li class="step-wizard-item">
                <span class="progress-count">3</span>
                <span class="progress-label">Αποδοχή ή Απόρριψη Αιτήσεων</span>
            </li>
        </ul>
    </section>
    <!-- Progress Tracker End -->

    <!-- Internship Posting Section Start -->
    <link rel="stylesheet" href="css/form-styling.css" type="text/css">

    <?php
        if(isset($_REQUEST['internship_posting_id'])){
            $mysqli = require __DIR__ . "/database.php";
            $sql = "SELECT * FROM internship_posting WHERE id = {$_REQUEST['internship_posting_id']}";
            $result = $mysqli->query($sql);
            $internship_posting_info = $result->fetch_assoc();

            $sql = "SELECT * FROM internship_posting_has_university_departments WHERE internship_posting_id = {$_REQUEST['internship_posting_id']}";
            $result = $mysqli->query($sql);
            $university_department_info = $result->fetch_assoc();
        }
    ?>

    <form id="main-form" style="display: flex; flex-direction: column; max-width: 40%; margin: 1rem auto;" action="process-internship_posting.php" method="post" autocomplete="off">
        <div class="form-item">
            <?php if(!isset($user) or (isset($user) && $user['user_type'] !== 'internship_provider')): ?>
                <div class="form-item" style="padding: 1rem; background-color: white;">
                    <em style="font-size: 20px; color: black; font-weight: bold;">Για τη δημιουργία αγγελίας, απαιτείται <a href="login.php">σύνδεση</a> ή <a href="signup-internship-provider.php">εγγραφή</a> ως φορέας υποδοχής </em>
                </div>
            <?php endif; ?>

            <header>
                <h5> Στοιχεία Πρακτικής Άσκησης </h5>
            </header>

            <div class="form-group">
                <label for="internship-title"> <span class="required-field" title="Αυτό το πεδίο είναι υποχρεωτικό.">*</span>Τίτλος Θέσης</label>
                <input type="text" class="form-control" id="internship-title" name="internship-title" required autofocus value="<?= isset($internship_posting_info) ? $internship_posting_info['title'] : '';?>">
            </div>

            <div class="form-group">
                <label for="university"> <span class="required-field" title="Αυτό το πεδίο είναι υποχρεωτικό.">*</span>Επιλογή Τμήματος</label>
                <select name="university" id="university" class="form-control" required>
                    <option value="">-</option>
                    <?php
                    $mysqli = require __DIR__ . "/database.php";

                    $sql = "SELECT * FROM university";

                    $result = $mysqli->query($sql);
                    while($university = mysqli_fetch_assoc($result)):
                    ?>
                        <optgroup label="<?= $university['name']?>">
                            <?= $university['name']; ?>
                            <?php
                            $sql = "SELECT * FROM university_department WHERE university_name = '".$university['name']."'";

                            $university_department_result = $mysqli->query($sql);
                            while($university_department = mysqli_fetch_assoc($university_department_result)):
                                ?>
                                <option <?= (isset($university_department_info) and $university['name'] == $university_department_info['university_name'] and $university_department['name'] == $university_department_info['university_department']) ? 'selected' : ''; ?> value="<?= $university['name'] .'-'. $university_department['name']; ?>">
                                    <?= $university_department['name'] ?>
                                </option>
                            <?php endwhile; ?>
                        </optgroup>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="internship-duration-3-Months"> <span class="required-field" title="Αυτό το πεδίο είναι υποχρεωτικό.">*</span>Διάρκεια Απασχόλησης</label>
                <div class="form-check ml-2">
                    <input class="form-check-input" type="radio" name="internship-duration" id="internship-duration-3-Months" value="3-Months" <?= (isset($internship_posting_info) and $internship_posting_info['duration'] == '3-Months') ? 'checked' : '';?> required>
                    <label class="form-check-label" for="internship-duration-3-Months">Τρίμηνη</label>
                </div>

                <div class="form-check ml-2 mt-1">
                    <input class="form-check-input" type="radio" name="internship-duration" id="internship-duration-6-Months" value="6-Months" <?= (isset($internship_posting_info) and $internship_posting_info['duration'] == '6-Months') ? 'checked' : '';?>>
                    <label class="form-check-label" for="internship-duration-6-Months">Εξάμηνη</label>
                </div>
            </div>

            <div class="form-group">
                <label for="internship-type-Part-Time"> <span class="required-field" title="Αυτό το πεδίο είναι υποχρεωτικό.">*</span>Τρόπος Απασχόλησης</label>

                <div class="form-check ml-2">
                    <input class="form-check-input" type="radio" name="internship-type" id="internship-type-Part-Time" value="Part-Time" <?= (isset($internship_posting_info) and $internship_posting_info['employment_type'] == 'Part-Time') ? 'checked' : '';?> required>
                    <label class="form-check-label" for="internship-type-Part-Time">Μερική</label>
                </div>

                <div class="form-check ml-2 mt-1">
                    <input class="form-check-input" type="radio" name="internship-type" id="internship-type-Full-Time" value="Full-Time" <?= (isset($internship_posting_info) and $internship_posting_info['employment_type'] == 'Full-Time') ? 'checked' : '';?> >
                    <label class="form-check-label" for="internship-type-Full-Time">Πλήρης</label>
                </div>
            </div>

            <div class="form-group">
                <label for="location"> <span class="required-field" title="Αυτό το πεδίο είναι υποχρεωτικό.">*</span>Τοποθεσία Πρακτικής</label>
                <input class="form-control" type="text" name="location" id="location" list="datalistOptions" placeholder="π.χ. Αθήνα - Περιστέρι" required value="<?= isset($internship_posting_info) ? $internship_posting_info['location'] : ''; ?>">
                <datalist id="datalistOptions">
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

            <div class="form-group">
                <label for="internship_date"> <span class="required-field" title="Αυτό το πεδίο είναι υποχρεωτικό.">*</span>Ημερομηνία Εκτέλεσης Πρακτικής</label>
                <input class="form-check" type="date" id="internship_date" name="internship_date" required value="<?= isset($internship_posting_info) ? $internship_posting_info['start_date_of_internship'] : ''; ?>">
            </div>

            <div class="form-group">
                <label for="wage"> <span class="required-field" title="Αυτό το πεδίο είναι υποχρεωτικό.">*</span>Ύψος Αμοιβής Ασκούμενου/ης</label>
                <div class="row">
                    <div class="col col-md-11" style="padding-right: 0px;">
                        <input pattern="[0-9]+" class="form-control" type="number" name="wage" id="wage" min="713" required value="<?= isset($internship_posting_info) ? $internship_posting_info['wage'] : ''; ?>">
                    </div>
                    <div class="col col-md-1 px-0 d-flex justify-content-center" data-placement="right" title="Tο ελάχιστο ποσό που μπορεί να δωθεί ως αμοιβή &#010 είναι ο κατώτατος μισθός, δηλαδή 713,00 €.">
                        <i class="fa fa-info-circle" style="padding-top:6px; font-size:25px;"></i>
                    </div>
                </div>
            </div>

            <div class="form-group" style="display: flex; flex-direction: column;">
                <label for="internship-description">Περιγραφή Θέσης</label>
                <textarea style="min-height: 100px;" oninput="document.getElementById('charCount').textContent = this.value.length + '/10000'" class="form-control" id="internship-description" name="internship-description" rows="4" cols="50" maxlength = "10000" optional><?= isset($internship_posting_info) ? $internship_posting_info['description'] : '';?></textarea>
                <span id="charCount" style="text-align:right;">
                    <script>
                        document.getElementById('charCount').textContent = document.getElementById('interest-description').value.length + '/10000';
                    </script>
                </span>
            </div>

            <div class="form-group" style="display: flex; margin-top: 1rem; justify-content: space-between;">
                <button onClick="if(!confirm('Η αγγελία πρόκειται να αποθηκευτεί προσωρινά.\nΕίστε σίγουρος/η γι\'αυτή την ενέργεια;')){return false;}else{
                        for(el of document.getElementsByTagName('input')){
                            el.required = false;
                        }
                        document.getElementById('university').required = false;
                        return true;}"
                    type="submit" class="btn btn-outline-primary <?= (isset($user) and $user['user_type'] === 'internship_provider') ? '' : 'disabled'?>" name="temporarily_saved_button" value="<?=isset($_REQUEST['internship_posting_id']) ? $_REQUEST['internship_posting_id'] : '';?>">
                    Προσωρινή Αποθήκευση
                </button>

                <button type="submit" onClick="if(!confirm('Η αγγελία πρόκειται να αποθηκευτεί οριστικά.\nΕίστε σίγουρος/η για αυτή την ενέργεια;')){return false;}" class="btn btn-primary <?= (isset($user) and $user['user_type'] === 'internship_provider') ? '' : 'disabled'?>" name="submit_button" value="<?=isset($_REQUEST['internship_posting_id']) ? $_REQUEST['internship_posting_id'] : '';?>">
                    Δημιουργία Αγγελίας
                </button>
            </div>
        </div>

    </form>
    <!-- Internship Posting Section End -->


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