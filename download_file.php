<?php

if(isset($_REQUEST["files_mhs"])){
    // Get parameters
    $file = urldecode($_REQUEST["files_mhs"]); // Decode URL-encoded string
    $filepath = "FolderContainer/files/mahasiswa/" . $file;
    // Process download
    if(file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        exit;
    }
}

if(isset($_REQUEST["files_dsn"])){
    // Get parameters
    $file = urldecode($_REQUEST["files_dsn"]); // Decode URL-encoded string
    $filepath = "files/dosen/" . $file;
    // Process download
    if(file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        exit;
    }
}

if(isset($_REQUEST["foto_mhs"])){
    // Get parameters
    $file = urldecode($_REQUEST["foto_mhs"]); // Decode URL-encoded string
    $filepath = "foto_mhs/" . $file;
    // Process download
    if(file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        exit;
    }
}
?>