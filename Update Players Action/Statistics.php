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

    // Constructing the SQL UPDATE statement
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

    if ($conn->query($sql) === TRUE) {
        echo "Success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
