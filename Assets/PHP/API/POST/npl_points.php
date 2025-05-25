<?php

include "../Config/Config.php";

$Title = addslashes($_POST['TournamentTitle'] ?? '');
$Team_name = addslashes($_POST['TeamName'] ?? '');

$stmt = $conn->prepare("INSERT INTO `npl_points_table` (`Title`, `Team Name`) VALUES (?, ?)");
$stmt->bind_param("ss", $Title, $Team_name);

if ($stmt->execute()) {
    echo "Success";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>
