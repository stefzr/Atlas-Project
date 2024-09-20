<?php
    $mysqli = require __DIR__ . '/database.php';

    $sql = "DELETE FROM internship_posting WHERE id = {$_REQUEST['internship_posting_id']}";
    $mysqli->query($sql);

    session_start();
    $_SESSION['successful_deletion'] = true;
    header("Location: prof_prov_post.php");