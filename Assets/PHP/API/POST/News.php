<?php
include "../Config/Config.php";
function sanitizeInput($input) {
    $input = str_replace("'", '', $input);
    $input = str_replace('"', '', $input);
    return $input;
}

$Title = sanitizeInput($_POST['Title'] ?? '');
$Description = sanitizeInput($_POST['Description'] ?? '');
$Author = sanitizeInput($_POST['Author'] ?? '');
$SlugUrl = CreateSlug($Title);
if (isset($_FILES['Image']) && $_FILES['Image']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['Image']['tmp_name'];
    $fileName = sanitizeInput($_FILES['Image']['name']); 

    $base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
    $uploadBaseDir = $base_url . "Media/Images/";
    
    $year = date('Y');
    $month = date('m');
    $uploadDir = $uploadBaseDir . $year . '/' . $month . '/';

    if (!file_exists($uploadDir)) {
        mkdir($uploadBaseDir . $year, 0777, true);
        mkdir($uploadBaseDir . $year . '/' . $month, 0777, true);
    }

    $uploadPath = $uploadDir . $fileName;
    $DbUploadPath = $year . '/' . $month . '/' . $fileName;

    if (move_uploaded_file($fileTmpPath, $uploadPath)) {
        $InsertNews = "INSERT INTO `news`(`Title`, `Slug Url`, `Description`, `Thumbnail`, `Author`, `Last Modified`, `Post Date`) 
               VALUES ('$Title', '$SlugUrl', '$Description', '$DbUploadPath', '$Author', CONVERT_TZ(NOW(), '+00:00', '+05:45'), CONVERT_TZ(NOW(), '+00:00', '+05:45'))";

        $InsertNewsRun = mysqli_query($conn, $InsertNews);

        echo $InsertNewsRun ? "Success" : "Error inserting news: " . mysqli_error($conn);
    } else {
        echo "Error moving uploaded file";
    }
} else {
    echo "Image not selected";
}
