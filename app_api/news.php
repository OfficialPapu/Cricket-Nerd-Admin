<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Access-Control-Origin, Content-Type, Access-Control-Allow-Method");

$conn = mysqli_connect("localhost", "thecricn_erd", "8.Z8~0pW*U4B", "thecricn_erd");

if(!$conn){
    echo json_encode(['status' => 'error', 'message' => 'Connection failed']);
    exit();
}

$newsQuery = "SELECT * FROM `news` ORDER BY `ID` DESC";
$newsData = mysqli_query($conn, $newsQuery);

if ($newsData && mysqli_num_rows($newsData) > 0) {
    $result = mysqli_fetch_all($newsData, MYSQLI_ASSOC);
    
    echo json_encode(['status' => 'success', 'news' => $result]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No news found']);
}
?>
