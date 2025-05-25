<?php
include "../Config/Config.php";
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $Array=[];
    if (isset($_GET["GetAllVideo"])) {
        $VideoQuery="SELECT * FROM `videos` ORDER BY ID DESC";
        $VideoQueryRun=mysqli_query($conn,$VideoQuery);
        if($VideoQueryRun){
            while($Row=$VideoQueryRun->fetch_assoc()){
                $Array[]=$Row;
            }   
            echo json_encode($Array); 
        }
    }
}
