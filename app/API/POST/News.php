<?php
include "../Config/Config.php";
$Title = $_POST['Title'] ?? '';
$Description = $_POST['Description'] ?? '';
$Author = $_POST['Author'] ?? '';
$SlugUrl = CreateSlug($Title);
if (isset($_FILES['Image']) && $_FILES['Image']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['Image']['tmp_name'];
    $fileName = $_FILES['Image']['name'];

    // $uploadBaseDir = 'http://localhost:3000/public/Images';
    $uploadBaseDir = '';
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
        $InsertNews = "INSERT INTO `news`(`Title`,`Slug Url`, `Description`, `Thumbnail`, `Author`, `Last Modified`, `Post Date`) 
                       VALUES ('$Title','$SlugUrl','$Description', '$DbUploadPath', '$Author', NOW(), NOW())";

        $InsertNewsRun = mysqli_query($conn, $InsertNews);

        echo $InsertNewsRun ? "Success" : "Error inserting news: " . mysqli_error($conn);
    } else {
        echo "Error moving uploaded file";
    }
} else {
    echo "Image not selected";
}
