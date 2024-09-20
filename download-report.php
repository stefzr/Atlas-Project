<?php
    $fileName = basename($_REQUEST['file']);
    $filePath = "reports/" . $fileName;
    $splitFileName = explode('_', $fileName);
    $prefix = $splitFileName[0] . "_" . $splitFileName[1] . "_";

    $outputFileName = preg_replace('/' . $prefix . '/', '', $fileName, 1);
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Type: application/pdf");
    header("Content-Disposition: attachment; filename=$outputFileName");
    header("Content-Transfer-Encoding: binary");

    readfile($filePath);
    exit;
?>