<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Method, Access-Control-Allow-Origin");


if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
    http_response_code(200);
    exit();
}


$conn = mysqli_connect("localhost", "thecricn_erd", "8.Z8~0pW*U4B", "thecricn_erd");

if (!$conn) {
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit();
}


$json = file_get_contents("php://input");
$data = json_decode($json, true);

if (!isset($data['email'])) {
    echo json_encode(["status" => "error", "message" => "Email is required"]);
    exit();
}

$email = $data['email'];


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "message" => "Invalid email format"]);
    exit();
}


$stmt = $conn->prepare("INSERT INTO app (email) VALUES (?)");
$stmt->bind_param("s", $email);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Download app Now !"]);
} else {
    echo json_encode(["status" => "error", "message" => "Database error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
