<?php
// read-pdf.php
session_start();

// Validate and sanitize file parameter
$file = isset($_GET['file']) ? basename($_GET['file']) : '';

if (empty($file)) {
    die('No file specified');
}

// Set the correct path to your PDF files
$filepath = '../uploads/ebook/' . $file;

// Validate file exists and is PDF
if (!file_exists($filepath) || !is_file($filepath)) {
    die('File not found');
}

// Get file mime type
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime_type = finfo_file($finfo, $filepath);
finfo_close($finfo);

if ($mime_type !== 'application/pdf') {
    die('Invalid file type');
}

// Set headers and output file
header('Content-Type: application/pdf');
header('Content-Length: ' . filesize($filepath));
header('Content-Disposition: inline; filename="' . $file . '"');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

readfile($filepath);
exit;