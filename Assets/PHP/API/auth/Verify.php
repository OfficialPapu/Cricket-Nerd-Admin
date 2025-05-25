<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
$conn = mysqli_connect("localhost", "thecricn_erd", "8.Z8~0pW*U4B","thecricn_erd");
if (!$conn) {
    echo "Connection Fail";
}

$message = "";
$status = "error";
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $sql = "SELECT * FROM user_registration WHERE `Verification Token` = '$token' AND `Verified` = 0";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $update_sql = "UPDATE user_registration SET `Verified` = 1 WHERE `Verification Token` = '$token'";
        
        if (mysqli_query($conn, $update_sql)) {
            $message = "Your email has been verified successfully!";
            $status = "success";
        } else {
            $message = "There was an error verifying your email.";
        }
    } else {
        $message = "Invalid or expired token.";
    }
} else {
    $message = "No token provided.";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification Status</title>
    <link rel="shortcut icon" href="https://admin.thecricnerd.com/Media/Logo/The Cricket Nerd.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #fff;
            padding: 40px;
            margin: 100px auto;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
        }
        h1 {
            font-size: 24px;
            color: #333;
        }
        p {
            font-size: 18px;
            color: #555;
        }
        .success {
            color: #4CAF50;
            font-weight: bold;
        }
        .error {
            color: #F44336;
            font-weight: bold;
        }
        a {
            text-decoration: none;
            color: #fff;
            background-color: #2e3192;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
            display: inline-block;
        }
        a:hover {
            background-color: #d73059;
        }
    </style>
</head>
<body>

    <div class="container">
        <?php if ($status === 'success') : ?>
            <h1>Email Verified</h1>
            <p class="success"><?php echo $message; ?></p>
        <?php else: ?>
            <h1>Verification Failed</h1>
            <p class="error"><?php echo $message; ?></p>
        <?php endif; ?>

        <a href="https://thecricnerd.com/auth/login">Go to Login</a>
    </div>

</body>
</html>
