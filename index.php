<?php
include 'Assets/Components/Navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | The Cricket Nerd</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>

<body class="bg-gray-100" style="background-image: url('Media/Logo/bg-cn.jpg'); background-size: cover; background-position: center;">

    <div class="mt-[100px]">
        <h1 class="text-center mb-8 w-full text-3xl font-extrabold text-white">The Cricket Nerd | Sports Dashboard</h1>
        <main class="container mx-auto px-5 grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-4 mb-8">
            <section class="control bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                <h2 class="text-2xl mb-4 text-center border-b-2 pb-2 text-blue-700 font-semibold">
                    <i class="fa-brands fa-codepen fa-bounce fa-xl" style="color: #a60754;"></i> Matches Control
                </h2>
                <div class="control-buttons text-center flex flex-col space-y-3">
                    <a href="Control Pages/Matches.php" class="btn bg-black text-white px-5 py-2 rounded-full hover:bg-[#2e3192]">
                        View All Matches
                    </a>
                    <a href="Pages/Matches.php" class="btn bg-black text-white px-5 py-2 rounded-full hover:bg-[#2e3192]">
                        Add New Match
                    </a>

                </div>
            </section>
            <section class="control bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                <h2 class="text-2xl mb-4 text-center border-b-2 pb-2 text-blue-700 font-semibold">
                    <i class="fa-solid fa-signal fa-bounce fa-xl" style="color: #07119c;"></i> Cricket Points Table
                </h2>
                <div class="control-buttons text-center flex flex-col space-y-3">
                    <a href="Pages/npl_points.php" class="btn bg-black text-white px-5 py-2 rounded-full hover:bg-[#2e3192]">
                        Add Team
                    </a>
                    <a href="Control Pages/npl_points.php" class="btn bg-black text-white px-5 py-2 rounded-full hover:bg-[#2e3192]">
                        View And Edit
                    </a>
                </div>
            </section>
            <section class="control bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                <h2 class="text-2xl mb-4 text-center border-b-2 pb-2 text-blue-700 font-semibold">
                    <i class="fa-brands fa-youtube fa-bounce fa-xl" style="color: #FF0000;"></i> Videos Control
                </h2>
                <div class="control-buttons text-center flex flex-col space-y-3">
                    <a href="Control Pages/Videos.php" class="btn bg-black text-white px-5 py-2 rounded-full hover:bg-[#2e3192]">
                        View All Videos
                    </a>
                    <a href="Pages/Videos.php" class="btn bg-black text-white px-5 py-2 rounded-full hover:bg-[#2e3192]">
                        Add New Video
                    </a>
                </div>
            </section>
            <section class="control bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                <h2 class="text-2xl mb-4 text-center border-b-2 pb-2 text-blue-700 font-semibold">
                    <i class="fa-sharp fa-solid fa-users fa-bounce" style="color: #0a2180;"></i> Players List
                </h2>
                <div class="control-buttons text-center flex flex-col space-y-3">
                    <a href="Control Pages/Players.php" class="btn bg-black text-white px-5 py-2 rounded-full hover:bg-[#2e3192]">
                        View All Players
                    </a>
                    <a href="Pages/Statistics.php" class="btn bg-black text-white px-5 py-2 rounded-full hover:bg-[#2e3192]">
                        Add New Players
                    </a>
                </div>
            </section>
            <section class="control bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                <h2 class="text-2xl mb-4 text-center border-b-2 pb-2 text-blue-700 font-semibold">
                    <i class="fa-solid fa-desktop fa-bounce fa-xl" style="color: #e24b71;"></i> News Control
                </h2>
                <div class="control-buttons text-center flex flex-col space-y-3">
                    <a href="Control Pages/News.php" class="btn bg-black text-white px-5 py-2 rounded-full hover:bg-[#2e3192]">
                        View All News
                    </a>
                    <a href="Pages/News.php" class="btn bg-black text-white px-5 py-2 rounded-full hover:bg-[#2e3192]">
                        Add Latest News
                    </a>
                </div>
            </section>
            <section class="control bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                <h2 class="text-2xl mb-4 text-center border-b-2 pb-2 text-blue-700 font-semibold">
                    <i class="fa-solid fa-trophy fa-bounce fa-xl" style="color: #c40303;"></i> Tournament Panel
                </h2>
                <div class="control-buttons text-center flex flex-col space-y-3">
                    <a href="Pages/npl.php" class="btn bg-black text-white px-5 py-2 rounded-full hover:bg-[#2e3192]">
                        Add Player Only
                    </a>
                    <a href="Control Pages/npl_player_batter.php" class="btn bg-black text-white px-5 py-2 rounded-full hover:bg-[#2e3192]">
                        View & Insert Batting
                    </a>
                    <a href="Control Pages/npl_player_bowler.php" class="btn bg-black text-white px-5 py-2 rounded-full hover:bg-[#2e3192]">
                        View & Insert Bowling
                    </a>
                </div>
            </section>
            <section class="control bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                <h2 class="text-2xl mb-4 text-center border-b-2 pb-2 text-blue-700 font-semibold">
                    <i class="fa-solid fa-signal fa-bounce fa-xl" style="color: #07119c;"></i> Cricket Scoreboard
                </h2>
                <div class="control-buttons text-center flex flex-col space-y-3">
                    <a href="Pages/Squads.php" class="btn bg-black text-white px-5 py-2 rounded-full hover:bg-[#2e3192]">
                        Add Squads
                    </a>
                    <a href="Pages/Match Live Action.php" class="btn bg-black text-white px-5 py-2 rounded-full hover:bg-[#2e3192]">
                        Add Match Live Action
                    </a>
                </div>
            </section>
        </main>
    </div>
</body>

</html>