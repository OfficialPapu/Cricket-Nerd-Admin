<?php
include "../Config/Config.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
$PlayerName = addslashes($_POST['PlayerName'] ?? '');
$SlugUrl = CreateSlug($PlayerName);
$PlayerRole = addslashes($_POST['PlayerRole'] ?? '');
$PlayerType = addslashes($_POST['PlayerType'] ?? '');
$BattingStyle = addslashes($_POST['BattingStyle'] ?? '');
$BowlingStyle = addslashes($_POST['BowlingStyle'] ?? '');

    $requiredFields = [
        'PlayerName', 'PlayerRole', 'PlayerType', 'BattingStyle', 'BowlingStyle'
    ];

    $missingFields = [];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $missingFields[] = $field;
        }
    }
    if (!empty($missingFields)) {
        echo "DataMissing";
        exit;
    }
    if (isset($_FILES['Image']) && $_FILES['Image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['Image']['tmp_name'];
        $fileName = $_FILES['Image']['name'];
        $base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
        $uploadBaseDir = $base_url . "Media/Images/";
        $year = date('Y');
        $month = date('m');
        $uploadDir = $uploadBaseDir . $year . '/' . $month . '/';

        if (!file_exists($uploadDir)) {
            mkdir($uploadBaseDir . $year, 0777, true);
            mkdir($uploadBaseDir . $year . '/' . $month, 0777, true);
        }

        $uploadPath = $uploadDir . $fileName;
        $DbUploadPath = $year . '/' . $month . '/' . $fileName;
        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            $InsertPlayerQuery = "INSERT INTO `players`(`Player Name`,`Slug Url`,`Player Role`, `Player Type`, `Bowling Style`, `Batting Style`, `Player Photo`, `Date`) VALUES ('$PlayerName','$SlugUrl','$PlayerRole', '$PlayerType', '$BowlingStyle', '$BattingStyle', '$DbUploadPath', CONVERT_TZ(NOW(), '+00:00', '+05:45'))";
            $InsertPlayerQueryRun = mysqli_query($conn, $InsertPlayerQuery);
            if ($InsertPlayerQueryRun) {
                echo "Success";
            } else {
                echo "Error";
            }
        } else {
            echo "Error uploading file.";
        }
    }
}
