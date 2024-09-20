<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<!-- https://www.free-css.com/free-css-templates/page282/edukate -->

<head>
    <meta charset="utf-8">
    <title>ΑΤΛΑΣ - Προβολή Θέσης Πρακτικής Άσκησης</title>
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

        <li class="breadcrumb-item active">
            Προβολή Θέσης Πρακτικής
        </li>
    </ul>
    <!-- Breadcrumb End -->

    <link rel="stylesheet" href="css/form-styling.css" type="text/css">

    <!-- Progress Tracker Start -->
    <link rel="stylesheet" href="css/progress-tracker.css" type="text/css">

    <section class="step-wizard">
        <ul class="step-wizard-list">
            <li class="step-wizard-item">
                <span class="progress-count">1</span>
                <span class="progress-label">
                    <a href="search-internship.php">
                        Αναζήτηση Θέσεων
                    </a>
                </span>
            </li>

            <li class="step-wizard-item current-item">
                <span class="progress-count">2</span>
                <span class="progress-label">Προβολή Θέσης</span>
            </li>

            <li class="step-wizard-item">
                <span class="progress-count">3</span>
                <span class="progress-label">Υποβολή Αίτησης</span>
            </li>
        </ul>
    </section>
    <!-- Progress Tracker End -->

    <?php
        // Read data of internship posting from database
        $mysqli = require __DIR__ . "/database.php";

        $sql = "SELECT * FROM internship_posting WHERE id = '".$_REQUEST['internship_posting_id']."'";
        $res = $mysqli->query($sql);

        $internship_posting = mysqli_fetch_assoc($res);

        $sql = "SELECT * FROM user WHERE id = '".$internship_posting['internship_provider_id']."'";
        $res = $mysqli->query($sql);

        $internship_provider = mysqli_fetch_assoc($res);

        $sql = "SELECT * FROM internship_posting_has_university_departments WHERE internship_posting_id = '".$_REQUEST['internship_posting_id']."'";
        $res = $mysqli->query($sql);

        $university_department = mysqli_fetch_assoc($res);

        $sql = "SELECT * FROM university WHERE name = '".$university_department['university_name']."'";
        $res = $mysqli->query($sql);

        $university = mysqli_fetch_assoc($res);
    ?>

    <!-- Display of internship posting Start -->
    <style>
        section > *{
            padding: 1rem;
        }
    </style>

    <section style="max-width: 45%; min-width: 40%; margin: 1rem auto; border: 1px solid #fff2f4; background-color: #f9f9f9;">
        <div>
            <h5 style="border-bottom: 1px solid #b2b2b2;">
                <?= $internship_posting['title'] ?>
            </h5>
            <div style="display: flex; justify-content: space-between;">
                <div>
                    <large class="fa fa-building"></large>
                    <large>
                        <?= $internship_provider['company_name'] ?>
                    </large>
                </div>

                <ul style="display: flex;">
                    <li style="margin-left: .8rem;">
                        <large class="fa fa-envelope"></large>
                        <large>
                            <?= $internship_provider['email'] ?>
                        </large>
                    </li>
                </ul>
            </div>
        </div>

        <style>
            .list {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }

            .list-item {
                display: flex; 
                width: 32%;
                border: 1px solid rgb(202, 202, 202);
                padding: .5rem;
                background-color: white;
                margin-bottom: 1rem;
            }

            .list-content {
                background-color: #fff;
                display: flex;
                flex-direction: column;
                padding: .5em;
                width: 100%;
            }

            .list-content > large{
                padding-top: .3rem;
            }
        </style>

        <ul class="list">
            <li class="list-item">
                <div class="list-content">
                    <div>
                        <large class="fa fa-university"></large>
                        <large style="color: black; font-weight: bold;">
                            Τμήμα
                        </large>
                    </div>

                    <large>
                        <?= $university['name_abbreviation'] . ' - ' . $university_department['university_department'];?>
                    </large>
                </div>
            </li>

            <li class="list-item">
                <div class="list-content">
                    <div>
                        <large class="fa fa-clock"></large>
                        <large style="color: black; font-weight: bold;">
                            Διάρκεια Απασχόλησης
                        </large>
                    </div>

                    <large>
                        <?= $internship_posting['duration'] === '6-Months' ? 'Εξάμηνη': 'Τρίμηνη';?>
                    </large>
                </div>
            </li>

            <li class="list-item">
                <div class="list-content">
                    <div>
                        <large class="fa fa-business-time"></large>
                        <large style="color: black; font-weight: bold;">
                            Τύπος Απασχόλησης
                        </large>
                    </div>

                    <large>
                        <?= $internship_posting['employment_type'] === 'Part-Time' ? 'Μερική': 'Πλήρης'; ?>
                    </large>
                </div>
            </li>

            <li class="list-item">
                <div class="list-content">
                    <div>
                        <large class="fas fa-money-bill-alt"></large>
                        <large style="color: black; font-weight: bold;">
                            Αμοιβή
                        </large>
                    </div>
                    <large>
                        <?= $internship_posting['wage'] . '€';?>
                    </large>
                </div>
            </li>

            <li class="list-item">
                <div class="list-content">
                    <div>
                        <large class="fas fa-map-marker-alt"></large>
                        <large style="color: black; font-weight: bold;">
                            Τοποθεσία Πρακτικής
                        </large>
                    </div>
        
                    <large>
                        <?= $internship_posting['location']; ?>
                    </large>
                </div>
            </li>

            <li class="list-item">
                <div class="list-content">
                    <div>
                        <large class="fas fa-calendar-alt"></large>
                        <large style="color: black; font-weight: bold;">
                            Ημερομηνία Απασχόλησης
                        </large>
                    </div>

                    <large>
                        <?php
                        $addMonths = $internship_posting['duration'] === '3-Months' ? 3 : 6;
                            echo 'Από ' . date("d-m-Y", strtotime($internship_posting['start_date_of_internship'])) . '<br> Μέχρι ' . date('d-m-Y', strtotime("+$addMonths months", strtotime($internship_posting['start_date_of_internship'])));
                        ?>
                    </large>
                </div>
            </li>

            <li class="list-item" style="width: 100%;">
                <div class="list-content">
                    <div>
                        <large class="fa fa-file-alt"></large>
                        <large style="color: black; font-weight: bold;">
                            Περιγραφή Θέσης
                        </large>
                    </div>
                    <textarea style="margin-top: .3rem; min-height: 100px;" class="form-control" id="internship-description" name="internship-description" rows="4" cols="50" readonly><?=htmlspecialchars($internship_posting['description']);?></textarea>
                </div>
            </li>

            <?php if(!isset($user) or (isset($user) and $user['user_type'] === 'student')): ?>
                <?php
                    include 'check_if_application_exists.php';
                ?>
                <li style="display: flex; margin-top: 1rem; width: 100%; justify-content: flex-end;">
                    <button onclick="window.location='apply-for-internship.php?internship_posting_id=<?= $internship_posting['id']?>';" class="btn btn-primary">Κάνε Αίτηση</button>
                </li>
            <?php endif; ?>
        </ul>
    </section>
    <!-- Display of internship posting End -->

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