<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../Config/Config.php";

$VideoTitle = $_POST['VideoTitle'] ?? '';
$Description = $_POST['Description'] ?? '';
$Link = $_POST['Link'] ?? '';

if (isset($_FILES['Image']) && $_FILES['Image']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['Image']['tmp_name'];
    $fileName = basename($_FILES['Image']['name']);

    $base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
    $uploadBaseDir = $base_url . "Media/Images/";

    $year = date('Y');
    $month = date('m');
    $uploadDir = $uploadBaseDir . $year . '/' . $month . '/';

    if (!file_exists($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
            die('Failed to create folders...');
        }
    }

    $uploadPath = $uploadDir . $fileName;
    $DbUploadPath = $year . '/' . $month . '/' . $fileName;

    if (move_uploaded_file($fileTmpPath, $uploadPath)) {
        // Use prepared statements to prevent SQL injection and handle special characters
        $stmt = $conn->prepare("INSERT INTO `videos`(`Title`, `Description`, `Link`, `Thumbnail`, `Post Date`) VALUES (?, ?, ?, ?, CONVERT_TZ(NOW(), '+00:00', '+05:45'))");
        $stmt->bind_param("ssss", $VideoTitle, $Description, $Link, $DbUploadPath);

        if ($stmt->execute()) {
            echo "Success";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "File upload failed.";
    }
} else {
    echo "No file uploaded or file upload error.";
}

$conn->close();
?>
