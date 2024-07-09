<?php
include "../Config/Config.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $PlayerName = $_POST['PlayerName'] ?? '';
    $PlayerRole = $_POST['PlayerRole'] ?? '';
    $PlayerType = $_POST['PlayerType'] ?? '';
    $BattingStyle = $_POST['BattingStyle'] ?? '';
    $BowlingStyle = $_POST['BowlingStyle'] ?? '';
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
        $uploadBaseDir = ''; // Adjust this path as necessary
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
            $InsertPlayerQuery = "INSERT INTO `players`(`Player Name`,`Player Role`, `Player Type`, `Bowling Style`, `Batting Style`, `Player Photo`, `Date`) VALUES ('$PlayerName','$PlayerRole', '$PlayerType', '$BowlingStyle', '$BattingStyle', '$DbUploadPath', NOW())";
            $InsertPlayerQueryRun = mysqli_query($conn, $InsertPlayerQuery);
            if ($InsertPlayerQueryRun) {
                echo "Success";
            } else {
                echo "Error";
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        $InsertPlayerQuery = "INSERT INTO `players`(`ID`, `Player Role`, `Player Type`, `Bowling Style`, `Batting Style`, `Date`) VALUES (NULL, '$PlayerRole', '$PlayerType', '$BowlingStyle', '$BattingStyle', NOW())";
        $InsertPlayerQueryRun = mysqli_query($conn, $InsertPlayerQuery);
        if ($InsertPlayerQueryRun) {
            echo "Success";
        } else {
            echo "Error";
        }
    }
}
