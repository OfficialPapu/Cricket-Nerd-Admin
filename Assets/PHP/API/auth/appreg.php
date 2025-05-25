<?php
include "../Config/Config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid data received.']);
        exit;
    }

    $fullname = $data['fullName'];
    $email = $data['email'];
    $password = $data['password'];
    $createTime = date('Y-m-d H:i:s');

    // if (empty($fullname) || empty($email) || empty($password)) {
    //     echo json_encode(['status' => 'error', 'message' => 'Please fill in all fields.']);
    //     exit;
    // }
    $email_check = mysqli_query($conn, "SELECT * FROM user_registration WHERE Email = '$email'");
    if (mysqli_num_rows($email_check) > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Email is already registered.']);
        exit;
    }
    $verification_token = bin2hex(random_bytes(16));
    $sql = "INSERT INTO `user_registration` (`Full Name`, `Email`, `Password`, `Create Time`, `Verification Token`, `Verified`) 
            VALUES ('$fullname', '$email', '$password', '$createTime', '$verification_token', 0)";

    if (mysqli_query($conn, $sql)) {
        $verification_link = "https://admin.thecricnerd.com/Assets/PHP/API/auth/Verify.php?token=$verification_token";
        $subject = "Email Verification from The Cricket Nerd";
       $message = "
<html>
<head>
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
        }
        h2 {
            color: #2e3192;
            font-size: 26px;
            margin-bottom: 15px;
            font-weight: bold;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 16px 30px;
            background-color: #2e3192;
            color: #ffffff;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            text-align: center;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .button:hover {
            background-color: #1a237e;
            transform: translateY(-2px);
        }
        footer {
            font-size: 14px;
            color: #777;
            text-align: center;
            margin-top: 30px;
        }
        footer i {
            color: #2e3192;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h2>Welcome to The Cricket Nerd!</h2>
        <p>Thank you for registering with us! We're excited to have you on board. To complete your registration, please click the button below to verify your email address:</p>
        <p><a href='$verification_link' class='button'>Verify Your Email</a></p>
        <p>If you did not sign up for this account, feel free to ignore this message.</p>
        <footer>
            <p>Best regards,</p>
            <p>The Cricket Nerd Team</p>
            <p><i>www.thecricnerd.com</i></p>
        </footer>
    </div>
</body>
</html>
";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
        $headers .= "From: no-reply@thecricnerd.com" . "\r\n";
        if (mail($email, $subject, $message, $headers)) {
            echo json_encode(['status' => 'success', 'message' => 'Account created successfully! A verification email has been sent to your email address.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to send verification email.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Registration failed. Please try again.']);
    }

    mysqli_close($conn);
}
?>
