<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = __DIR__ . '/uploads/'; // Current directory or specify a folder
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // Create directory if it doesn't exist
    }

    foreach ($_FILES['files']['tmp_name'] as $key => $tmpName) {
        $fileName = basename($_FILES['files']['name'][$key]);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($tmpName, $targetFile)) {
            echo "Uploaded: " . htmlspecialchars($fileName) . "<br>";
        } else {
            echo "Failed to upload: " . htmlspecialchars($fileName) . "<br>";
        }
    }
} else {
    echo "No files uploaded.";
}
?>
