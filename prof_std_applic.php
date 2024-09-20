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
    <title>ΑΤΛΑΣ - Οι Αιτήσεις μου</title>
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
            <a href="prof_std_info.php">Προφίλ</a>
        </li>
        <li class="breadcrumb-item active">
            Αιτήσεις Πρακτικής Άσκησης
        </li>
    </ul>
    <!-- Breadcrumb End -->

    <?php if(isset($user) and $user['user_type'] == 'student'):?>
        <!-- Nav-Tabs Start -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="prof_std_info.php">Στοιχεία Φοιτητή/τριας</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">Οι Αιτήσεις μου</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="prof_std_notif.php">Ειδοποιήσεις</a>
            </li>
        </ul>
        <!-- Nav-Tabs End -->

        <?php
            if(isset($_SESSION['successful_deletion']) and $_SESSION['successful_deletion'] == true):?>
                <script>
                    let link = document.createElement('a');
                    link.href = "search-internship.php";
                    link.innerText = "Αναζήτησε αγγελίες";

                    let span = document.createElement('span');
                    span.innerText = " και βρες τη θέση πρακτικής που σου ταιριάζει!"

                    let h6 = document.createElement('h6');
                    h6.appendChild(link);
                    h6.appendChild(span);

                    swal({
                        title: "Επιτυχημένη Διαγραφή Αίτησης!",
                        content: h6,
                        icon: "success",
                    });
                </script><?php
                unset($_SESSION['successful_deletion']);
            endif;
        ?>

        <?php
            if(isset($_SESSION['successful_submission']) and $_SESSION['successful_submission'] == true):?>
                <script>
                    swal({
                        title: "Επιτυχημένη Υποβολή Αίτησης!",
                        icon: "success",
                    });
                </script><?php
                unset($_SESSION['successful_submission']);
            endif;

            if(isset($_SESSION['successful_temporary_submission']) and $_SESSION['successful_temporary_submission'] == true):?>
                <script>
                    swal({
                        title: "Επιτυχημένη Προσωρινή Αποθήκευση Αίτησης!",
                        icon: "success",
                    });
                </script><?php
                unset($_SESSION['successful_temporary_submission']);
            endif;
        ?>

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
                table-layout: fixed ;
                width: 100% ;
            }

            td{
            width: 25%;
            }
        </style>
        <!-- Main section Start -->
        <table style="margin: 1rem auto; width: 55%;">
            <tr style="background-color: #ECF0F4;">
                <th>Τίτλος Θέσης</th>
                <th>Κατάσταση Αίτησης</th>
                <th>Ημερομηνία Υποβολής</th>
                <th>Διαθέσιμες Ενέργειες</th>
            </tr>

            <?php
                $mysqli = require __DIR__ . "/database.php";

                $sql = "SELECT * FROM application WHERE student_id = {$_SESSION["user_id"]} order by date_of_modification desc";

                $result = $mysqli->query($sql);
                while($application_info = $result->fetch_assoc()):
                    $sql = "SELECT * FROM internship_posting WHERE id = {$application_info['internship_posting_id']}";

                    $res = $mysqli->query($sql);
                    $internship_posting_info = $res->fetch_assoc();?>
                    <tr class="<?= $application_info['status']?>">
                        <td>
                            <a href="view-internship-posting.php?internship_posting_id=<?=$internship_posting_info['id']?>">
                                <?=$internship_posting_info['title']?>
                            </a>
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

                                case 'temporarily_saved':
                                    echo 'Προσωρινά Αποθηκευμένη';
                                    break;
                                endswitch;
                            ?>
                        </td>

                        <td>
                            <?= date("d-m-Y H:i:s ", strtotime($application_info['date_of_modification']))?>
                        </td>

                        <style>
                            .action-col a{
                                text-decoration: none;
                            }

                            .action-col i:hover{
                                opacity: 0.7;
                            }
                        </style>

                        <td class="action-col">
                            <?php switch($application_info['status']):
                                case 'approved': ?>
                                    <a href="apply-for-internship.php?internship_posting_id=<?=$application_info['internship_posting_id'];?>">
                                        <i class="fas fa-eye fa-2x" title="Προεπισκόπηση Αίτησης"></i>
                                    </a>
                                <?php break;

                                case 'pending':?>
                                    <a href="delete-application.php?application_id=<?=$application_info['id'];?>" onClick="if(!confirm('Πρόκειται να πραγματοποιηθεί οριστική διαγραφή της αίτησής σας.\nΕίστε σίγουρος/η γι\'αυτή την ενέργεια;')){return false;}" style="margin: 0 1rem;">
                                        <i class="fa fa-trash fa-2x" title="Διαγραφή Αίτησης"></i>
                                    </a>

                                    <a href="apply-for-internship.php?internship_posting_id=<?=$application_info['internship_posting_id'];?>">
                                        <i class="fas fa-eye fa-2x" title="Προεπισκόπηση Αίτησης"></i>
                                    </a>
                                <?php break;

                                case 'temporarily_saved':?>
                                    <a href="delete-application.php?application_id=<?=$application_info['id'];?>" onClick="if(!confirm('Πρόκειται να πραγματοποιηθεί οριστική διαγραφή της αίτησής σας.\nΕίστε σίγουρος/η γι\'αυτή την ενέργεια;')){return false;}" style="margin: 0 1rem;">
                                        <i class="fa fa-trash fa-2x" title="Διαγραφή Αίτησης"></i>
                                    </a>

                                    <a href="apply-for-internship.php?internship_posting_id=<?=$application_info['internship_posting_id'];?>">
                                        <i class="fa fa-pencil-alt fa-2x" title="Επεξεργασία Αίτησης"></i>
                                    </a>
                                <?php break;

                                case 'rejected':?>
                                    <a href="apply-for-internship.php?internship_posting_id=<?=$application_info['internship_posting_id'];?>" style="margin: 0 1rem;">
                                        <i class="fas fa-eye fa-2x" title="Προεπισκόπηση Αίτησης"></i>
                                    </a>
                                    <script>
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
    <?php else: ?>
        <em style="font-size:24px">
            Για να αποκτήσετε πρόσβαση σε αυτή τη σελίδα <a href="login.php">συνδεθείτε</a>
            ή <a href="signup-student.php">εγγραφείτε</a> ως φοιτητής/τρια.
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