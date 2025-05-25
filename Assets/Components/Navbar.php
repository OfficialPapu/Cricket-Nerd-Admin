<?php
session_start();
// if (!isset($_SESSION['Logged In'])) {
//     echo "<script>window.location.href='Assets/Components/Login.html'</script>";
// }
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/Admin/";
// $base_url = $_SERVER['DOCUMENT_ROOT'] . "/The Cricket Nerd Admin/";
?>

<head>
    <base href="/Admin/">
    <!-- <base href="/"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Media/Logo/The Cricket Nerd.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Assets/CSS/Navbar.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="Assets/CSS/butterup.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="overlay"></div>
    <div class="admin-side-bar-container">
        <div class="side-bar-box">
            <div class="top-nav-bar">
                <a href='/'>
                    <div class="dreamskin-icon">
                        <img src="Media/Logo/The Cricket Nerd.png" alt="">
                    </div>
                </a>
                <div class="menu-icon">
                    <i class='bx bx-menu-alt-right' id="Menu-btn"></i>
                </div>
            </div>
            <div class="main-side-bar">
                <div class="first-side-bar-box">
                    <ul class="side-bar">
                        <li><a href="/">
                        <i class="fa-solid fa-house fa-bounce fa-sm" style="color: #200a8f;"></i>
                                <p>Dashboard</p>
                            </a></li>
                            <li><a href="Control Pages/User Page.php">
                        <i class="fa-solid fa-user fa-bounce fa-sm" style="color: #200a8f;"></i>
                                <p>User Panel</p>
                            </a></li>
                            
                            <li><a href="Control Pages/App User Page.php">
                        <i class="fa-solid fa-user fa-bounce fa-sm" style="color: #200a8f;"></i>
                                <p>App User Panel</p>
                            </a></li>
                        
                        <li><a href="Assets/Components/Logout.php">
                        <i class="fa-solid fa-right-from-bracket fa-bounce fa-sm" style="color: #cf0202;"></i>
                                <p>Logout</p>
                            </a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="Assets/JS/butterup.min.js"></script>
<script src="Assets/JS/Navbar.js"></script>