<?php
include "../Config/Config.php";
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $Array = [];
    if (isset($_GET["LatestMatches"])) {
        $MatchesQuery = "SELECT matche.`ID`, `Tournament Name`, `Country A`, `Country B`, `Schedule`, `Time`, flag1.`Icon` AS FlagA, flag2.`Icon` AS FlagB, matche.Link FROM`matches` matche 
    JOIN flags flag1 ON flag1.`Country Name` = matche.`Country A`
    JOIN flags flag2 ON flag2.`Country Name` = matche.`Country B` ORDER BY matche.ID ASC LIMIT 4";
        $MatchesQueryRun = mysqli_query($conn, $MatchesQuery);
        if ($MatchesQueryRun) {
            while ($Row = $MatchesQueryRun->fetch_assoc()) {
                $Array[] = $Row;
            }
            echo json_encode($Array);
        }
    }
    if (isset($_GET['LatestNews'])) {
        $NewsQuery = "SELECT * FROM `news` ORDER BY `ID` DESC LIMIT 4";
        $NewsQueryRun = mysqli_query($conn, $NewsQuery);
        while ($Row = $NewsQueryRun->fetch_assoc()) {
            $Array[] = $Row;
        }
        echo json_encode($Array);
    }
    if (isset($_GET["GetYTVideo"])) {
        $VideoQuery = "SELECT * FROM `videos`";
        $VideoQueryRun = mysqli_query($conn, $VideoQuery);
        if ($VideoQueryRun) {
            while ($Row = $VideoQueryRun->fetch_assoc()) {
                $Array[] = $Row;
            }
            echo json_encode($Array);
        }
    }
}
