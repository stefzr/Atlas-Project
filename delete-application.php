<?php
    $mysqli = require __DIR__ . '/database.php';

    $sql = "DELETE FROM application WHERE id = {$_REQUEST['application_id']}";
    $mysqli->query($sql);
    session_start();
    $_SESSION['successful_deletion'] = true;
    header("Location: prof_std_applic.php");