<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Access-Control-Allow-Origin");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

$conn = mysqli_connect("localhost", "thecricn_erd", "8.Z8~0pW*U4B", "thecricn_erd");

if (!$conn) {
    echo json_encode(['status' => 'error', 'message' => 'Connection failed']);
    exit;
}

$match = "SELECT matches.`ID`, 
       matches.`Tournament Name`, 
       matches.`Category`, 
       matches.`Status`, 
       matches.`Country A`, 
       matches.`Country B`, 
       matches.`Custom Name A`, 
       matches.`Custom Name B`, 
       matches.`Custom Flag A`, 
       matches.`Custom Flag B`, 
       matches.`Category Slug`, 
       matches.`Schedule`, 
       matches.`Match`, 
       matches.`Venue`, 
       matches.`Toss`, 
       matches.`Umpires`, 
       matches.`Match Referee`, 
       matches.`Time`, 
       matches.`Post Date`,
       matches.`Score A`,
       matches.`Score B`,
       matches.`Over A`,
       matches.`Over B`,
       matches.`Result`,
       matches.`Total Overs`,
       matches.`Batting`,
       COALESCE(matches.`Custom Flag A`, flag1.`Icon`) AS FlagA,
       COALESCE(matches.`Custom Flag B`, flag2.`Icon`) AS FlagB
FROM `matches` matches
LEFT JOIN flags flag1 ON flag1.`Country Name` = matches.`Country A`
LEFT JOIN flags flag2 ON flag2.`Country Name` = matches.`Country B`
ORDER BY matches.`Time` ASC, matches.`Post Date` ASC";

$matchData = mysqli_query($conn, $match);

if ($matchData && mysqli_num_rows($matchData) > 0) {
    $result = mysqli_fetch_all($matchData, MYSQLI_ASSOC);
    echo json_encode($result);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Not found']);
}

mysqli_close($conn);
?>