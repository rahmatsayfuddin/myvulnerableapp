<?php
// Check if a file was uploaded
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
    // Define the target directory
    $targetDir = "assets/";

    // Ensure the uploads directory exists
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Get the uploaded file information
    $fileName = basename($_FILES['file']['name']);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Set allowed file types
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'txt');

    // Validate file type
    if (in_array($fileType, $allowedTypes)) {
        // Move the file to the target directory
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
            echo "The file " . htmlspecialchars($fileName) . " has been uploaded successfully.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG, GIF, PDF, and TXT files are allowed.";
    }
} else {
    echo "No file was uploaded or there was an error uploading the file.";
}
?>
