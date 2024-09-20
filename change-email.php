<?php
    $mysqli = require __DIR__ . '/database.php';
    $new_email = $_POST['new_email'];
    $user_id = $_POST['user_id'];
    $sql = "UPDATE user SET email='$new_email' WHERE id = $user_id";

    $stmt = $mysqli -> stmt_init();
    $stmt->prepare($sql);
    $stmt->execute();

    session_start();
    $_SESSION['successful_email_change'] = true;

    $result = $mysqli -> query("SELECT * FROM user WHERE id = $user_id");
    $user = $result -> fetch_assoc();
    if($user['user_type'] == 'student'){
        header('Location: prof_std_info.php');
    }else{
        header('Location: prof_prov_info.php');
    }
?>