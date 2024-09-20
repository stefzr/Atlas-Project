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
    <title>ΑΤΛΑΣ - Αναζήτηση Θέσεων Πρακτικής</title>
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
            <a href="#">Φοιτητές</a>
        </li>
        <li class="breadcrumb-item active">
            Αναζήτηση Θέσεων Πρακτικής
        </li>
    </ul>
    <!-- Breadcrumb End -->

    <!-- Progress Tracker Start -->
    <link rel="stylesheet" href="css/progress-tracker.css" type="text/css">

    <section class="step-wizard" style="padding: 1rem 0;">
        <ul class="step-wizard-list" style="padding: 0; margin: auto;">
            <li class="step-wizard-item current-item">
                <span class="progress-count">1</span>
                <span class="progress-label">Αναζήτηση Θέσεων</span>
            </li>

            <li class="step-wizard-item">
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

    <!-- https://bbbootstrap.com/snippets/bootstrap-ecommerce-product-list-sidebar-filters-45421504 -->
    <div class="row" style="width: 100%;">
        <div class="col-2" style="padding-right: 0;">
            <section id="sidebar" style="background-color: #f7f7f7;">
                <form style="display: flex; flex-direction: column; margin: 1rem auto;" action="search-internship.php" method="get" autocomplete="off">
                    <style>
                        .form-group{
                            padding: .8rem 0;
                        }
                    </style>

                    <div class="form-item">
                        <header>
                            <h5 class="p-1 border-bottom"> Κριτήρια Αναζήτησης </h5>
                        </header>

                        <div class="form-group">
                            <label for="internship-title">Τίτλος Θέσης</label>
                            <input type="text" class="form-control" id="internship-title" name="internship-title" value="<?= !empty($_GET['internship-title']) ? $_GET['internship-title'] : '';?>">
                        </div>

                        <div class="form-group">
                            <label for="university">Επιλογή Τμήματος</label>
                            <select name="university" id="university" class="form-control" style="text-overflow: ellipsis;">
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

                                            $selected_flag = false;
                                            if(!empty($_GET['university'])):
                                                $university_department_info = explode('-', $_GET['university']);

                                                $selected_flag = false;
                                                if($university_department_info[0] === $university['name'] and $university_department_info[1] === $university_department['name']):
                                                    $selected_flag = true;
                                                endif;
                                            endif;?>
                                            <option value="<?= $university['name'] .'-'.$university_department['name']; ?>" <?= $selected_flag ? 'selected' : '';?> >
                                                <?= $university_department['name'] ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </optgroup>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="internship-duration-3-Months">Διάρκεια Απασχόλησης</label>
                            <div class="form-check ml-2">
                                <input class="form-check-input" type="checkbox" name="internship-duration[]" id="internship-duration-3-Months" value="3-Months" <?= !empty($_GET['internship-duration']) && in_array('3-Months', $_GET['internship-duration']) ? 'checked' : '';?>>
                                <label class="form-check-label" for="internship-duration-3-Months">Τρίμηνη</label>
                            </div>

                            <div class="form-check ml-2 mt-1">
                                <input class="form-check-input" type="checkbox" name="internship-duration[]" id="internship-duration-6-Months" value="6-Months" <?= !empty($_GET['internship-duration']) && in_array('6-Months', $_GET['internship-duration']) ? 'checked' : '';?>>
                                <label class="form-check-label" for="internship-duration-6-Months">Εξάμηνη</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="internship-type-Part-Time">Τρόπος Απασχόλησης</label>

                            <div class="form-check ml-2">
                                <input class="form-check-input" type="checkbox" name="internship-type[]" id="internship-type-Part-Time" value="Part-Time" <?= !empty($_GET['internship-type']) && in_array('Part-Time', $_GET['internship-type']) ? 'checked' : '';?>>
                                <label class="form-check-label" for="internship-type-Part-Time">Μερική</label>
                            </div>

                            <div class="form-check ml-2 mt-1">
                                <input class="form-check-input" type="checkbox" name="internship-type[]" id="internship-type-Full-Time" value="Full-Time" <?= !empty($_GET['internship-type']) && in_array('Full-Time', $_GET['internship-type']) ? 'checked' : '';?>>
                                <label class="form-check-label" for="internship-type-Full-Time">Πλήρης</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="location">Τοποθεσία Πρακτικής</label>
                            <input class="form-control" type="text" name="location" id="location" list="datalistOptions" placeholder="π.χ.  Αθήνα - Περιστέρι" value="<?= !empty($_GET['location']) ? $_GET['location'] : '';?>">
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
                            <label for="internship_date">Ημερομηνία Έναρξης Πρακτικής</label>
                            <input class="form-check" type="date" id="internship_date" name="internship_date" value="<?= !empty($_GET['internship_date']) ? $_GET['internship_date'] : '';?>">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" style="align-self: center;">Αναζήτηση Θέσεων</button>
                </form>
            </section>
        </div>

        <style>
            label{
                font-weight: bold;
            }

            .wrap-section{
                width: fit-content;
            }

            li.internship-position{
                border: 1px solid #f0edff;
                padding: 8px 16px;
                background-color: #fbfbfb;
            }

            li.internship-position > *{
                margin: 1rem;
            }

            .internship-posts > *{
                margin-bottom: 1rem;
            }
        </style>
    
        <div class="col-10" style="margin: 1rem auto;">
            <section id="postings_list">
                <div class="container col-6">
                    <ul class="internship-posts">
                        <?php
                        $mysqli = require __DIR__ . "/database.php";
                        $sql = "SELECT * FROM internship_posting";

                        $conditions = array();

                        $conditions[] = "status='submitted'";

                        if(!empty($_GET['internship-title'])){
                            $internship_title = $_GET['internship-title'];
                            $conditions[] = "title LIKE '%$internship_title%'";
                        }

                        if(!empty($_GET['location'])){
                            $location = $_GET['location'];
                            $conditions[] = "location LIKE '%$location%'";
                        }

                        if(!empty($_GET['internship_date'])){
                            $internship_date = $_GET['internship_date'];
                            $conditions[] = "start_date_of_internship='$internship_date'";
                        }

                        if(!empty($_GET['internship-duration']) && count($_GET['internship-duration']) < 2){
                            $internship_duration = $_GET['internship-duration'][0];
                            $conditions[] = "duration='$internship_duration'";
                        }

                        if(!empty($_GET['internship-type']) && count($_GET['internship-type']) < 2){
                            $internship_type = $_GET['internship-type'][0];
                            $conditions[] = "employment_type='$internship_type'";
                        }
                        
                        if(count($conditions) > 0) {
                            $sql .= " WHERE " . implode(' AND ', $conditions);
                        }

                        if(!empty($_GET['university'])){
                            $university_department_info = explode('-', $_GET['university']);
                        }
                        $result = $mysqli->query($sql);
                        if($result -> num_rows == 0):?>
                            <em style="font-size: 1.5rem;">
                                Δε βρέθηκαν θέσεις πρακτικής. <a href="search-internship.php">Εμφάνιση όλων των διαθέσιμων πρακτικών</a>
                            </em>
                        <?php endif;
                        while($internship_posting = mysqli_fetch_assoc($result)):
                            $university_department_filter = false;
                            if(!empty($_GET['university'])){
                                $university_department_info = explode('-', $_GET['university']);
                                $sql = "SELECT * FROM internship_posting_has_university_departments
                                        WHERE internship_posting_has_university_departments.internship_posting_id = '".$internship_posting['id']."' and
                                              internship_posting_has_university_departments.university_department = '".$university_department_info[1]."' and
                                              internship_posting_has_university_departments.university_name = '".$university_department_info[0]."'";
                                $res = $mysqli->query($sql);
                                if($res -> num_rows == 0){
                                    $university_department_filter = true;
                                }
                            }
                            if(!$university_department_filter):?>
                            <li class="col internship-position">
                                <div class="wrap-section">
                                    <large class="fa fa-building"></large>
                                    <large>
                                        <?php
                                            $sql = "SELECT * FROM user WHERE user.id = '".$internship_posting['internship_provider_id']."'";
                                            $res = $mysqli->query($sql);
                                            $user = mysqli_fetch_assoc($res);
                                            echo $user['company_name'];
                                        ?>
                                    </large>
                                    <h5><?= $internship_posting['title'] ?></h5>
                                </div>

                                <div style="display:flex; justify-content: space-between;">
                                    <div style="display:flex; justify-content: space-between;">
                                        <div>
                                            <div class="wrap-section">
                                                <small class="fas fa-map-marker-alt"></small>
                                                <small>
                                                    <?= $internship_posting['location'] ?>
                                                </small>
                                            </div>
        
                                            <div class="wrap-section">
                                                <small class="fa fa-clock"></small>
                                                <small>
                                                    <?= $internship_posting['duration'] === '6-Months' ? 'Εξάμηνη': 'Τρίμηνη'; echo ' Διάρκεια' ?>
                                                </small>
                                            </div>
                                        </div>

                                        <div style="margin:0 16px;">
                                            <div class="wrap-section">
                                                <small class="fa fa-university"></small>
                                                <small>
                                                    <?php
                                                        $sql = "SELECT * FROM internship_posting_has_university_departments WHERE internship_posting_has_university_departments.internship_posting_id = '".$internship_posting['id']."'";
                                                        $res = $mysqli->query($sql);
                                                        $university_department = mysqli_fetch_assoc($res);

                                                        $sql = "SELECT * FROM university WHERE university.name = '".$university_department['university_name']."'";
                                                        $res = $mysqli->query($sql);
                                                        $university = mysqli_fetch_assoc($res);
                                                        echo $university['name_abbreviation'] . ' - ' . $university_department['university_department'];
                                                    ?>
                                                </small>
                                            </div>

                                            <div class="wrap-section">
                                                    <small class="fa fa-business-time"></small>
                                                    <small>
                                                        <?= $internship_posting['employment_type'] === 'Full-Time' ? 'Πλήρης': 'Μερική'; echo ' Απασχόληση'; ?>
                                                    </small>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <button onclick="window.location='view-internship-posting.php?internship_posting_id=<?= $internship_posting['id']?>';" name="internship_posting_id" type="submit" class="btn btn-primary" value="<?= $internship_posting['id']?>">Δες τη θέση</button>
                                </div>
                            </li>
                        <?php endif; ?>
                        <?php endwhile ?>
                    </ul>
                </div>
            </section>
        </div>
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

    *{
        box-sizing: border-box;
    }
    body{
        color: grey;
    }
    #sidebar{
        width: 100%;
        padding: 10px;
        margin: 0;
        float: left;
    }
    #products{
        width: 100%;
        padding: 10px;
        margin: 0;
        float: right;
    }
    ul{
        list-style: none;
        padding: 5px;
    }
    li a{
        color: ;
        text-decoration: none;
    }
    li a:hover{
        text-decoration: none;
        color: ;
    }
    .fa-circle{
        font-size: 20px;
    }
    #red{
        color: #e94545d7;
    }
    #teal{
        color: rgb(69, 129, 129);
    }
    #blue{
        color: #0000ff;
    }
    .card{
        width: 250px;
        display: inline-block;
        height: 300px;
    }
    .card-img-top{
        width: 250px;
        height: 210px;
    }
    .card-body p{
        margin: 2px;
    }
    .card-body{
        padding: 0;
        padding-left: 2px;
    }
    .filter{
        display: none;
        padding: 0;
        margin: 0;
    }
    </style>

</html>