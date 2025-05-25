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
$pointsQuery = "SELECT * FROM `npl_points_table` ";
$pointsData = mysqli_query($conn, $pointsQuery);

if ($pointsData && mysqli_num_rows($pointsData) > 0) {
    $result = mysqli_fetch_all($pointsData, MYSQLI_ASSOC);
    
    echo json_encode(['status' => 'success', 'points_table' => $result]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No points table data found']);
}
?>
