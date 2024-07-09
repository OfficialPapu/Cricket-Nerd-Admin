<?php
$conn = mysqli_connect("localhost", "root", "", "the cricket nerd");
if (!$conn) {
    echo "Connection Fail";
}
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
function CreateSlug($string) {
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9]+/i', '-', $string);
    $string = trim($string, '-');
    return $string;
}
?>