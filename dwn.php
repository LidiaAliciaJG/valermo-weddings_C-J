<?php
if (!isset( $_GET[ 'fn' ] )){
    http_response_code(404);
} else {
    $file = $_GET['fn'] ;
    header('Content-Description: File Transfer');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=".basename($file));
    header("Content-Transfer-Encoding: binary");
    header("Expires: 0");
    header("Pragma: public");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    ob_clean();
    flush();
    readfile($file);
    unlink($file);
    die();
}