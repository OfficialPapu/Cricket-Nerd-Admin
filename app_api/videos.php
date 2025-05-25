<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:GET");
header("Access-Control-Allow-Headers:Access-Control-Origin, Content-Type, Access-Control-Allow-Method");
$conn = mysqli_connect("localhost", "thecricn_erd", "8.Z8~0pW*U4B","thecricn_erd");
if(!$conn){
    echo json_encode(['status'=>'error','message'=>'connection failed']);
}
$videos= "SELECT * FROM `videos` ORDER BY `ID` DESC";
$videosData= mysqli_query($conn,$videos);
if($videosData && mysqli_num_rows($videosData)>0){
    $videosFetch=mysqli_fetch_all($videosData,MYSQLI_ASSOC);
    echo json_encode($videosFetch);
}else{
    echo json_encode(['status'=>'error','message'=>'Not Found']);
}

?>