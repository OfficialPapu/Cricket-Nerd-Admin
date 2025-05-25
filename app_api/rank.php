<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

$rank = [
    [
        "ID" => "1",
        "Name" => "Nepal",
        "Flag"=> "https://imgs.search.brave.com/uRhDCe-cWSiTFEpgAo5OarIv2p9QjiZ-NuDZOmageRg/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly91cGxv/YWQud2lraW1lZGlh/Lm9yZy93aWtpcGVk/aWEvY29tbW9ucy90/aHVtYi85LzliL0Zs/YWdfb2ZfTmVwYWwu/c3ZnLzUxMnB4LUZs/YWdfb2ZfTmVwYWwu/c3ZnLnBuZw",
        "ODI" => "18",
        "T20" => "17",
        "Test"=> "-",
        "T20_POINTS" => "171",
        "ODI_POINTS" => "26",
        "Test_Points"=>"-"
        
    ]
];

$response = [
    "status" => "success",
    "courses" => $rank
];

echo json_encode($response);
?>
