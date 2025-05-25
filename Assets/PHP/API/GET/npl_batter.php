<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

include "../Config/Config.php";
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $response = [];
    if (isset($_GET["GetNPLBatter"])) {
        $query = "SELECT * FROM `npl_stats_batting` ORDER BY ID DESC";
        $queryRun = mysqli_query($conn, $query);
        if ($queryRun) {
            while ($row = $queryRun->fetch_assoc()) {
                $response[] = $row;
            }
            echo json_encode($response);
        } else {
            echo json_encode(["error" => "Error fetching records: " . mysqli_error($conn)]);
        }
    }
}
?>
