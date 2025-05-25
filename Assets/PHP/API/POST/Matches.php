<?php
include "../Config/Config.php";

$TournamentName = addslashes($_POST['TournamentName'] ?? '');
$CountryA = $_POST['CountryA'] ?? '';
$CountryB = $_POST['CountryB'] ?? '';
$Schedule = $_POST['Schedule'] ?? '';
$Time = $_POST['Time'] ?? '';

$Match = addslashes($_POST['Match'] ?? '');
$Venue = addslashes($_POST['Venue'] ?? '');
$Toss = addslashes($_POST['Toss'] ?? '');
$Umpires = addslashes($_POST['Umpires'] ?? '');
$MatchReferee = addslashes($_POST['MatchReferee'] ?? '');
$Status = addslashes($_POST['Status'] ?? '');
$Category = $_POST['Category'] ?? '';
$CustomNameA = $_POST['CustomNameA'] ?? '';
$CustomNameB = $_POST['CustomNameB'] ?? '';
$categorySlug = CreateSlug($Category);

if($CountryA=="Select a Flag" || $CountryB=="Select a Flag"){
    $CountryA=$CountryB=NULL;
}

// File Upload Directory Setup
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
$uploadBaseDir = $base_url . "Media/Images/";
$year = date('Y');
$month = date('m');
$uploadDir = $uploadBaseDir . "$year/$month/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Allowed file types & max size
$allowedTypes = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
$maxFileSize = 20 * 1024 * 1024; // 20MB

// Function to handle file upload
function handleFileUpload($file, $uploadDir, $year, $month, $allowedTypes, $maxFileSize) {
    if (!isset($file) || $file['error'] == UPLOAD_ERR_NO_FILE) {
        return NULL; // Return NULL if no file is uploaded
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return NULL; // Return NULL if any upload error occurs
    }
    if ($file['size'] > $maxFileSize) {
        return NULL; // Return NULL if file size exceeds the limit
    }
    if (!in_array($file['type'], $allowedTypes)) {
        return NULL; // Return NULL if the file type is not allowed
    }

    $uniqueName = uniqid() . "_" . basename($file['name']);
    $targetFilePath = $uploadDir . $uniqueName;

    if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        return "$year/$month/$uniqueName"; // Only store "year/m/filename" in DB
    }
    return NULL;
}

// Handle File Uploads
$teamAFlag = handleFileUpload($_FILES['TeamA_Flag'], $uploadDir, $year, $month, $allowedTypes, $maxFileSize);
$teamBFlag = handleFileUpload($_FILES['TeamB_Flag'], $uploadDir, $year, $month, $allowedTypes, $maxFileSize);

// Insert into Database
$sql = $conn->prepare("INSERT INTO `matches` (`Tournament Name`, `Country A`, `Country B`, `Custom Name A`, `Custom Name B`, `Custom Flag A`, `Custom Flag B`, `Category`, `Category Slug`, `Schedule`, `Match`, `Status`, `Venue`, `Toss`, `Umpires`, `Match Referee`, `Time`, `Post Date`) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CONVERT_TZ(NOW(), '+00:00', '+05:45'))");

$sql->bind_param("sssssssssssssssss", $TournamentName, $CountryA, $CountryB, $CustomNameA, $CustomNameB, $teamAFlag, $teamBFlag, $Category, $categorySlug, $Schedule, $Match, $Status, $Venue, $Toss, $Umpires, $MatchReferee, $Time);

if ($sql->execute()) {
    echo "Success";
} else {
    echo "Error: " . $conn->error;
}

$sql->close();
$conn->close();
?>
