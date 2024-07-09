<?php
include "../Config/Config.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Statistics'])) {
    $requiredFields = [
        'format', 'matches', 'innings', 'runs',
        'highestScore', 'halfCenturies', 'centuries', 'strikeRate',
        'average', 'economy', 'wickets'
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
    $format = $_POST['format'];
    $PlayerID = $_POST['PlayerID'];
    $matches = $_POST['matches'];
    $innings = $_POST['innings'];
    $runs = $_POST['runs'];
    $strikeRate = $_POST['strikeRate'];
    $highestScore = $_POST['highestScore'];
    $halfCenturies = $_POST['halfCenturies'];
    $centuries = $_POST['centuries'];
    $average = $_POST['average'];
    $economy = $_POST['economy'];
    $wickets = $_POST['wickets'];

    switch ($format) {
        case 't20i':
            $Table = 't20i_statistics';
            break;
        case 'odi':
            $Table = 'odi_statistics';
            break;
        case 'domestic':
            $Table = 'domestic_statistics';
            break;
    }

    $sql = "INSERT INTO $Table (`Player ID`, `Total Matches`, `Total Innings`, `Run Scored`, `Highest Score`, `Half Centuries`, `Centuries`, `Strike Rate`, `Batting Average`, `Bowling Economy`, `Wickets Taken`,`Date`) VALUES ('$PlayerID','$matches','$innings','$runs','$highestScore','$halfCenturies', '$centuries', '$strikeRate', '$average', '$economy', '$wickets',NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
