<?php
require "Composer/vendor/autoload.php"; 
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
include "../Config/Config.php";
$SECRET_KEY = "v4{2x&E#8t*Q9Pz%kL@1cT$a!X^5oJw7FgYD)mNRBbMpjhU3KH+sWy?ZrG"; 
 $EXPIRY = 3000 * 24 * 60 * 60; // 30 days in seconds expire
// $EXPIRY = 30;   // For testing 
$ISSUER = "thecricnerd.com"; 


$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['email']) && isset($data['password'])) {
    $login_email = $data['email'];
    $login_pass = $data['password'];

    $check_user = $conn->query("SELECT * FROM user_registration WHERE BINARY Password='$login_pass' AND Email='$login_email'");

    if ($check_user->num_rows > 0) {
        $row = $check_user->fetch_assoc();
        if ($row['Verified'] == 1) { 
            $payload = [
                'iss' => $ISSUER,
                'iat' => time(),
                'exp' => time() + $EXPIRY,
                'data' => [
                    'id' => $row['ID']
                    ]
            ];
            $token = JWT::encode($payload, $SECRET_KEY, 'HS256');
            
            echo json_encode(['status' => 'success', 'token' => $token]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Not Verified ! Please Create a new account']);
        }
    } 
    else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid Credentials']);
}
} 

?>
