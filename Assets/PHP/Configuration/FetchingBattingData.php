<?php
include "../API/Config/Config.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $squadId = $_POST['id'];
    $stmt = $conn->prepare("SELECT * FROM `scorecard_batting` WHERE `Squad ID` = ?");
    $stmt->bind_param("s", $squadId);
    $stmt->execute();
    $result = $stmt->get_result();

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
