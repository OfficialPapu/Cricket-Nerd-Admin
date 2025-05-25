<?php
require "Composer/vendor/autoload.php"; 
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
include "../Config/Config.php"; 

$SECRET_KEY = "v4{2x&E#8t*Q9Pz%kL@1cT$a!X^5oJw7FgYD)mNRBbMpjhU3KH+sWy?ZrG"; 
$headers = getallheaders();
$authHeader = isset($headers['Authorization']) ? $headers['Authorization'] : '';

if ($authHeader) {
    
    $token = str_replace('Bearer ', '', $authHeader);

    try {
       
        $decoded = JWT::decode($token, new Key($SECRET_KEY, 'HS256'));
        
      
        $userId = $decoded->data->id; 
        $query = "SELECT * FROM user_registration WHERE ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            echo json_encode(['status' => 'success', 'data' => $user]); 
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not found']);
        }

    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid or expired token']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Authorization header missing']);
}
?>
