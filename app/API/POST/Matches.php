<?php
include "../Config/Config.php";
$TournamentName = $_POST['TournamentName'] ?? '';
$CountryA = $_POST['CountryA'] ?? '';
$CountryB = $_POST['CountryB'] ?? '';
$Schedule = $_POST['Schedule'] ?? '';
$Time = $_POST['Time'] ?? '';

$InsertMatcheQuery="INSERT INTO `matches`(`Tournament Name`, `Country A`, `Country B`, `Schedule`, `Time`, `Post Date`) VALUES ('$TournamentName','$CountryA','$CountryB','$Schedule','$Time',NOW())";
$InsertMatcheQueryRun=mysqli_query($conn,$InsertMatcheQuery);
if($InsertMatcheQueryRun){
    echo "Success";
}else{
    echo "Error";
}

?>