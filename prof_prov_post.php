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
    <title>ΑΤΛΑΣ - Οι Αγγελίες μου</title>
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
        <li class="breadcrumb-item active">
            Αγγελίες Πρακτικής Άσκησης
        </li>
    </ul>
    <!-- Breadcrumb End -->

    <?php if(isset($user) and $user['user_type'] == 'internship_provider'):
        if(isset($_SESSION['successful_deletion']) and $_SESSION['successful_deletion'] == true):?>
            <script>
                let link = document.createElement('a');
                link.href = "publish-internship_posting.php";
                link.innerText = "Δημιούργησε νέα αγγελία";

                let span = document.createElement('span');
                span.innerText = " και βρες τους κατάλληλους φοιτητές/τριες για τη θέση!";

                let h6 = document.createElement('h6');
                h6.appendChild(link);
                h6.appendChild(span);

                swal({
                    title: "Επιτυχημένη Διαγραφή Αγγελίας!",
                    content: h6,
                    icon: "success",
                });
            </script><?php
            unset($_SESSION['successful_deletion']);
        endif;

        if(isset($_SESSION['successful_temporary_submission']) and $_SESSION['successful_temporary_submission'] == true):?>
            <script>
                swal({
                    title: "Επιτυχημένη Προσωρινή Αποθήκευση Αγγελίας!",
                    icon: "success",
                });
            </script><?php
            unset($_SESSION['successful_temporary_submission']);
        endif;

        if(isset($_SESSION['successful_submission']) and $_SESSION['successful_submission'] == true):?>
            <script>
                swal({
                    title: "Επιτυχημένη Υποβολή Αγγελίας!",
                    icon: "success",
                });
            </script><?php
            unset($_SESSION['successful_submission']);
        endif;
    ?>

        <!-- Nav-Tabs Start -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="prof_prov_info.php">Στοιχεία Φορέα</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">Οι Αγγελίες μου</a>
            </li>
        </ul>
        <!-- Nav-Tabs End -->

        <!-- Progress Tracker Start -->
        <link rel="stylesheet" href="css/progress-tracker.css" type="text/css">

        <section class="step-wizard" style="padding: 1rem 0; margin-top: 2px;">
            <ul class="step-wizard-list" style="margin: auto;">
                <li class="step-wizard-item">
                    <span class="progress-count">1</span>
                    <span class="progress-label">
                        <a href="publish-internship_posting.php">
                            Δημιουργία Αγγελίας
                        </a>
                    </span>
                </li>

                <li class="step-wizard-item current-item">
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

            tr.submitted{
                background-color: #CEEBEF;
            }
            
            tr.completed{
                background-color: #CFEFCE;
            }

            table {
                table-layout: fixed ;
                width: 100% ;
            }

            td{
            width: 20%;
            }
        </style>

        <!-- Main section Start -->
        <table style="margin: 1rem auto; max-width: 60%;">
            <tr style="background-color: #ECF0F4;">
                <th>Τίτλος Θέσης</th>
                <th>Κατάσταση Αγγελίας</th>
                <th>Αιτήσεις</th>
                <th>Ημερομηνία Υποβολής</th>
                <th>Διαθέσιμες Ενέργειες</th>
            </tr>

            <?php
                $mysqli = require __DIR__ . "/database.php";

                $sql = "SELECT * FROM internship_posting WHERE internship_provider_id = {$_SESSION['user_id']} order by date_of_modification desc";
                $result = $mysqli->query($sql);
                while($internship_posting_info = $result->fetch_assoc()):
                    ?>
                    <tr class="<?= $internship_posting_info['status']?>">
                        <td>
                            <a href="view-internship-posting.php?internship_posting_id=<?=$internship_posting_info['id']?>">
                                <?=$internship_posting_info['title']?>
                            </a>
                        </td>

                        <td>
                            <?php switch($internship_posting_info['status']):
                                case 'submitted':
                                    echo 'Δημοσιευμένη';
                                    break;

                                case 'temporarily_saved':
                                    echo 'Προσωρινά Αποθηκευμένη';
                                    break;

                                case 'completed':
                                    echo 'Ολοκληρωμένη';
                                    break;
                                endswitch;
                            ?>
                        </td>

                        <td>
                            <?php
                                $application_query = "SELECT * FROM application WHERE internship_posting_id = {$internship_posting_info['id']} and status != 'temporarily_saved';";
                                $application_result = $mysqli->query($application_query);
                                if($application_result->num_rows > 0):?>
                                    <a href="prof_prov_applic.php?internship_posting_id=<?=$internship_posting_info['id'];?>&internship_title=<?=$internship_posting_info['title']?>">
                                    <?php

                                        if($application_result->num_rows === 1):
                                            echo $application_result->num_rows . ' αίτηση';
                                        else:
                                            echo $application_result->num_rows . ' αιτήσεις';
                                        endif;?>
                                    </a>
                                <?php else:
                                    echo '0 αιτήσεις';
                                endif;?>
                        </td>

                        <td>
                            <?= date("d-m-Y H:i:s ", strtotime($internship_posting_info['date_of_modification']))?>
                        </td>

                        <style>
                            .action-col a{
                                text-decoration:none;
                            }
                        </style>

                        <td class="action-col">
                            <?php switch($internship_posting_info['status']):
                                case 'submitted': ?>
                                    <a href="view-internship-posting.php?internship_posting_id=<?= $internship_posting_info['id']; ?>">
                                        <i class="fas fa-eye fa-2x" title="Προεπισκόπηση Αγγελίας"></i>
                                    </a>
                                <?php break;

                                case 'temporarily_saved':?>
                                    <a href="delete-internship_posting.php?internship_posting_id=<?= $internship_posting_info['id']; ?>" onClick="if(!confirm('Πρόκειται να πραγματοποιηθεί οριστική διαγραφή της αγγελίας.\nΕίστε σίγουρος/η γι\'αυτή την ενέργεια;')){return false;}">
                                        <i class="fa fa-trash fa-2x" title="Διαγραφή Αγγελίας" style="margin: 0 1rem;"></i>
                                    </a>

                                    <a href="publish-internship_posting.php?internship_posting_id=<?= $internship_posting_info['id'];?>">
                                        <i class="fa fa-pencil-alt fa-2x" title="Επεξεργασία Αγγελίας"></i>
                                    </a>
                                <?php break;

                                case 'completed': ?>
                                    <a href="view-internship-posting.php?internship_posting_id=<?= $internship_posting_info['id']; ?>">
                                        <i class="fas fa-eye fa-2x" title="Προεπισκόπηση Αγγελίας"></i>
                                    </a>
                                <?php break;
                                endswitch;
                            ?>
                        </td>
                    </tr>
                <?php endwhile;
            ?>
        </table>
    <?php else: ?>
        <em style="font-size:24px">
            Για να αποκτήσετε πρόσβαση σε αυτή τη σελίδα <a href="login.php">συνδεθείτε</a>
            ή <a href="signup-internship-provider.php">εγγραφείτε</a> ως φορέας υποδοχής.
        </em>
    <?php endif; ?>
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