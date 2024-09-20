<?php
    $mysqli = require __DIR__ . '/database.php';
    include 'check_if_application_exists.php';

    date_default_timezone_set('Europe/Athens');
    $dt = date('Y-m-d H:i:s', time());

    session_start();

    if(isset($_POST['temporarily_saved_button'])){
        $status = 'temporarily_saved';
        $internship_posting_id = $_POST['temporarily_saved_button'];
    }else{
        $status = 'pending';
        $internship_posting_id = $_POST['submit_button'];
    }

    if(!is_dir('./reports/')){
        mkdir('./reports/', 0777, true);
    }

    $filename = implode('_', array($_SESSION['user_id'], $internship_posting_id, $_FILES['report']['name']));
    $destination = __DIR__ . "/reports/" . $filename;
    move_uploaded_file($_FILES['report']['tmp_name'], $destination);

    $student_id = $_SESSION['user_id'];
    if(!check_if_application_exists($student_id, $internship_posting_id)){
        $sql = "INSERT INTO application(student_id, performance_report, status, interest_description, internship_posting_id, date_of_modification) VALUES(?, ?, ?, ?, ?, ?)";

        $stmt = $mysqli -> stmt_init();
        $stmt->prepare($sql);

        $stmt->bind_param("dsssds", $student_id, $filename, $status, $_POST['interest-description'], $internship_posting_id, $dt);
    }else{
        if($_SESSION['performance_report'] !== $filename):
            unlink(__DIR__ . "/reports/" . $_SESSION['performance_report']);
            unset($_SESSION['performance_report']);
        endif;

        $sql = "UPDATE application SET date_of_modification='$dt', performance_report = '$filename', status = '$status', interest_description = '{$_POST['interest-description']}'
                WHERE student_id = {$student_id} and internship_posting_id = {$internship_posting_id}";
        $stmt = $mysqli -> stmt_init();
        $stmt->prepare($sql);
    }
    if($status == 'pending'){
        $_SESSION['successful_submission'] = true;
    }else{
        $_SESSION['successful_temporary_submission'] = true;
    }
    $stmt->execute();
    header('Location: prof_std_applic.php');
?>