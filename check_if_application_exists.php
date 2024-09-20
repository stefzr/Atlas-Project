<?php
    function check_if_application_exists($student_id, $internship_posting_id){
        $sql = "SELECT * FROM application WHERE student_id = {$student_id} and internship_posting_id = {$internship_posting_id}";
        $mysqli = require __DIR__ . '/database.php';
        $result = $mysqli -> query($sql);
        if($result -> num_rows > 0){
            $application_info = $result -> fetch_assoc();
            $_SESSION['performance_report'] = $application_info['performance_report'];
            return true;
        }
        return false;
    }
?>