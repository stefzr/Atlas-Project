<?php
    $mysqli = require __DIR__ . "/database.php";

    $rejection_msg = 'Η θέση έχει καλυφθεί.';

    date_default_timezone_set('Europe/Athens');
    $dt = date('Y-m-d H:i:s', time());

    $sql = "UPDATE application SET date_of_modification='{$dt}', status = 'rejected', rejection_message='{$rejection_msg}' 
            WHERE status != 'approved' and {$_REQUEST['application_id']} != id and {$_REQUEST['internship_posting_id']} = internship_posting_id";
    $mysqli->query($sql);

    $sql = "UPDATE application SET date_of_modification='{$dt}', status = 'approved' WHERE {$_REQUEST['application_id']} = id";
    $mysqli->query($sql);

    $sql = "UPDATE internship_posting SET date_of_modification='{$dt}', status = 'completed' WHERE id = {$_REQUEST['internship_posting_id']}";
    $mysqli->query($sql);

    $sql = "SELECT * FROM internship_posting WHERE id = {$_REQUEST['internship_posting_id']}";
    $result = $mysqli->query($sql);
    $internship_info = $result->fetch_assoc();

    $sql = "SELECT * FROM application WHERE id = {$_REQUEST['application_id']}";
    $result = $mysqli->query($sql);
    $application_info = $result->fetch_assoc();

    $num = 0;
    $sql = "INSERT INTO notification(student_id, date_of_modification, application_id, read_by_user) VALUES(?, ?, ?, ?)";

    $stmt = $mysqli -> stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param("dsdd", $application_info['student_id'], $dt, $_REQUEST['application_id'], $num);
    $stmt->execute();

    session_start();
    $_SESSION['successful_approval'] = true;
    header("Location: prof_prov_applic.php?internship_posting_id={$_REQUEST['internship_posting_id']}&internship_title={$internship_info['title']}");
?>