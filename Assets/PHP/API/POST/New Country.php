<?php
include "../Config/Config.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
$CountryName = addslashes($_POST['CountryName'] ?? '');
$CountryCode = addslashes($_POST['CountryCode'] ?? '');


    if (isset($_FILES['Image']) && $_FILES['Image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['Image']['tmp_name'];
        $fileName = $_FILES['Image']['name'];
        $base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
        $uploadBaseDir = $base_url . "Media/Flags/";
        $uploadPath = $uploadBaseDir . $fileName;
        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            $InsertCountryQuery = "INSERT INTO `flags`(`Country Name`, `Country Code`, `Icon`) VALUES ('$CountryName','$CountryCode','$fileName')";
            $InsertCountryQueryRun = mysqli_query($conn, $InsertCountryQuery);
            if ($InsertCountryQueryRun) {
                echo "Success";
            } else {
                echo "Error";
            }
        } else {
            echo "Error uploading file.";
        }
    }
}
