<?php
include "../Config/Config.php";

$Title = addslashes($_POST['Title'] ?? '');
$Description = addslashes($_POST['Description'] ?? '');
$Author = addslashes($_POST['Author'] ?? '');
$NewsType = addslashes($_POST['NewsType'] ?? '');
$SlugUrl = CreateSlug($Title);
$NewsCategorySlugUrl = CreateSlug($NewsType);
if (isset($_FILES['Image']) && $_FILES['Image']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['Image']['tmp_name'];
    $fileName = addslashes($_FILES['Image']['name']); 

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
        $InsertNews = "INSERT INTO `news`(`Title`, `Slug Url`, `Description`, `Thumbnail`, `News Type`, `News Type Slug`, `Author`, `Last Modified`, `Post Date`) 
               VALUES ('$Title', '$SlugUrl', '$Description', '$DbUploadPath', '$NewsType', '$NewsCategorySlugUrl' ,'$Author', CONVERT_TZ(NOW(), '+00:00', '+05:45'), CONVERT_TZ(NOW(), '+00:00', '+05:45'))";

        $InsertNewsRun = mysqli_query($conn, $InsertNews);

        echo $InsertNewsRun ? "Success" : "Error inserting news: " . mysqli_error($conn);
    } else {
        echo "Error moving uploaded file";
    }
} else {
    echo "Image not selected";
}




if (isset($_POST['UploadDescImages'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
        $uploadDir =  $_SERVER['DOCUMENT_ROOT'] . "/" . "Assets/News Images/" . date("Y/m/");

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $file = $_FILES['image'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp'];
        if (in_array($file['type'], $allowedTypes)) {
            $fileName = uniqid('img_', true) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
            $filePath = $uploadDir . $fileName;

            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                $imagePathWithoutBaseURL = str_replace($base_url, '', $filePath);
                echo json_encode([
                    'success' => true,
                    'imageUrl' => $imagePathWithoutBaseURL,
                ]);
            }
        }
    }
}
