<!-- Navbar Start -->
<style> /* hover functionality */
        .navbar .nav-item .dropdown-menu{ display: none; }
        .navbar .nav-item:hover .dropdown-menu{ display: block; }
        .navbar .nav-item .dropdown-menu{ margin-top:0; }
</style>

<head>
    <!-- Font Awesome -->
    <link href="https://raw.githubusercontent.com/tallesairan/FA5PRO/master/css/all.min.css" rel="stylesheet">
</head>

<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
        <a href="index.php" class="navbar-brand ml-lg-3">
            <img src="img/atlas_logo.png" width="125" height="125" class="img-fluid" alt="Responsive image" style="border: 1px solid rgb(134, 134, 134);">
        </a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0 align-items-center">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle mr-5" style="padding: 0;" data-toggle="dropdown">ΦΟΙΤΗΤΕΣ</a>
                    <div class="dropdown-menu m-0">
                        <a href="information_students.php" class="dropdown-item">Πληροφόρηση</a>
                        <a href="search-internship.php" class="dropdown-item">Αναζήτηση Θέσεων Πρακτικής</a>
                        <a href="prof_std_applic.php" class="dropdown-item">Οι Αιτήσεις μου</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle mr-5" style="padding: 0;" data-toggle="dropdown">ΦΟΡΕΙΣ</a>
                    <div class="dropdown-menu m-0">
                        <a href="information_providers.php" class="dropdown-item">Πληροφόρηση</a>
                        <a href="publish-internship_posting.php" class="dropdown-item">Δημιουργία Νέας Αγγελίας</a>
                        <a href="prof_prov_post.php" class="dropdown-item">Οι Αγγελίες μου</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" style="padding: 0;" data-toggle="dropdown">ΒΟΗΘΕΙΑ</a>
                    <div class="dropdown-menu m-0">
                        <a href="FAQ.php" class="dropdown-item">Συχνές Ερωτήσεις</a>
                        <a href="contact.php" class="dropdown-item">Επικοινωνία</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
            if (isset($user)): ?>

            <?php if($user['user_type'] === 'student'): ?>
                <a href="prof_std_info.php">
                    <i class="fa fa-user fa-2x px-4" title="Στοιχεία Φοιτητή/τριας"></i>
                </a>

                <a href="prof_std_applic.php" style="margin: 0 1rem;">
                    <i class="fa fa-file-alt fa-2x px-4" title="Οι Αιτήσεις μου"></i>
                </a>

                <a href="prof_std_notif.php" style="margin: 0 1rem; padding-right: 1.5rem; padding-left: 1rem;">
                <i id="notification-icon" class="fa fa-bell fa-2x" title="Ειδοποιήσεις"></i>
                </a>
                <?php
                    $sql = "SELECT * FROM notification WHERE {$user['id']} = student_id and !read_by_user order by date_of_modification desc";
                    $result = $mysqli -> query($sql);
                    if($result -> num_rows > 0):?>
                    <script type="text/javascript">
                        document.getElementById('notification-icon').style.color = 'red';
                    </script>
                    <?php endif; 
                else: ?>
                <a href="prof_prov_info.php">
                    <i class="fa fa-user fa-2x px-4" title="Στοιχεία Φορέα Υποδοχής"></i>
                </a>

                <a href="prof_prov_post.php" style="margin: 0 1rem;">
                    <i class="fa fa-file-alt fa-2x px-4" title="Οι Αγγελίες μου"></i>
                </a>
            <?php endif; ?>
            <a href="logout.php">
                <i class="fa fa-sign-out-alt fa-2x px-4" title="Αποσύνδεση"></i>
            </a>
        <?php else: ?>
            <a href="login.php" class="btn btn-primary py-3 px-5 mr-3 d-none d-lg-block" id="loginButton">Σύνδεση</a>
            <div class="nav-item dropdown">
                <button href="#" class="btn btn-secondary py-3 px-5 dropdown-toggle" style="padding: 0;" data-toggle="dropdown">Εγγραφή</button>

                <div class="dropdown-menu m-0">
                    <a href="signup-student.php" class="dropdown-item">ως Φοιτητής/τρια</a>
                    <a href="signup-internship-provider.php" class="dropdown-item">ως Φορέας Υποδοχής</a>
                </div>
            </div>
        <?php endif; ?>
    </nav>
</div>
<!-- Navbar End -->