<?php
    session_start();
if (isset($_POST['LoginAdmin'])) {
    include_once 'Config.php';
    $Email = mysqli_real_escape_string($conn, $_POST['Email']);
    $Pass = mysqli_real_escape_string($conn, $_POST['Pass']);
    $AdminVerifyQuery="SELECT * FROM `admin` WHERE `Email`='$Email' && BINARY `Password`='$Pass'";
    $AdminVerifyRun=mysqli_query($conn,$AdminVerifyQuery);
    if($AdminVerifyRun->num_rows>0){
        $_SESSION['Logged In'] = true;
        echo "Success";
    }else{
        echo "Fail";
    }
}
?>