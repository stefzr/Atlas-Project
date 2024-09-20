<?php
    session_start();
    if (isset($_SESSION["user_id"])) {
        
        $mysqli = require __DIR__ . "/database.php";
        
        $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";

        $result = $mysqli->query($sql);
        
        $user = $result->fetch_assoc();
    }
    $alreadyApplied = false;
    if(isset($user)){
        $sql = "SELECT * FROM application WHERE student_id = {$user['id']} and internship_posting_id = {$_REQUEST['internship_posting_id']}";
        $result = $mysqli ->query($sql);
        $application_info = $result->fetch_assoc();
        if(isset($application_info['status']) and $application_info['status'] !== 'temporarily_saved'){
            $alreadyApplied = true;
        }
    }
?>
<!DOCTYPE html>
<html>
<!-- https://www.free-css.com/free-css-templates/page282/edukate -->

<head>
    <meta charset="utf-8">
    <title>ΑΤΛΑΣ - Υποβολή Αίτησης</title>
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
            <a href="#">Φοιτητές</a>
        </li>

        <li class="breadcrumb-item">
            <a href="search-internship.php">Αναζήτηση Θέσεων Πρακτικής</a>
        </li>

        <li class="breadcrumb-item">
            <a href="view-internship-posting.php?internship_posting_id=<?= $_REQUEST['internship_posting_id']?>">Προβολή Θέσης Πρακτικής</a>
        </li>

        <li class="breadcrumb-item active">
            Υποβολή Αίτησης
        </li>
    </ul>
    <!-- Breadcrumb End -->

    <!-- Progress Tracker Start -->
    <link rel="stylesheet" href="css/progress-tracker.css" type="text/css">

    <section class="step-wizard" style="padding: 1rem 0;">
        <ul class="step-wizard-list">
            <li class="step-wizard-item">
                <span class="progress-count">1</span>
                <span class="progress-label">
                    <a href="search-internship.php">
                        Αναζήτηση Θέσεων
                    </a>
                </span>
            </li>

            <li class="step-wizard-item">
                <span class="progress-count">2</span>
                <span class="progress-label">
                    <a href="view-internship-posting.php?internship_posting_id=<?=$_REQUEST['internship_posting_id']?>">
                        Προβολή Θέσης
                    </a>
                </span>
            </li>

            <li class="step-wizard-item <?=$alreadyApplied ? '' : 'current-item'?>">
                <span class="progress-count">3</span>
                <span class="progress-label">Υποβολή Αίτησης</span>
            </li>
        </ul>
    </section>
    <!-- Progress Tracker End -->


    <!-- Main section Start -->
    <link rel="stylesheet" href="css/form-styling.css" type="text/css">

    <style>
        form input:valid, form select:valid{
            border: none ;
        }
    </style>

    <form action="process-application.php" method="post" style="width: 45%; margin: 1rem auto;" enctype="multipart/form-data">
        <?php if(!isset($user) or (isset($user) && $user['user_type'] !== 'student')): ?>
            <div class="form-item" style="padding: 1rem; background-color: white;">
                <em style="font-size: 20px; color: black; font-weight: bold;">Για την υποβολή της αίτησης, απαιτείται <a href="login.php">σύνδεση</a> ή <a href="signup-student.php">εγγραφή</a> ως φοιτητής/τρια </em>
            </div>
        <?php endif; ?>
        <?php
            $matchingUniversityDepartment = true;
            if(isset($user) and $user['user_type'] === 'student'):
                $sql = "SELECT * FROM internship_posting_has_university_departments WHERE internship_posting_id = {$_REQUEST['internship_posting_id']}";
                $result = $mysqli -> query($sql);
                $internship_posting_info = $result -> fetch_assoc();

                if(!$alreadyApplied and ($internship_posting_info['university_name'] !== $user['university_name'] or $internship_posting_info['university_department'] !== $user['university_department'])):
                    $matchingUniversityDepartment = false;
                ?>
                    <div class="form-item" style="padding: 1rem; background-color: white;">
                        <em style="font-size: 20px; color: black; font-weight: bold;">H συγκεκριμένη <a href="view-internship-posting.php?internship_posting_id=<?= $_REQUEST['internship_posting_id']?>">αγγελία</a>
                            δεν αναζητά φοιτητές/τριες για πρακτική από το τμήμα σας.
                        </em>
                    </div><?php
                endif;
            endif;
        ?>
        <div class="form-item">
            <header>
                <h5>
                    Στοιχεία Αίτησης
                </h5>
            </header>
            <?php if(!$alreadyApplied): ?>
                <div class="form-group">
                    <label for="report"><span class="required-field" title="Αυτό το πεδίο είναι υποχρεωτικό">*</span>Αναλυτική Βαθμολογία:</label>
                    <input type="file" id="report" name="report" accept="application/pdf" <?= (isset($user) and $user['user_type'] === 'student') ? 'required' : ''?> <?= !$matchingUniversityDepartment or !isset($_SESSION['user_id']) ? 'disabled' : '';?>>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <?php if(isset($application_info['performance_report']) && $application_info['performance_report']!== implode('_', array($_SESSION['user_id'], $_REQUEST['internship_posting_id'], ''))):?>
                    <label for="report-file"> <?= $alreadyApplied ? '' : 'Πρόσφατο';?> Αρχείο Αναλυτικής Βαθμολογίας: </label>
                    <a href="download-report.php?file=<?=$application_info['performance_report']?>"> 
                        <?php
                            $fileName = $application_info['performance_report'];
                            $splitFileName = explode('_', $fileName);
                            $prefix = $splitFileName[0] . "_" . $splitFileName[1] . "_";
                            $outputFileName = preg_replace('/' . $prefix . '/', '', $fileName, 1);

                            echo $outputFileName;?>
                        <i class="fa fa-download"></i>
                    </a>
                <?php endif;?>
            </div>

            <div class="form-group" style="display: flex; flex-direction: column;">
                <label for="interest-description">Περιγραφή Ενδιαφέροντος</label>
                <textarea style="min-height: 200px;" class="form-control" id="interest-description" oninput="document.getElementById('charCount').textContent = this.value.length + '/1000'" name="interest-description" rows="4" cols="50" maxlength="1000" <?= $alreadyApplied? 'disabled' : '';?> optional><?= isset($application_info['interest_description']) ? "{$application_info['interest_description']}" : ''; ?></textarea>
                <span id="charCount" style="text-align:right;">
                    <script>
                        document.getElementById('charCount').textContent = document.getElementById('interest-description').value.length + '/1000';
                    </script>
                </span>
            </div>
            <?php if($alreadyApplied): ?>
                <div class="form-group" style="display: flex; margin-top: 1rem; justify-content: flex-end;">
                    <a href="prof_std_applic.php" class="btn btn-primary">
                        Προβολή Αιτήσεων
                    </a>
                </div>
            <?php else: ?>
                <div class="form-group" style="display: flex; margin-top: 1rem; justify-content: space-between;">
                    <button onClick="if(!confirm('Η αίτησή σας πρόκειται να αποθηκευτεί προσωρινά.\nΕίστε σίγουρος/η γι\'αυτή την ενέργεια;')){return false;}else{
                        document.getElementById('report').required = false;
                        return true;
                    }" type="submit" class="btn btn-outline-primary <?= (isset($user) and $user['user_type'] === 'student' and $internship_posting_info and $matchingUniversityDepartment and !$alreadyApplied) ? '' : 'disabled'?>" name="temporarily_saved_button" value="<?=$_REQUEST['internship_posting_id']?>">
                        Προσωρινή Αποθήκευση
                    </button>
                    <button onClick="if(!confirm('Η αίτησή σας πρόκειται να υποβληθεί οριστικά.\nΕίστε σίγουρος/η γι\'αυτή την ενέργεια;')){return false;}" type="submit" class="btn btn-primary <?= (isset($user) and $user['user_type'] === 'student' and $matchingUniversityDepartment and !$alreadyApplied) ? '' : 'disabled'?>" style="align-self: end; background-color: green" name="submit_button" value="<?=$_REQUEST['internship_posting_id']?>">
                        Υποβολή Αίτησης
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </form>
    <!-- Main section End -->
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