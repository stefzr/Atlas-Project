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
    <title>ΑΤΛΑΣ - Ειδοποιήσεις</title>
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
            <a href="#">Προφίλ</a>
        </li>
        <li class="breadcrumb-item active">
            Ειδοποιήσεις
        </li>
    </ul>
    <!-- Breadcrumb End -->

    <!-- Nav-Tabs Start -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="prof_std_info.php">Στοιχεία Φοιτητή/τριας</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="prof_std_applic.php">Οι Αιτήσεις μου</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="">Ειδοποιήσεις</a>
        </li>
    </ul>
    <!-- Nav-Tabs End -->

    <?php
        $sql = "SELECT * FROM notification WHERE {$user['id']} = student_id and !read_by_user order by date_of_modification desc";
        $result = $mysqli -> query($sql);
        if($result -> num_rows == 0):?>
            <em style="margin: auto; font-size: 1.5rem">Δεν υπάρχουν ειδοποιήσεις.</em>
        <?php endif; ?>

    <!-- Main section start -->
    <div class="row" style="width: 100%">
        <div class="col-6" style="margin: 1rem auto;">
            <?php
            while($notification_info = $result -> fetch_assoc()):
                $sql = "SELECT * FROM application WHERE {$notification_info['application_id']} = id";
                $application_result = $mysqli -> query($sql);
                $application_info = $application_result -> fetch_assoc();

                $sql = "SELECT * FROM internship_posting WHERE {$application_info['internship_posting_id']} = id";
                $internship_posting_result = $mysqli -> query($sql);
                $internship_posting_info = $internship_posting_result-> fetch_assoc();
                $internship_title = $internship_posting_info['title'];
                
                $sql = "SELECT * FROM user WHERE {$internship_posting_info['internship_provider_id']} = id";
                $internship_provider_result = $mysqli -> query($sql);
                $internship_provider_info = $internship_provider_result-> fetch_assoc();
                if($application_info['status'] == 'rejected'):?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Απορριφθείσα Αίτηση</strong> <br>
                        Η <a href="apply-for-internship.php?internship_posting_id=<?=$application_info['internship_posting_id'];?>" class="alert-link">αίτησή</a>
                        σας για τη θέση <a href="view-internship-posting.php?internship_posting_id=<?=$application_info['internship_posting_id'];?>" class="alert-link"> <?= $internship_posting_info['title'];?> </a> απορρίφθηκε. <br>
                        Μήνυμα Απόρριψης: <?= $application_info['rejection_message'];?>
                    </div>
                <?php else:?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Εγκεκριμένη Αίτηση</strong> <br>Η <a href="apply-for-internship.php?internship_posting_id=<?=$application_info['internship_posting_id'];?>" class="alert-link">αίτησή</a> σας έγινε δεκτή από τον Φορέα Υποδοχής <i><?=$internship_provider_info['company_name'];?></i> !
                        <strong>Email επικοινωνίας:</strong>  <em><?=$internship_provider_info['email'];?></em>
                    </div>
                <?php endif;
                $sql = "UPDATE notification SET read_by_user = 1 where id = {$notification_info['id']}";
                $mysqli->query($sql);?>

                <script>
                    document.getElementById('notification-icon').style.color = '#2878EB';
                </script>
            <?php endwhile; ?>
        </div>
        
    </div>
    <!-- Main section end -->

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