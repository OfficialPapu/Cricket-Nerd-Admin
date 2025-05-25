<?php
include "../API/Config/Config.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $matchID = $_POST['match'];
     $country = $_POST['country'];
     
  $result = $conn->query("SELECT * FROM `scorecard_extras` WHERE `Match ID` = '$matchID' AND `Country` = '$country'");

    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode([
        'status' => 'success',
        'data' => $data
    ]);
} 
?>
