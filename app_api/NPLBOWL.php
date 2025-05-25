<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Access-Control-Origin, Content-Type, Access-Control-Allow-Method");

$conn = mysqli_connect("localhost", "thecricn_erd", "8.Z8~0pW*U4B", "thecricn_erd");

if (!$conn) {
    echo json_encode(['status' => 'error', 'message' => 'Connection failed']);
    exit();
}

$bowlingStatsQuery = "SELECT * FROM `npl_stats_bowling`";
$bowlingStatsData = mysqli_query($conn, $bowlingStatsQuery);

if ($bowlingStatsData && mysqli_num_rows($bowlingStatsData) > 0) {
    $result = mysqli_fetch_all($bowlingStatsData, MYSQLI_ASSOC);
    usort($result, function ($a, $b) {
        if ($a['Total Wickets'] == $b['Total Wickets']) {
            return $a['Economy'] <=> $b['Economy'];
        }
        return $b['Total Wickets'] <=> $a['Total Wickets'];
    });
    echo json_encode(['status' => 'success', 'bowling_stats' => $result]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No bowling stats data found']);
}
?>
