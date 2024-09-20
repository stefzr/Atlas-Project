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
    <title>ΑΤΛΑΣ - Αιτήσεις Αγγελίας</title>
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
            <a href="prof_prov_info.php">Προφίλ</a>
        </li>
        <li class="breadcrumb-item">
            <a href="prof_prov_post.php">
                Αγγελίες Πρακτικής Άσκησης
            </a>
        </li>
        <li class="breadcrumb-item active">
            Αιτήσεις Πρακτικής Άσκησης
        </li>
    </ul>
    <!-- Breadcrumb End -->

    <?php
        if(isset($_SESSION['successful_approval']) and $_SESSION['successful_approval'] == true):?>
            <script>
                swal({
                    title: "Επιτυχημένη Έγκριση Αίτησης!",
                    text: "Όσες αιτήσεις ήταν εκκρεμείς έχουν απορριφθεί.",
                    icon: "success",
                });
            </script><?php
            unset($_SESSION['successful_approval']);
        endif;

        if(isset($_SESSION['successful_rejection']) and $_SESSION['successful_rejection'] == true):?>
            <script>
                swal({
                    title: "Επιτυχημένη Απόρριψη Αίτησης!",
                    icon: "success",
                });
            </script><?php
            unset($_SESSION['successful_rejection']);
        endif;
    ?>

    <!-- Progress Tracker Start -->
    <link rel="stylesheet" href="css/progress-tracker.css" type="text/css">

    <section class="step-wizard" style="padding: 1rem 0;">
        <ul class="step-wizard-list" style="margin: auto;">
            <li class="step-wizard-item">
                <span class="progress-count">1</span>
                <span class="progress-label">
                    <a href="publish-internship_posting.php">
                        Δημιουργία Αγγελίας
                    </a>
                </span>
            </li>

            <li class="step-wizard-item">
                <span class="progress-count">2</span>
                <span class="progress-label">
                    <a href="prof_prov_post.php">
                        Αναμονή για Αιτήσεις
                    </a>
                </span>
            </li>

            <li class="step-wizard-item current-item">
                <span class="progress-count">3</span>
                <span class="progress-label">Αποδοχή ή Απόρριψη Αιτήσεων</span>
            </li>
        </ul>
    </section>
