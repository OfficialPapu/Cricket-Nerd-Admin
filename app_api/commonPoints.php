<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === "OPTIONS") {
    http_response_code(200);
    exit();
}

$pointsTableCategories = [
    [
        "id" => 1,
        "name" => "IPL 2025",
        "format"=> "T20",
        
         
    ],
     [
        "id" => 2,
        "name" => "NPL 2025",
        "format"=> "T20",
        
         
    ],
    
  
  
    
    
];

$response = [
    "status" => "success",
    "pointsTableCategories" => $pointsTableCategories
];

echo json_encode($response, JSON_PRETTY_PRINT);
?>
