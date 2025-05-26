<?php
include "../Config/Config.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $response = [];
    if (isset($_GET['Scoreboard'])) {
        $ID = $_GET["ID"];

        $Query = $conn->query("SELECT s.Team, s.`Player Name`, s.Type  FROM squads s JOIN matches m ON m.ID = s.`Match ID` WHERE s.`Match ID` = '$ID'");
        $teams = [];

        while ($Row = $Query->fetch_assoc()) {
            $team = $Row['Team'];
            $type = $Row['Type'];

            // Organize players into teams and types
            if (!isset($teams[$team])) {
                $teams[$team] = ['Playing' => [], 'Bench' => []];
            }

            $teams[$team][$type][] = [
                'player_name' => $Row['Player Name'],
            ];
        }

        // Structure response
        foreach ($teams as $teamName => $categories) {
            $response[] = [
                'team' => $teamName,
                'playing' => $categories['Playing'],
                'bench' => $categories['Bench']
            ];
        }

        echo json_encode($response);
    }
    if (isset($_GET['MatchInfo'])) {
        $ID = $_GET["ID"];
        $Query = $conn->query("SELECT * FROM `matches` WHERE `ID` = '$ID'");
        echo json_encode($Query->fetch_assoc());
    }
    if (isset($_GET['Batting'])) {
        $ID = $_GET["ID"];
        $Query = $conn->query("SELECT * FROM `scorecard_batting` sb JOIN squads s ON `sb`.`Squad ID` = `s`.`ID` WHERE `s`.`Match ID` = '$ID'");

        $data = array();

        while ($row = $Query->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode($data);
    }
    if (isset($_GET['Bowling'])) {
        $ID = $_GET["ID"];
        $Query = $conn->query("SELECT * FROM `scorecard_bowling` sb JOIN squads s ON `sb`.`Squad ID` = `s`.`ID` WHERE `s`.`Match ID` = '$ID'");

        $data = array();

        while ($row = $Query->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode($data);
    }



    if (isset($_GET['Extras'])) {
        $ID = $_GET["ID"];
        $Query = $conn->query("SELECT * FROM `scorecard_extras` WHERE `Match ID` = '$ID'");

        $data = array();
        while ($row = $Query->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    }


    if (isset($_GET['PlayerData'])) {
        $MatchID = $_GET["MatchID"];
        $Country = $_GET["Country"];
        $Query = $conn->query("SELECT * FROM `squads` WHERE `Match ID` = '$MatchID' AND `Team` = '$Country'");

        $data = array();
        while ($row = $Query->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    }

    if (isset($_GET['FetchCommentary'])) {
        $ID = $_GET["matchID"];
        $Query = $conn->query("SELECT * FROM `commentary` WHERE `Match ID` = '$ID' ORDER BY `ID` DESC");
        $data = array();
        while ($row = $Query->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    }
    if (isset($_GET['FetchScore'])) {
        $MatchID = $_GET["MatchID"];
        $Country = $_GET["Country"];
        $Query = $conn->query("SELECT `Country A`, `Country B`, `Custom Name A`, `Custom Name B`, `Score A`, `Score B`, `Over A`, `Over B`, `Batting` ,`Total Overs`, `Result` FROM `matches` WHERE `ID` = '$MatchID' AND (`Country A` = '$Country' OR `Country B` = '$Country' OR `Custom Name A` = '$Country' OR `Custom Name B` = '$Country')");
        $data = array();
        while ($row = $Query->fetch_assoc()) {
            if($Country == $row['Country A'] || $Country == $row['Custom Name A']) {
                $row['Score'] = $row['Score A'];
                $row['Over'] = $row['Over A'];
            } else {
                $row['Score'] = $row['Score B'];
                $row['Over'] = $row['Over B'];
            }
            unset($row['Score A'], $row['Score B'], $row['Over A'], $row['Over B']);
            $data[] = $row;
        }
        echo json_encode($data);
    }
}
