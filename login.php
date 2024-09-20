<?php
    session_start();
    $is_invalid = false;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $mysqli = require __DIR__ . "/database.php";

        $sql = sprintf("SELECT * FROM user
                        WHERE email = '%s'",
                    $mysqli->real_escape_string($_POST["email"]));

        $result = $mysqli->query($sql);

        $user = $result->fetch_assoc();
        if ($user) {

            if ($_POST["password"] === $user["password"]){
                session_start();

                session_regenerate_id();

                $_SESSION["user_id"] = $user["id"];

                if($user['user_type'] === 'student'){
                    header("Location: search-internship.php");
                }else{
                    header("Location: publish-internship_posting.php");
                }
                exit;
            }else{
                unset($user);
            }
        }

        $is_invalid = true;
    }

?>
<!DOCTYPE html>
<html>
<!-- https://www.free-css.com/free-css-templates/page282/edukate -->

<head>
    <meta charset="utf-8">
    <title>ΑΤΛΑΣ - Σύνδεση</title>
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

    <script>
        document.getElementById('loginButton').remove(); // No point displaying the login button in the login page; thus remove it.
    </script>

    <!-- Breadcrumb Start -->
    <ul class="breadcrumb" style="margin: 0;">
        <li class="breadcrumb-item">
            <a href="index.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active">
            Σύνδεση Χρήστη
        </li>
    </ul>
    <!-- Breadcrumb End -->

    <?php
        if(isset($_SESSION['successful_registration']) && $_SESSION['successful_registration'] === true):
        ?>
            <script>
                swal("Επιτυχημένη Εγγραφή!", "Μπορείτε να συνδεθείτε με τα στοιχεία που δώσατε κατά την εγγραφή!", "success");
            </script>
        <?php 

        unset($_SESSION['successful_registration']);
        endif;
    ?>

    <!-- Login section Start -->
    <style>
        form > *{
            margin: 1em;
        }

        form{
            margin: auto;
            min-width: 25%;
            min-height: 100%;
            border: 1px solid rgb(161, 161, 161); border-radius: 8px;
            background-color: #f0f0f0;
        }

        form label{
            font-weight: bold;
        }
    </style>

    <script>
        function togglePasswordVisibility(){
            let passwordInput = document.getElementById('password');
            if(passwordInput.type === 'password'){
                passwordInput.type = 'text';
            }else{
                passwordInput.type = 'password';
            }
        }
    </script>


    <form style="display: flex; flex-direction: column;" method="post">
        <h4 style="text-align: center;">
            Είσοδος στο σύστημα ΑΤΛΑΣ
        </h4>

        <?php if ($is_invalid): ?>
            <em style="color: red;">Λανθασμένο email ή κωδικός πρόσβασης</em>
        <?php endif; ?>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" autofocus required>
            <script defer>
                document.getElementById('email').focus();
            </script>
        </div>

        <div class="form-group">
            <label for="password">Κωδικός Πρόσβασης</label>
            <input type="password" name="password" class="form-control" id="password" required>

            <input type="checkbox" id="passwordVisibility" onclick="togglePasswordVisibility()" style="margin: 1em 0;"> 
            <label for="passwordVisibility">Εμφάνιση Κωδικού</label>
        </div>
        <button type="submit" class="btn btn-primary" style="align-self: center;">Σύνδεση</button>
        <a href="#" style="text-underline-offset: 2px; width: fit-content;"> <u>Ξέχασα τον κωδικό μου</u> </a>
    </form>
    <a href="index.php" style="align-self:center;"><u>Επιστροφή στην αρχική</u></a>
    <!-- Login section End -->


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