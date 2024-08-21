<?php
include "../Config/Config.php";
if (isset($_POST['Statistics'])) {
    // $requiredFields = [
    //     'format', 'matches', 'battinginnings','bowlinginnings', 'runs',
    //     'highestScore', 'halfCenturies', 'centuries', 'strikeRate',
    //     'average', 'economy','bestbowling','wickets','PlayerID',
    // ];

    // $missingFields = [];
    // foreach ($requiredFields as $field) {
    //     if (!isset($_POST[$field]) || empty($_POST[$field])) {
    //         $missingFields[] = $field;
    //     }
    // }
    // if (!empty($missingFields)) {
    //     echo "DataMissing";
    //     exit;
    // }

    $format = $_POST['format'];
    $PlayerID = $_POST['PlayerID'];
    $matches = $_POST['matches'];
    $battinginnings = $_POST['battinginnings'];
    $bowlinginnings = $_POST['bowlinginnings'];
    $runs = $_POST['runs'];
    $strikeRate = $_POST['strikeRate'];
    $highestScore = $_POST['highestScore'];
    $halfCenturies = $_POST['halfCenturies'];
    $centuries = $_POST['centuries'];
    $average = $_POST['average'];
    $economy = $_POST['economy'];
    $bestbowling=$_POST['bestbowling'];
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

    $sql = "INSERT INTO $Table (`Player ID`, `Total Matches`, `Batting Innings`,`Bowlings Innings`, `Run Scored`, `Highest Score`, `Half Centuries`, `Centuries`, `Strike Rate`, `Batting Average`, `Bowling Economy`,`Best Bowlings`, `Wickets Taken`,`Date`) VALUES ('$PlayerID','$matches','$battinginnings','$bowlinginnings','$runs','$highestScore','$halfCenturies', '$centuries', '$strikeRate', '$average', '$economy','$bestbowling', '$wickets',CONVERT_TZ(NOW(), '+00:00', '+05:45'))";

    if ($conn->query($sql) === TRUE) {
        echo "Success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
