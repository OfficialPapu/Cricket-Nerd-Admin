<?php
include "../Config/Config.php";
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $Array = [];
    if (isset($_GET["Statistics"])) {
        $StatisticsQuery = "SELECT
    p.`ID`,
    p.`Slug Url`,
    odi.`Batting Average` AS ODIBattingAverage,
    odi.`Run Scored` AS ODIRunScored,
    t20.`Batting Average` AS T20BattingAverage,
    t20.`Run Scored` AS T20RunScored,
    p.`Player Name`,
    p.`Player Photo`,
    p.`Player Role`
FROM
    players p
LEFT JOIN t20i_statistics t20 ON
    t20.`Player ID` = p.`ID`
LEFT JOIN `odi_statistics` odi ON
    odi.`Player ID` = p.`ID`
GROUP BY p.`ID`";
        $StatisticsQueryRun = mysqli_query($conn, $StatisticsQuery);
        if ($StatisticsQueryRun) {
            while ($Row = $StatisticsQueryRun->fetch_assoc()) {
                $Array[] = $Row;
            }
            echo json_encode($Array);
        }
    }
    if (isset($_GET["ListAllPlayers"])) {
        $PlayersQuery = "SELECT * FROM `players` ORDER BY ID DESC";
        $PlayersQueryRun = mysqli_query($conn, $PlayersQuery);
        if ($PlayersQueryRun) {
            while ($Row = $PlayersQueryRun->fetch_assoc()) {
                $Array[] = $Row;
            }
            echo json_encode($Array);
        }
    }

    if (isset($_GET['FetchStats'])) {
  $SlugUrl=$_GET["SlugUrl"];
        $FetchStatsQuery = "SELECT
    p.ID,
    p.`Player Name`,
    p.`Player Role`,
    p.`Player Type`,
    p.`Bowling Style`,
    p.`Batting Style`,
    p.`Player Photo`,
    t.`Total Matches` AS T20_Matches,
    t.`Batting Innings` AS T20_Batting_Innings,
    t.`Bowlings Innings` AS T20_Bowlings_Innings,
    t.`Run Scored` AS T20_Run_Scored,
    t.`Highest Score` AS T20_Highest_Score,
    t.`Half Centuries` AS T20_Half_Centuries,
    t.`Centuries` AS T20_Centuries,
    t.`Strike Rate` AS T20_Strike_Rate,
    t.`Batting Average` AS T20_Batting_Average,
    t.`Bowling Economy` AS T20_Bowling_Economy,
    t.`Wickets Taken` AS T20_Wickets_Taken,
    t.`Best Bowlings` AS T20_Best_Bowling,
    o.`Total Matches` AS ODI_Matches,
    o.`Batting Innings` AS ODI_Batting_Innings,
    o.`Bowlings Innings` AS ODI_Bowlings_Innings,
    o.`Run Scored` AS ODI_Run_Scored,
    o.`Highest Score` AS ODI_Highest_Score,
    o.`Half Centuries` AS ODI_Half_Centuries,
    o.`Centuries` AS ODI_Centuries,
    o.`Strike Rate` AS ODI_Strike_Rate,
    o.`Batting Average` AS ODI_Batting_Average,
    o.`Bowling Economy` AS ODI_Bowling_Economy,
    o.`Wickets Taken` AS ODI_Wickets_Taken,
    o.`Best Bowlings` AS ODI_Best_Bowling
FROM
    `players` p
LEFT JOIN `t20i_statistics` t ON
    p.`ID` = t.`Player ID`
LEFT JOIN `odi_statistics` o ON
    p.`ID` = o.`Player ID`
WHERE
    p.`Slug Url` LIKE '%$SlugUrl%'";
        $FetchStatsQueryRun = mysqli_query($conn, $FetchStatsQuery);
        while ($Row = $FetchStatsQueryRun->fetch_assoc()) {
            $Array[] = $Row;
        }
        echo json_encode($Array);
    }
}
