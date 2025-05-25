<?php
include "../Config/Config.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['LatestNews'])) {
        $categories = [
            'Nepal National',
            'Nepal Domestic',
            'Editorial',
            'Elite Cup (Jay Trophy)',
            'Nepal Premier League'
        ];

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

                while ($Row = mysqli_fetch_assoc($NewsQueryRun)) {
                    $newsData[$category][] = $Row;
                }
            }
        }

        echo json_encode($newsData);
    }

    if (isset($_GET["GetYTVideo"])) {
        $Array = [];
        $VideoQuery = "SELECT * FROM `videos`";
        $VideoQueryRun = mysqli_query($conn, $VideoQuery);

        if (!$VideoQueryRun) {
            die(json_encode(["error" => "Query Failed: " . mysqli_error($conn)]));
        }

        while ($Row = mysqli_fetch_assoc($VideoQueryRun)) {
            $Array[] = $Row;
        }
        echo json_encode($Array);
    }
}
?>
