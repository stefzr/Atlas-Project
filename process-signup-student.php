<?php
    $mysqli = require __DIR__ . '/database.php';

    $sql = "INSERT INTO user(student_id, university_name, university_department, first_name, last_name, user_type, email, password) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli -> stmt_init();
    $stmt->prepare($sql);

    $str = 'student';
    $stmt->bind_param("ssssssss", $_POST['student_id'], $_POST['university'], $_POST['university_department'], $_POST['firstName'], $_POST['lastName'], $str, $_POST['email'], $_POST['password']);

    $stmt->execute();

    session_start();
    $_SESSION['successful_registration'] = true;
    header('Location: login.php');
?>