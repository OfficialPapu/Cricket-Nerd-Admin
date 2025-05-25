<?php
include "../Config/Config.php";

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET["GetAllTeam"])) {
    $Array = [];

    $TeamQuery = "SELECT * FROM `npl_points_table`"; 
    $TeamQueryRun = mysqli_query($conn, $TeamQuery);

    if ($TeamQueryRun) {
        while ($Row = mysqli_fetch_assoc($TeamQueryRun)) {
           
            $Row['Nrr_value'] = (float) str_replace('+', '', $Row['Nrr']);
            $Array[] = $Row;
        }

       
        usort($Array, function($a, $b) {
            if ($b['Points'] == $a['Points']) {
                return $b['Nrr_value'] <=> $a['Nrr_value'];
            }
            return $b['Points'] <=> $a['Points'];
        });

      
        foreach ($Array as &$team) {
            unset($team['Nrr_value']);
        }

        echo json_encode($Array);
    } else {
        echo json_encode(["error" => "Query Failed"]);
    }
}
?>
