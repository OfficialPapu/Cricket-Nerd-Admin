<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === "OPTIONS") {
    http_response_code(200);
    exit();
}

$newsCategories = [
    [
        "id" => 1,
        "name" => "Nepal National",
        "description" => "News and Updates about Nepal's National Team.",
        "image" => "https://www.thecricnerd.com/Images/Logo/national%20and%20domestic.webp",
         
    ],
    [
        "id" => 2,
        "name" => "Nepal Domestic",
        "description" => "News and Updates about Nepal's National Team",
        "image" => "https://www.thecricnerd.com/Images/Logo/national%20and%20domestic.webp",
        
    ],
     [
        "id" => 3,
        "name" => "Editorial",
        "description" => "Experts analysis and opinion pieces on Nepal cricket",
        "image" => "https://www.thecricnerd.com/Images/Logo/The%20Cricket%20Nerd.png",
        
    ],
    [
        "id" => 4,
        "name" => "Elite Cup (Jay Trophy)",
        "description" => "Detailed Coverage, Experts analysis and opinion pieces on Elite Cup (Jay Trophy)",
        "image" => "https://www.thecricnerd.com/Images/Logo/Elite%20Cup%20(Jay%20Trophy).jpg",
        
    ],
    [
        "id" => 5,
        "name" => "Nepal Premier League",
        "description" => "News and Updates about Nepal Premier League",
        "image" => "https://www.thecricnerd.com/Images/Logo/NPL.jpg",
        
    ],
   
    
];

$response = [
    "status" => "success",
    "newsCategories" => $newsCategories
];

echo json_encode($response, JSON_PRETTY_PRINT);
?>
