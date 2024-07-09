<?php
include "../Config/Config.php";
$VideoTitle = $_POST['VideoTitle'] ?? '';
$Description = $_POST['Description'] ?? '';
$Link = $_POST['Link'] ?? '';
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

        $InsertVideoQuery = "INSERT INTO `videos`(`Title`, `Description`,`Link`, `Thumbnail`, `Post Date`) VALUES ('$VideoTitle','$Description','$Link','$DbUploadPath',NOW())";
        $InsertVideoQueryRun = mysqli_query($conn, $InsertVideoQuery);
        if ($InsertVideoQueryRun) {
            echo "Success";
        } else {
            echo "Error";
        }
    }
}
