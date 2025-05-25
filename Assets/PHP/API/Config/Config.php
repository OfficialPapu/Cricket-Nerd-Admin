<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
//  $conn = mysqli_connect("localhost", "root", "", "the cricket nerd");
$conn = mysqli_connect("localhost", "thecricn_erd", "8.Z8~0pW*U4B","thecricn_erd");
if (!$conn) {
    echo "Connection Fail";
}

function CreateSlug($string) {
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9]+/i', '-', $string);
    $string = trim($string, '-');
    return $string;
}
?>