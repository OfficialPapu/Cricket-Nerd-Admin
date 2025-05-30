<?php
include "../Config/Config.php";
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $Array = [];
    if (isset($_GET["GetAllMatches"])) {
        $MatchesQuery = "SELECT
    matches.`ID`,
    matches.`Status`,
    matches.`Custom Flag A`,
    matches.`Custom Flag B`,
    matches.`Custom Name A`,
    matches.`Custom Name B`,
    matches.`Category`,
    `Tournament Name`,
    `Country A`,
    `Country B`,
    `Schedule`,
    `Time`,
    flag1.`Icon` AS FlagA,
    flag2.`Icon` AS FlagB
FROM
    `matches` matches
LEFT JOIN flags flag1 ON
    flag1.`Country Name` = matches.`Country A`
LEFT JOIN flags flag2 ON
    flag2.`Country Name` = matches.`Country B`
ORDER BY
    matches.ID ASC";
        $MatchesQueryRun = mysqli_query($conn, $MatchesQuery);
        if ($MatchesQueryRun) {
            while ($Row = $MatchesQueryRun->fetch_assoc()) {
                $Array[] = $Row;
            }
            echo json_encode($Array);
        }
    }
    if (isset($_GET["ListAllCountry"])) {
        $FlagsQuery = "SELECT * FROM `flags` ORDER BY `Country Name` DESC";
        $FlagsQueryRun = mysqli_query($conn, $FlagsQuery);
        if ($FlagsQueryRun) {
            while ($Row = $FlagsQueryRun->fetch_assoc()) {
                $Array[] = $Row;
            }
            echo json_encode($Array);
        }
    }
}
