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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Assets/CSS/Dashboard.css">
</head>

<body class="bg-gray-50 grid-pattern min-h-screen">
    <div class="pt-24 pb-16">
        <!-- Brand Header -->
        <div class="text-center mb-16">
            <div class="max-w-6xl mx-auto px-6">
                <h1 class="text-6xl font-black brand-blue mb-4 tracking-tight">
                    THE <span class="text-gray-800">cricket</span>
                    <span class="block text-4xl font-bold mt-2">NERD</span>
                </h1>
                <div class="w-32 h-1 brand-bg-blue mx-auto rounded-full mb-6"></div>
                <p class="text-xl text-gray-600 font-medium">Ultimate Sports Management Dashboard</p>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <main class="mx-auto px-6">
            <div class="grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">

                <!-- Matches Control -->
                <div class="bg-white rounded-3xl p-8 card-3d border-2 border-gray-100 hover:border-blue-200">
                    <div class="text-center">
                        <div class="w-20 h-20 brand-bg-blue rounded-2xl mx-auto mb-6 flex items-center justify-center pulse-glow floating-animation">
                            <i class="fa-solid fa-trophy text-3xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold brand-blue mb-2">Matches</h3>
                        <p class="text-gray-500 mb-8 text-sm">Control & Management</p>

                        <div class="space-y-4">
                            <a href="Control Pages/Matches.php" class="block w-full py-3 px-6 btn-cricket text-white font-semibold rounded-xl overflow-hidden">
                                <i class="fas fa-list mr-2"></i>View All Matches
                            </a>
                            <a href="Pages/Matches.php" class="block w-full py-3 px-6 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors">
                                <i class="fas fa-plus mr-2"></i>Add New Match
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Points Table -->
                <div class="bg-white rounded-3xl p-8 card-3d border-2 border-gray-100 hover:border-blue-200">
                    <div class="text-center">
                        <div class="w-20 h-20 brand-bg-blue rounded-2xl mx-auto mb-6 flex items-center justify-center pulse-glow floating-animation" style="animation-delay: 0.5s;">
                            <i class="fa-solid fa-chart-bar text-3xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold brand-blue mb-2">Points Table</h3>
                        <p class="text-gray-500 mb-8 text-sm">Team Rankings</p>

                        <div class="space-y-4">
                            <a href="Pages/npl_points.php" class="block w-full py-3 px-6 btn-cricket text-white font-semibold rounded-xl overflow-hidden">
                                <i class="fas fa-users mr-2"></i>Add Team
                            </a>
                            <a href="Control Pages/npl_points.php" class="block w-full py-3 px-6 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors">
                                <i class="fas fa-edit mr-2"></i>View & Edit
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Videos -->
                <div class="bg-white rounded-3xl p-8 card-3d border-2 border-gray-100 hover:border-blue-200">
                    <div class="text-center">
                        <div class="w-20 h-20 brand-bg-blue rounded-2xl mx-auto mb-6 flex items-center justify-center pulse-glow floating-animation" style="animation-delay: 1s;">
                            <i class="fa-solid fa-video text-3xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold brand-blue mb-2">Video Gallery</h3>
                        <p class="text-gray-500 mb-8 text-sm">Highlights & More</p>

                        <div class="space-y-4">
                            <a href="Control Pages/Videos.php" class="block w-full py-3 px-6 btn-cricket text-white font-semibold rounded-xl overflow-hidden">
                                <i class="fas fa-play mr-2"></i>View All Videos
                            </a>
                            <a href="Pages/Videos.php" class="block w-full py-3 px-6 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors">
                                <i class="fas fa-upload mr-2"></i>Add New Video
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Players -->
                <div class="bg-white rounded-3xl p-8 card-3d border-2 border-gray-100 hover:border-blue-200">
                    <div class="text-center">
                        <div class="w-20 h-20 brand-bg-blue rounded-2xl mx-auto mb-6 flex items-center justify-center pulse-glow floating-animation" style="animation-delay: 1.5s;">
                            <i class="fa-solid fa-user-friends text-3xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold brand-blue mb-2">Players Hub</h3>
                        <p class="text-gray-500 mb-8 text-sm">Player Management</p>

                        <div class="space-y-4">
                            <a href="Control Pages/Players.php" class="block w-full py-3 px-6 btn-cricket text-white font-semibold rounded-xl overflow-hidden">
                                <i class="fas fa-list mr-2"></i>View All Players
                            </a>
                            <a href="Pages/Statistics.php" class="block w-full py-3 px-6 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors">
                                <i class="fas fa-user-plus mr-2"></i>Add New Player
                            </a>
                        </div>
                    </div>
                </div>

                <!-- News -->
                <div class="bg-white rounded-3xl p-8 card-3d border-2 border-gray-100 hover:border-blue-200">
                    <div class="text-center">
                        <div class="w-20 h-20 brand-bg-blue rounded-2xl mx-auto mb-6 flex items-center justify-center pulse-glow floating-animation" style="animation-delay: 2s;">
                            <i class="fa-solid fa-newspaper text-3xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold brand-blue mb-2">News Center</h3>
                        <p class="text-gray-500 mb-8 text-sm">Latest Updates</p>

                        <div class="space-y-4">
                            <a href="Control Pages/News.php" class="block w-full py-3 px-6 btn-cricket text-white font-semibold rounded-xl overflow-hidden">
                                <i class="fas fa-newspaper mr-2"></i>View All News
                            </a>
                            <a href="Pages/News.php" class="block w-full py-3 px-6 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors">
                                <i class="fas fa-pen mr-2"></i>Add Latest News
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tournament -->
                <div class="bg-white rounded-3xl p-8 card-3d border-2 border-gray-100 hover:border-blue-200">
                    <div class="text-center">
                        <div class="w-20 h-20 brand-bg-blue rounded-2xl mx-auto mb-6 flex items-center justify-center pulse-glow floating-animation" style="animation-delay: 2.5s;">
                            <i class="fa-solid fa-medal text-3xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold brand-blue mb-2">Tournament</h3>
                        <p class="text-gray-500 mb-6 text-sm">Stats & Records</p>

                        <div class="space-y-3">
                            <a href="Pages/npl.php" class="block w-full py-2.5 px-5 btn-cricket text-white font-semibold rounded-xl overflow-hidden text-sm">
                                <i class="fas fa-user-plus mr-2"></i>Add Player
                            </a>
                            <a href="Control Pages/npl_player_batter.php" class="block w-full py-2.5 px-5 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors text-sm">
                                <i class="fas fa-baseball-ball mr-2"></i>Batting Stats
                            </a>
                            <a href="Control Pages/npl_player_bowler.php" class="block w-full py-2.5 px-5 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors text-sm">
                                <i class="fas fa-bowling-ball mr-2"></i>Bowling Stats
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Scoreboard -->
                <div class="bg-white rounded-3xl p-8 card-3d border-2 border-gray-100 hover:border-blue-200">
                    <div class="text-center">
                        <div class="w-20 h-20 brand-bg-blue rounded-2xl mx-auto mb-6 flex items-center justify-center pulse-glow floating-animation" style="animation-delay: 3s;">
                            <i class="fa-solid fa-tv text-3xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold brand-blue mb-2">Live Scoreboard</h3>
                        <p class="text-gray-500 mb-8 text-sm">Real-time Updates</p>

                        <div class="space-y-4">
                            <a href="Pages/Squads.php" class="block w-full py-3 px-6 btn-cricket text-white font-semibold rounded-xl overflow-hidden">
                                <i class="fas fa-users mr-2"></i>Add Squads
                            </a>
                            <a href="Pages/Match Live Action.php" class="block w-full py-3 px-6 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors">
                                <i class="fas fa-broadcast-tower mr-2"></i>Live Action
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </main>

    </div>
</body>

</html>