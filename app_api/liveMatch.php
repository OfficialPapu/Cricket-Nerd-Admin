<?php
// include "../Config/Config.php";

header('Content-Type: application/json');
$conn = mysqli_connect("localhost", "thecricn_erd", "8.Z8~0pW*U4B", "thecricn_erd");

if (!$conn) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit();
}
function respond($success, $message, $data = []) {
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['Scoreboard'])) {
        $ID = $_GET["ID"] ?? null;

        if (!$ID) {
            respond(false, "Missing Match ID");
        }

        $Query = $conn->query("SELECT s.Team, s.`Player Name`, s.Type FROM squads s JOIN matches m ON m.ID = s.`Match ID` WHERE s.`Match ID` = '$ID'");
        $teams = [];

        while ($Row = $Query->fetch_assoc()) {
            $team = $Row['Team'];
            $type = $Row['Type'];

            if (!isset($teams[$team])) {
                $teams[$team] = ['Playing' => [], 'Bench' => []];
            }

            $teams[$team][$type][] = [
                'player_name' => $Row['Player Name'],
            ];
        }

        $response = [];
        foreach ($teams as $teamName => $categories) {
            $response[] = [
                'team' => $teamName,
                'playing' => $categories['Playing'],
                'bench' => $categories['Bench']
            ];
        }

        respond(true, "Scoreboard fetched successfully", $response);
    }

    if (isset($_GET['MatchInfo'])) {
        $ID = $_GET["ID"] ?? null;
        if (!$ID) {
            respond(false, "Missing Match ID");
        }

        $Query = $conn->query("SELECT * FROM `matches` WHERE `ID` = '$ID'");
        $data = $Query->fetch_assoc();

        respond(true, "Match info fetched successfully", $data ?: []);
    }

    if (isset($_GET['Batting'])) {
        $ID = $_GET["ID"] ?? null;
        if (!$ID) {
            respond(false, "Missing Match ID");
        }

        $Query = $conn->query("SELECT * FROM `scorecard_batting` sb JOIN squads s ON sb.`Squad ID` = s.`ID` WHERE s.`Match ID` = '$ID'");
        $data = [];

        while ($row = $Query->fetch_assoc()) {
            $data[] = $row;
        }

        respond(true, "Batting data fetched successfully", $data);
    }

    if (isset($_GET['Bowling'])) {
        $ID = $_GET["ID"] ?? null;
        if (!$ID) {
            respond(false, "Missing Match ID");
        }

        $Query = $conn->query("SELECT * FROM `scorecard_bowling` sb JOIN squads s ON sb.`Squad ID` = s.`ID` WHERE s.`Match ID` = '$ID'");
        $data = [];

        while ($row = $Query->fetch_assoc()) {
            $data[] = $row;
        }

        respond(true, "Bowling data fetched successfully", $data);
    }

    if (isset($_GET['Extras'])) {
        $ID = $_GET["ID"] ?? null;
        if (!$ID) {
            respond(false, "Missing Match ID");
        }

        $Query = $conn->query("SELECT * FROM `scorecard_extras` WHERE `Match ID` = '$ID'");
        $data = [];

        while ($row = $Query->fetch_assoc()) {
            $data[] = $row;
        }

        respond(true, "Extras data fetched successfully", $data);
    }

    // If no valid parameter found
    respond(false, "No valid parameter provided");
} else {
    respond(false, "Invalid request method");
}
