<?php
include "../Config/Config.php";
$TournamentName = $_POST['TournamentName'] ?? '';
$CountryA = $_POST['CountryA'] ?? '';
$CountryB = $_POST['CountryB'] ?? '';
$Schedule = $_POST['Schedule'] ?? '';
$Time = $_POST['Time'] ?? '';
$Link = $_POST['Link'] ?? '';

$InsertMatcheQuery="INSERT INTO `matches`(`Tournament Name`, `Country A`, `Country B`, `Schedule`, `Time`,`Link`,`Post Date`) VALUES ('$TournamentName','$CountryA','$CountryB','$Schedule','$Time','$Link',CONVERT_TZ(NOW(), '+00:00', '+05:45'))";
$InsertMatcheQueryRun=mysqli_query($conn,$InsertMatcheQuery);
if($InsertMatcheQueryRun){
    echo "Success";
}else{
    echo "Error";
}

?>