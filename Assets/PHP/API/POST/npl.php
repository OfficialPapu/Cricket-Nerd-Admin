<?php
include "../Config/Config.php";

header('Content-Type: application/json');
ob_start();

$response = ['success' => false, 'message' => 'Invalid request.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Player_Name = addslashes($_POST['PlayerName'] ?? '');
    $Player_Role = addslashes($_POST['PlayerRole'] ?? '');
    $Tournament_Title = addslashes($_POST['Title'] ?? '');
    
    if ($Player_Role === 'Batsman') {
        $tableName = 'npl_stats_batting';
    } elseif ($Player_Role === 'Bowler') {
        $tableName = 'npl_stats_bowling';
    } else {
        $response['message'] = 'Invalid Player Role';
        ob_end_clean();
        echo json_encode($response);
        exit;
    }

    $insertQuery = "INSERT INTO `$tableName`(`Player Name`, `Title`) VALUES ('$Player_Name','$Tournament_Title')";

    if (mysqli_query($conn, $insertQuery)) {
        $response = ['success' => true, 'message' => "Player record inserted successfully"];
    } else {
        error_log("DB Error: " . mysqli_error($conn));
        $response['message'] = 'Error inserting record.';
    }
}

ob_end_clean();
echo json_encode($response);
exit;
?>
