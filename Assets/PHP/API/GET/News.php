<?php
include "../Config/Config.php";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $Array = [];
    if (isset($_GET['CurrentEvents'])) {
        $NewsQuery = "SELECT * FROM `news` ORDER BY `ID` DESC LIMIT 4";
        $NewsQueryRun = mysqli_query($conn, $NewsQuery);
        while ($Row = $NewsQueryRun->fetch_assoc()) {
            $Array[] = $Row;
        }
        echo json_encode($Array);
    }
    if (isset($_GET['ListAllNews'])) {
        $NewsQuery = "SELECT * FROM `news` ORDER BY `ID` DESC";
        $NewsQueryRun = mysqli_query($conn, $NewsQuery);
        while ($Row = $NewsQueryRun->fetch_assoc()) {
            $Array[] = $Row;
        }
        echo json_encode($Array);
    }
    if (isset($_GET['FetchNewsDetails'])) {
        $Slug=$_GET["Slug"];
        $NewsQuery = "SELECT * FROM `news` WHERE `Slug Url` LIKE '%$Slug%'";
        $NewsQueryRun = mysqli_query($conn, $NewsQuery);
        while ($Row = $NewsQueryRun->fetch_assoc()) {
            $Array[] = $Row;
        }
        echo json_encode($Array);
    }
    if (isset($_GET['RelatedNews'])) {
        $NewsQuery = "SELECT * FROM `news` ORDER BY RAND() LIMIT 0,3";
        $NewsQueryRun = mysqli_query($conn, $NewsQuery);
        while ($Row = $NewsQueryRun->fetch_assoc()) {
            $Array[] = $Row;
        }
        echo json_encode($Array);
    }

    if (isset($_GET['FetchNewsCategory'])) {
        $Slug=$_GET["Slug"];
        $NewsQuery = "SELECT * FROM `news` WHERE `News Type Slug` LIKE '%$Slug%'";
        $NewsQueryRun = mysqli_query($conn, $NewsQuery);
        while ($Row = $NewsQueryRun->fetch_assoc()) {
            $Array[] = $Row;
        }
        echo json_encode($Array);
    }

}
