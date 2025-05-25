<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Access-Control-Origin, Content-Type, Access-Control-Allow-Method");

$conn = mysqli_connect("localhost", "thecricn_erd", "8.Z8~0pW*U4B", "thecricn_erd");

if (!$conn) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit();
}

$categories = ['Nepal National', 'Nepal Domestic', 'Editorial', 'Elite Cup (Jay Trophy)', 'Nepal Premier League'];
$newsData = [];
$latestTimes = [];

foreach ($categories as $category) {
    $LatestNewsQuery = "SELECT `Post Date` FROM `news` WHERE `News Type` = '$category' ORDER BY `Post Date` DESC LIMIT 1";
    $LatestNewsRun = mysqli_query($conn, $LatestNewsQuery);

    if ($LatestNewsRun && $LatestRow = mysqli_fetch_assoc($LatestNewsRun)) {
        $latestTimes[$category] = $LatestRow['Post Date'];
    } else {
        $latestTimes[$category] = null;
    }
}

arsort($latestTimes);

foreach ($latestTimes as $category => $postDate) {
    if ($postDate !== null) {
        $NewsQuery = "SELECT * FROM `news` WHERE `News Type` = '$category' ORDER BY `Post Date` DESC LIMIT 4";
        $NewsQueryRun = mysqli_query($conn, $NewsQuery);

        if (!$NewsQueryRun) {
            echo json_encode(['status' => 'error', 'message' => 'Query failed: ' . mysqli_error($conn)]);
            exit();
        }

        while ($Row = $NewsQueryRun->fetch_assoc()) {
            $newsData[$category][] = $Row;
        }
    }
}

if (empty($newsData)) {
    echo json_encode(["status" => "error", "message" => "No news found"]);
    exit();
}

$response = [
    "status" => "success",
    "news" => $newsData
];

echo json_encode($response);
?>
