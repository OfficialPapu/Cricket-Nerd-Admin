<?php
session_start();
// include '../../Config/Config.php';
include "../API/Config/Config.php";

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $battingId = $conn->real_escape_string($_POST['batting_id']);
    $runs = $conn->real_escape_string($_POST['runs']);
    $balls = $conn->real_escape_string($_POST['balls']);
    $fours = $conn->real_escape_string($_POST['fours']);
    $sixes = $conn->real_escape_string($_POST['sixes']);
    $strikeRate = $conn->real_escape_string($_POST['strike_rate']);
    $status = $conn->real_escape_string($_POST['status']);
    
    $query = "UPDATE batting SET 
              runs = '$runs',
              balls = '$balls',
              fours = '$fours',
              sixes = '$sixes',
              strike_rate = '$strikeRate',
              status = '$status'
              WHERE id = '$battingId'";
              
    if ($conn->query($query)) {
        $response['success'] = true;
        $response['message'] = 'Batting record updated successfully';
    } else {
        $response['message'] = 'Error updating batting record: ' . $conn->error;
    }
} else {
    $response['message'] = 'Invalid request method';
}

header('Content-Type: application/json');
echo json_encode($response);
?>