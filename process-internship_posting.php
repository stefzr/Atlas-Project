<?php
    $mysqli = require __DIR__ . '/database.php';

    date_default_timezone_set('Europe/Athens');
    $dt = date('Y-m-d H:i:s', time());

    session_start();
    $internship_provider_id = $_SESSION['user_id'];

    if(isset($_POST['temporarily_saved_button'])){
        $status = 'temporarily_saved';
        $internship_posting_id = $_POST['temporarily_saved_button'];
    }else{
        $status = 'submitted';
        $internship_posting_id = $_POST['submit_button'];
    }

    $str = explode('-', $_POST['university']);
    $university = $str[0];
    $university_department = $str[1];

    if($internship_posting_id == ''){
        $sql = "INSERT INTO internship_posting(title, duration, wage, employment_type, location, start_date_of_internship, status, internship_provider_id, description, date_of_modification) 
        VALUES('{$_POST['internship-title']}', '{$_POST['internship-duration']}', {$_POST['wage']}, '{$_POST['internship-type']}', '{$_POST['location']}',
        '{$_POST['internship_date']}', '{$status}', '{$internship_provider_id}', '{$_POST['internship-description']}', '$dt')";
        $mysqli->query($sql);

        $sql = "INSERT INTO internship_posting_has_university_departments(internship_posting_id, university_name, university_department)
                VALUES($mysqli->insert_id, '$university', '$university_department')";
        $mysqli->query($sql);
    }else{
        $sql = "UPDATE internship_posting SET title = '{$_POST['internship-title']}', duration = '{$_POST['internship-duration']}', wage = '{$_POST['wage']}',
                employment_type = '{$_POST['internship-type']}', location = '{$_POST['location']}', start_date_of_internship = '{$_POST['internship_date']}',
                status = '{$status}', description = '{$_POST['internship-description']}', date_of_modification = '$dt' WHERE id = {$internship_posting_id}";
        $mysqli->query($sql);

        $sql = "UPDATE internship_posting_has_university_departments SET university_department = '{$university_department}', university_name = '{$university}'
                WHERE internship_posting_id = {$internship_posting_id}";
        $mysqli->query($sql);
    }

    if($status == 'temporarily_saved'):
        $_SESSION['successful_temporary_submission'] = true;
    else:
        $_SESSION['successful_submission'] = true;
    endif;

    header('Location: prof_prov_post.php');
?>