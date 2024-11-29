<?php
// Display errors for debugging (optional, disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Directory where files will be saved
    $uploadDir = __DIR__ . '/uploads/';

    // Create the directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Check if a file was uploaded
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Get the original filename
        $fileName = basename($_FILES['file']['name']);
        // Target path where the file will be saved
        $targetFile = $uploadDir . $fileName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
            echo "File uploaded successfully: " . htmlspecialchars($fileName);
        } else {
            echo "Error: Could not save the file.";
        }
    } else {
        echo "Error: No file uploaded or upload error.";
    }
} else {
    echo "Invalid request method. Please use POST.";
}
?>
