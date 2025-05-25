<?php
include "../API/Config/Config.php";
if (isset($_POST['UpdateNews']) && $_POST['UpdateNews'] == true) {
    $NewsID = $_POST['NewsID'];
    $Title = ($_POST['Title']);
    $Author = ($_POST['Author']);
    $Description = ($_POST['Description']);


    if (empty($Title) || empty($Author) || empty($Description)) {
        echo 'Error: All fields are required.';
        exit();
    }

    $stmt = $conn->prepare("UPDATE `news` SET `Title` = ?, `Author` = ?, `Description` = ? WHERE `ID` = ?");
    $stmt->bind_param("sssi", $Title, $Author, $Description, $NewsID); 

    if ($stmt->execute()) {
        echo 'Success'; 
    } else {
        echo 'Error: Failed to update news.'; 
    }

    // Close the prepared statement
    $stmt->close();
}
?>
