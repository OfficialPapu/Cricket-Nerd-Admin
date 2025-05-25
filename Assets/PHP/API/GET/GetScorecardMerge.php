<?php
include "../Config/Config.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    
    $sql = "SELECT
    s.ID AS 'SquadID',
    s.`Match ID`,
    s.`Team`,
    s.`Player Name`,
    s.Type,
    
    batting.`Runs` AS 'Batting Runs',
    batting.`Balls`,
    batting.`Fours`,
    batting.`Sixes`,
    batting.`Strike Rate`,
    batting.`Status`,
    batting.`Batter Striker`,
    batting.`Batter Action`,
    
    bowling.`Overs`,
    bowling.`Maidens`,
    bowling.`Runs` AS 'Bowling Runs',
    bowling.`Wickets`,
    bowling.`Economy`,
    bowling.`Bowler Striker`,
    bowling.`Bowler Action`
    
FROM squads s
LEFT JOIN scorecard_batting batting ON
    batting.`Squad ID` = s.ID
LEFT JOIN scorecard_bowling bowling ON
    bowling.`Squad ID` = s.ID
GROUP BY s.ID";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($result, JSON_UNESCAPED_SLASHES);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Not found']);
}

}
?>