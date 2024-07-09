<?php
include "../Config/Config.php";
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $Array = [];
    if (isset($_GET["GetAllMatches"])) {
        $MatchesQuery = "SELECT matche.`ID`, `Tournament Name`, `Country A`, `Country B`, `Schedule`, `Time`, flag1.`Country Code` AS FlagA, flag2.`Country Code` AS FlagB FROM`matches` matche 
    JOIN flags flag1 ON flag1.`Country Name` = matche.`Country A`
    JOIN flags flag2 ON flag2.`Country Name` = matche.`Country B` ORDER BY matche.ID DESC";
        $MatchesQueryRun = mysqli_query($conn, $MatchesQuery);
        if ($MatchesQueryRun) {
            while ($Row = $MatchesQueryRun->fetch_assoc()) {
                $Array[] = $Row;
            }
            echo json_encode($Array);
        }
    }
    if (isset($_GET["ListAllCountry"])) {
        $FlagsQuery = "SELECT * FROM `flags` ORDER BY `Country Name` ASC";
        $FlagsQueryRun = mysqli_query($conn, $FlagsQuery);
        if ($FlagsQueryRun) {
            while ($Row = $FlagsQueryRun->fetch_assoc()) {
                $Array[] = $Row;
            }
            echo json_encode($Array);
        }
    }
}
