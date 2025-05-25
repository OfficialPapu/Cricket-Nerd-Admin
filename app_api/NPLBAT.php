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

$battingStatsQuery = "SELECT * FROM `npl_stats_batting`";
$battingStatsData = mysqli_query($conn, $battingStatsQuery);

if ($battingStatsData && mysqli_num_rows($battingStatsData) > 0) {
    $result = mysqli_fetch_all($battingStatsData, MYSQLI_ASSOC);
    
    echo json_encode(['status' => 'success', 'batting_stats' => $result]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No batting stats data found']);
}
?>
