
<?php
session_start();
ob_start();
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/Admin/";
include $base_url . 'Assets/PHP/API/Config/Config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['AddSqads'])) {

        $matchID = $_POST['match'];
        $country = $_POST['country'];
        $playerName = $_POST['PlayerName'];
        $role = $_POST['role'];

        if (!empty($matchID) && !empty($country) && !empty($playerName) && !empty($role)) {
            $stmt = $conn->prepare("INSERT INTO squads (`Match ID`, `Team`, `Player Name`, `Type`) VALUES (?, ?, ?, ?)");

            $stmt->bind_param("ssss", $matchID, $country, $playerName, $role);

            if ($stmt->execute()) {
                echo "Squad added successfully!";
            } else {
                echo "Error: Unable to add squad. Please try again.";
            }

            $stmt->close();
        } else {
            echo "Error: Please fill all the fields";
        }
    }
    if (isset($_POST['AddExtra'])) {
        $matchID = $_POST['match'];
        $country = $_POST['country'];
        $inning = $_POST['Inning'];
        $byes = $_POST['Byes'];
        $legByes = $_POST['LegByes'];
        $wides = $_POST['Wides'];
        $noBalls = $_POST['NoBalls'];
        $penaltyRuns = $_POST['PenaltyRuns'];
        $totalExtras = $_POST['TotalExtras'];
        $checkQuery = $conn->query("SELECT * FROM `scorecard_extras` WHERE `Match ID` = '$matchID' AND `Country` = '$country'");

        if ($checkQuery && $checkQuery->num_rows > 0) {
            $sql = $conn->query("UPDATE `scorecard_extras` 
        SET 
            `Inning` = '$inning',
            `Byes` = '$byes',
            `Leg Byes` = '$legByes',
            `Wides` = '$wides',
            `No Balls` = '$noBalls',
            `Penalty Runs` = '$penaltyRuns',
            `Total Extras` = '$totalExtras'
        WHERE `Match ID` = '$matchID' AND `Country` = '$country'");
        } else {
            $sql = $conn->query("INSERT INTO `scorecard_extras`(`Match ID`, `Country`, `Inning`, `Byes`, `Leg Byes`, `Wides`, `No Balls`, `Penalty Runs`, `Total Extras`) 
        VALUES ('$matchID', '$country', '$inning', '$byes', '$legByes', '$wides', '$noBalls', '$penaltyRuns', '$totalExtras')");
        }
        if ($sql) {
            echo "Success";
        } else {
            echo "Error";
        }
    }
    if (isset($_POST['AddBatting'])) {

        $SquadID = $_POST['SquadID'];
        $runs = $_POST['BattingRuns'];
        $balls = $_POST['BattingBalls'];
        $fours = $_POST['BattingFours'];
        $sixes = $_POST['BattingSixes'];
        $strikeRate = $_POST['BattingSR'];
        $status = $_POST['BattingStatus'];

        $checkQuery = $conn->query("SELECT * FROM `scorecard_batting` WHERE `Squad ID` = '$SquadID'");

        if ($checkQuery && $checkQuery->num_rows > 0) {
            $sql = $conn->query("UPDATE `scorecard_batting` 
        SET 
            `Runs` = '$runs',
            `Balls` = '$balls',
            `Fours` = '$fours',
            `Sixes` = '$sixes',
            `Strike Rate` = '$strikeRate',
            `Status` = '$status'
        WHERE `Squad ID` = '$SquadID'");
        } else {
            $sql = $conn->query("INSERT INTO `scorecard_batting` 
                (`Squad ID`, `Runs`, `Balls`, `Fours`, `Sixes`, `Strike Rate`, `Status`) 
                VALUES ('$SquadID', '$runs', '$balls', '$fours', '$sixes', '$strikeRate', '$status')");
        }
        if ($sql) {
            echo "Success";
        } else {
            echo "Error";
        }
    }
    if (isset($_POST['AddBowling'])) {

        $SquadID = $_POST['SquadID'];
        $overs = $_POST['BowlingOvers'];
        $maidens = $_POST['BowlingMaidens'];
        $runs = $_POST['BowlingRuns'];
        $wickets = $_POST['BowlingWickets'];
        $economy = $_POST['BowlingEconomy'];

        $checkQuery = $conn->query("SELECT * FROM `scorecard_bowling` WHERE `Squad ID` = '$SquadID'");
        if ($checkQuery && $checkQuery->num_rows > 0) {
            $sql = $conn->query("UPDATE `scorecard_bowling` 
            SET 
                `Overs` = '$overs',
                `Maidens` = '$maidens',
                `Runs` = '$runs',
                `Wickets` = '$wickets',
                `Economy` = '$economy'
            WHERE `Squad ID` = '$SquadID'");
        } else {
            $sql = $conn->query("INSERT INTO `scorecard_bowling`
                (`Squad ID`, `Overs`, `Maidens`, `Runs`, `Wickets`, `Economy`)
                VALUES ('$SquadID', '$overs', '$maidens', '$runs', '$wickets', '$economy')");
        }
        if ($sql) {
            echo "Success";
        } else {
            echo "Error";
        }
    }

    if (isset($_POST['AddCommentary'])) {
        $matchID = $_POST['match'];
        $commentary = addslashes($_POST['commentary']);
        $sql = $conn->query("INSERT INTO `commentary`(`Match ID`, `Commentary`) VALUES ('$matchID', '$commentary')");
        if ($sql) {
            echo "Success";
        } else {
            echo "Error";
        }
    }
}
?>