<!-- Progress Tracker End -->
    <style>
        th, td {
            text-align: center;
            border: 1px solid black;
            padding: 1rem;
        }

        th{
            color: black;
            font-weight: bold;
        }

        tr.temporarily_saved{
            background-color: #FAFFC6;
        }

        tr.approved{
            background-color: #CFEFCE;
        }

        tr.pending{
            background-color: #CEEBEF;
        }

        tr.rejected{
            background-color: #EFD4CE;
        }

        table {
            width: 100% ;
        }
    </style>

    <!-- Main section Start -->
    <table style="margin: 1rem auto; max-width: 90%;">
        <tr style="background-color: #ECF0F4;">
            <th>Τίτλος Θέσης</th>
            <th>Ονοματεπώνυμο Φοιτητή/τριας</th>
            <th>Email Φοιτητή/τριας</th>
            <th>Αρχείο Αναλυτικής Βαθμολογίας</th>
            <th>Περιγραφή Ενδιαφέροντος</th>
            <th>Κατάσταση Αίτησης</th>
            <th>Διαθέσιμες Ενέργειες</th>
        </tr>

        <?php
            $mysqli = require __DIR__ . "/database.php";

            $sql = "SELECT * FROM application WHERE internship_posting_id = {$_REQUEST['internship_posting_id']} and status != 'temporarily_saved'";
            $result = $mysqli->query($sql);
            while($application_info = $result->fetch_assoc()):
                $sql = "SELECT * FROM user WHERE id = {$application_info['student_id']}";
                $user_result = $mysqli->query($sql);
                $user_info = $user_result->fetch_assoc();
                ?>
                <tr class="<?= $application_info['status']?>">
                    <td>
                        <a href="view-internship-posting.php?internship_posting_id=<?=$_REQUEST['internship_posting_id']?>">
                            <?=$_REQUEST['internship_title']?>
                        </a>
                    </td>

                    <td>
                        <?= $user_info['first_name'] . ' ' . $user_info['last_name']; ?>
                    </td>

                    <td>
                        <?= $user_info['email'];?>
                    </td>

                    <td>
                        <a href="download-report.php?file=<?=$application_info['performance_report']?>"> 
                            <?php
                                $fileName = $application_info['performance_report'];
                                $splitFileName = explode('_', $fileName);
                                $prefix = $splitFileName[0] . "_" . $splitFileName[1] . "_";
                                $outputFileName = preg_replace('/' . $prefix . '/', '', $fileName, 1);

                                echo $outputFileName;?>
                                <i class="fa fa-download"></i>
                        </a>
                    </td>

                    <td style="text-align: justify;">
                        <?= $application_info['interest_description'] ?>
                    </td>

                    <td>
                        <?php switch($application_info['status']):
                                case 'pending':
                                    echo 'Εκκρεμής';
                                    break;
    
                                case 'approved':
                                    echo 'Εγκεκριμένη';
                                    break;
    
                                case 'rejected':
                                    echo 'Απορριφθείσα';
                                    break;
                                endswitch;
                            ?>
                        </td>
                    </td>

                    <style>
                        .action-col a{
                            text-decoration:none;
                        }
                        
                        .action-col i:hover, .action-col button:hover{
                            opacity: 0.7;
                        }

                        .action-col i:hover{
                            cursor: pointer;
                        }
                    </style>

                    <td class="action-col">
                        <?php switch($application_info['status']):
                            case 'pending': ?>
                                <a onClick="if(!confirm('Η αίτηση πρόκειται να γίνει δεκτή.\nΕίστε σίγουρος/η γι\'αυτή την ενέργεια;')){return false;}" href="approve-application.php?internship_posting_id=<?=$_REQUEST['internship_posting_id'];?>&application_id=<?=$application_info['id'];?>" style="margin-right: 1rem;">
                                    <i class="fa fa-check fa-2x" style="color: green;" title="Αποδοχή Αίτησης"></i>
                                </a>

                                <form id="form-<?=$application_info['id']?>" action="reject-application.php" method="post" style="display:inline;">
                                    <input type="hidden" name="rejection_message" id="rejection-message<?=$application_info['id'];?>">
                                    <input type="hidden" name="internship_posting_id" value="<?=$_REQUEST['internship_posting_id'];?>">
                                    <input type="hidden" name="application_id" value="<?= $application_info['id'];?>">
                                    <button style="background-color: #CEEBEF; border: none; color: red;"  type="submit" class="fa fa-times fa-2x" style="color: red;" title="Απόρριψη Αίτησης"></button>
                                </form>

                                <script type="text/javascript">
                                    document.getElementById(`form-<?=$application_info['id']?>`).addEventListener("submit", function(event){
                                        event.preventDefault();
                                        if(sendRejectionMessage(`form-<?=$application_info['id']?>`)){
                                            document.getElementById(`form-<?=$application_info['id']?>`).submit();
                                        }
                                    });

                                    function sendRejectionMessage(application_id){
                                        do{
                                            var answer = prompt('Για την απόρριψη της αίτησης, απαιτείται αιτιολόγηση.');
                                        } while(answer !== null && answer === "")

                                        if(answer === null || answer === ''){
                                            return false;
                                        }
                                        document.getElementById(`rejection-message<?=json_decode($application_info['id']);?>`).value = answer;

                                        return confirm('Η αίτηση πρόκειται να απορριφθεί οριστικά.\nΕίστε σίγουρος/η γι\'αυτή την ενέργεια;');
                                    }
                                </script>
                            <?php break;
                            case 'approved': ?>
                                <i class="fa-2x" title="Καμία Διαθέσιμη Ενέργεια" style="color: black; cursor: initial;">Ø</i>
                            <?php break;

                            case 'rejected':?>
                                <script type="text/javascript">
                                    let rejection_message = <?= json_encode($application_info['rejection_message']); ?>;
                                </script>

                                <i class="fa fa-file-excel fa-2x" style="cursor: pointer; color: #fd4a4a;" title="Μήνυμα Απόρριψης Αίτησης" onClick="swal({title: 'Μήνυμα Απόρριψης Αίτησης', text: rejection_message,});"></i>
                            <?php break;
                            endswitch;
                        ?>
                    </td>
                </tr>
            <?php endwhile;
        ?>
    </table>
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