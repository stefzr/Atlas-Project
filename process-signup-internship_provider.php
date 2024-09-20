<?php
    $mysqli = require __DIR__ . '/database.php';

    $sql = "INSERT INTO user(tax_id, company_name, first_name, last_name, user_type, email, password) VALUES(?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli -> stmt_init();
    $stmt->prepare($sql);

    $str = 'internship_provider';
    $stmt->bind_param("sssssss", $_POST['taxID'], $_POST['companyName'], $_POST['firstName'], $_POST['lastName'], $str, $_POST['email'], $_POST['password']);

    $stmt->execute();

    session_start();
    $_SESSION['successful_registration'] = true;
    header('Location: login.php');
?>