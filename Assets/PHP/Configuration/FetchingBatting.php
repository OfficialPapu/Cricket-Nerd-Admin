<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include "../API/Config/Config.php";

$response = ['success' => false, 'message' => ''];

if (isset($_GET['player_id'])) {
    $playerId = $conn->real_escape_string($_GET['player_id']);

    $query = "SELECT * FROM `scorecard_batting` WHERE player_id = '$playerId' LIMIT 1";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $response['success'] = true;
        $response['data'] = $result->fetch_assoc();
    } else {
        $response['message'] = 'No batting record found for this player';
    }
} else {
    $response['message'] = 'Player ID not provided';
}

header('Content-Type: application/json');
echo json_encode($response);
