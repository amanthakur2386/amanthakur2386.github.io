<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    foreach ($_FILES['files']['error'] as $key => $error) {
        if ($error === UPLOAD_ERR_OK) {
            $tmpName = $_FILES['files']['tmp_name'][$key];
            $fileName = basename($_FILES['files']['name'][$key]);
            $targetFile = $uploadDir . $fileName;

            if (move_uploaded_file($tmpName, $targetFile)) {
                echo "Uploaded: " . htmlspecialchars($fileName) . "<br>";
            } else {
                echo "Failed to upload: " . htmlspecialchars($fileName) . "<br>";
            }
        } else {
            echo "Error uploading file: " . htmlspecialchars($_FILES['files']['name'][$key]) . " (Error Code: $error)<br>";
        }
    }
} else {
    echo "No files uploaded.";
}
?>
