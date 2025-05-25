<?php
// File: UploadProfile.php
require __DIR__ . "/Composer/vendor/autoload.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Origin: https://www.thecricnerd.com");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Method Not Allowed"]);
    exit;
}

include __DIR__ . "/../Config/Config.php"; 
if (!$conn || $conn->connect_error) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Database connection error"]);
    exit;
}

$headers    = getallheaders();
$authHeader = $headers['Authorization'] ?? '';
if (!$authHeader) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "Authorization header missing"]);
    exit;
}

$token = str_replace('Bearer ', '', $authHeader);
$SECRET_KEY = "v4{2x&E#8t*Q9Pz%kL@1cT$a!X^5oJw7FgYD)mNRBbMpjhU3KH+sWy?ZrG";

try {
    $decoded = JWT::decode($token, new Key($SECRET_KEY, 'HS256'));
    $userId  = (int)$decoded->data->id;
} catch (Exception $e) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "Invalid or expired token"]);
    exit;
}

if (!isset($_FILES['profile_picture'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "No file uploaded"]);
    exit;
}

$file = $_FILES['profile_picture'];
$allowed = ['image/jpeg','image/png','image/gif'];
if (!in_array($file['type'], $allowed)) {
    http_response_code(415);
    echo json_encode(["status" => "error", "message" => "Unsupported file type"]);
    exit;
}

$uploadDir = __DIR__ . "/uploads/profile_images/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}
$baseName   = preg_replace("/[^a-zA-Z0-9\._-]/", "", basename($file['name']));
$filename   = uniqid('img_') . "_" . $baseName;
$targetPath = $uploadDir . $filename;

if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "File upload failed"]);
    exit;
}
$dbPath = $conn->real_escape_string("uploads/profile_images/" . $filename);
$sql    = "UPDATE `user_registration` 
           SET `profile_image` = '$dbPath'
           WHERE `ID` = $userId";

if ($conn->query($sql)) {
    echo json_encode([
        "status" => "success",
        "data"   => [
            "image_url" => "https://yourdomain.com/" . $dbPath
        ]
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Database update failed: " . $conn->error
    ]);
}

$conn->close();
