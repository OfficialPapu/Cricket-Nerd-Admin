<?php
session_start();
if (!isset($_SESSION['Logged In'])) {
    echo "<script>window.location.href='Assets/Components/Login.html'</script>";
}
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
?>

<head>
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Media/Logo/The Cricket Nerd.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Assets/CSS/Navbar.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="Assets/CSS/butterup.min.css">
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
                                <i class='bx bxs-grid-alt'></i>
                                <p>Dashboard</p>
                            </a></li>
                        <li><a href="Pages/News.php">
                                <i class='bx bx-package'></i>
                                <p>News</p>
                            </a></li>

                        <li><a href="Pages/Matches.php">
                                <i class='bx bx-package'></i>
                                <p>Matches</p>
                            </a></li>
                             <li><a href="Pages/Asia Cup Matches.php">
                                <i class='bx bx-package'></i>
                                <p>Asia Cup Matches</p>
                            </a></li>
                        <li><a href="Pages/Videos.php">
                        <i class='bx bx-package'></i>
                                <p>Videos</p>
                            </a></li>
                        <li><a href="Pages/Statistics.php">
                        <i class='bx bx-package'></i>
                                <p>Statistics</p>
                            </a></li>
                        <li><a href="Pages/New Country.php">
                        <i class='bx bx-package'></i>
                                <p>New Country</p>
                            </a></li>
                        <li><a href="Assets/Components/Logout.php">
                                <i class='bx bx-log-in'></i>
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