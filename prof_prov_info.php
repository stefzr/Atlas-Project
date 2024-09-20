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
    <title>ΑΤΛΑΣ - Στοιχεία Λογαριασμού Φορέα Υποδοχής</title>
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
            <a href="#">Προφίλ</a>
        </li>
        <li class="breadcrumb-item active">
            Στοιχεία Φορέα Υποδοχής
        </li>
    </ul>
    <!-- Breadcrumb End -->

    <!-- Nav-Tabs Start -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Στοιχεία Φορέα</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="prof_prov_post.php">Οι Αγγελίες μου</a>
        </li>
    </ul>
    <!-- Nav-Tabs End -->

    <?php
        if(isset($_SESSION['successful_email_change']) and $_SESSION['successful_email_change'] == true):?>
            <script>
                swal({
                    title: "Επιτυχημένη αλλαγή email!",
                    icon: "success",
                });
            </script><?php
            unset($_SESSION['successful_email_change']);
        endif;
    ?>

    <!-- Provider Info Section Start -->
    <link rel="stylesheet" href="css/form-styling.css" type="text/css">

    <div class="container" style="width: 30%;">
        <form class="bg-white" style="display: flex; flex-direction: column; margin: 1rem auto;" action=" " method="post" autocomplete="off">
            <div class="form-item" style="margin: 0rem;">
                <header>
                    <h5> Στοιχεία Φορέα Υποδοχής Πρακτικής Άσκησης </h5>
                </header>

                <div class="form-group">
                    <label for="company-name">Επωνυμία</label>
                    <input type="text" class="form-control bg-white" id="company-name" name="company-name" disabled readonly value="<?= $user['company_name']; ?>">
                </div>

                <div class="form-group">
                    <label for="tax-id">ΑΦΜ</label>
                    <input type="text" class="form-control bg-white" id="tax-id" name="tax-id" disabled readonly value="<?= $user['tax_id']; ?>">
                </div>
            </div>
        </form>

        <form class="bg-white" style="display: flex; flex-direction: column; margin: 1rem auto;" action=" " method="post" autocomplete="off">
            <div class="form-item" style="margin: 0rem;">
                <header>
                    <h5> Στοιχεία Υπεύθυνου του Φορέα για το Σύστημα ΑΤΛΑΣ</h5>
                </header>

                <div class="form-group">
                    <label for="first-name">Όνομα</label>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control bg-white" id="first-name" name="first-name" disabled readonly value="<?= $user['first_name']; ?>">
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label for="last-name">Επίθετο</label>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control bg-white" id="last-name" name="last-name" disabled readonly value="<?= $user['last_name']; ?>">
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control bg-white" id="email" name="email" disabled readonly value="<?= $user['email']; ?>">
                        </div>

                    </div>
                </div>
                
            </div>
            <!-- <button type="submit" class="btn btn-primary" style="align-self: center;">Επεξεργασία Στοιχείων</button> -->
        </form>

        <div id="userInfoForm" class="bg-white" style="display: flex; flex-direction: column; margin: 1rem auto; min-width: 25%;">
            <div class="form-item" style="margin: 0rem;">
                <header>
                    <h5> Στοιχεία Λογαριασμού Χρήστη </h5>
                </header>

                <div class="form-group">
                    <div>
                        <label for="email" style="font-weight: bold;">Email</label>
                        <div style="display: flex;">
                            <input type="text" class="form-control bg-white" id="email" name="email" disabled readonly value="<?= $user['email']; ?>">
                            <form id="form-<?=$user['email'];?>" action="change-email.php" method="post" style="align-self: start;">
                                <input type="hidden" name="user_id" value="<?= $user['id'];?>">
                                <input type="hidden" name="new_email" id="email-<?=$user['email'];?>">
                                <button type="submit" class="btn btn-primary" style="margin: auto;">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                            </form>
                        </div>

                        <script type="text/javascript">
                            document.getElementById(`form-<?=$user['email']?>`).addEventListener("submit", function(event){
                                event.preventDefault();
                                if(sendRejectionMessage(`form-<?=$user['email'];?>`)){
                                    document.getElementById(`form-<?=$user['email']?>`).submit();
                                }
                                return false;
                            });

                            function sendRejectionMessage(application_id){
                                do{
                                    var answer = prompt('Πληκτρολογήστε το νέο email');
                                } while(answer !== null && answer === "")
                                
                                if(answer === null || answer === ''){
                                    return false;
                                }

                                if(confirm('To email του λογαριασμού σας πρόκειται να τροποποιηθεί.\nΕίστε σίγουρος/η γι\'αυτή την ενέργεια;')){
                                    document.getElementById(`email-<?=($user['email']);?>`).value = answer;
                                    return true;
                                }
                                return false;
                            }
                    </script>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary" onSubmit="prompt('test')">Αλλαγή Κωδικού Πρόσβασης</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Provider Info Section End -->

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