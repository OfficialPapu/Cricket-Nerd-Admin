<?php
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
include $base_url . 'Assets/PHP/API/Config/Config.php';

if (isset($_POST['Statistics'])) {
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
    $bestbowling = $_POST['bestbowling'];
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
        default:
            echo "Invalid format";
            exit;
    }

    // Check if the player exists
    $checkSql = "SELECT * FROM $Table WHERE `Player ID` = '$PlayerID'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        // Player exists, update the record
        $sql = "UPDATE $Table SET 
            `Total Matches` = '$matches',
            `Batting Innings` = '$battinginnings',
            `Bowlings Innings` = '$bowlinginnings',
            `Run Scored` = '$runs',
            `Highest Score` = '$highestScore',
            `Half Centuries` = '$halfCenturies',
            `Centuries` = '$centuries',
            `Strike Rate` = '$strikeRate',
            `Batting Average` = '$average',
            `Bowling Economy` = '$economy',
            `Best Bowlings` = '$bestbowling',
            `Wickets Taken` = '$wickets'
            WHERE `Player ID` = '$PlayerID'";
    } else {
        // Player doesn't exist, insert a new record
        $sql = "INSERT INTO $Table (`Player ID`, `Total Matches`, `Batting Innings`, `Bowlings Innings`, `Run Scored`, `Highest Score`, `Half Centuries`, `Centuries`, `Strike Rate`, `Batting Average`, `Bowling Economy`, `Best Bowlings`, `Wickets Taken`) 
        VALUES ('$PlayerID', '$matches', '$battinginnings', '$bowlinginnings', '$runs', '$highestScore', '$halfCenturies', '$centuries', '$strikeRate', '$average', '$economy', '$bestbowling', '$wickets')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>