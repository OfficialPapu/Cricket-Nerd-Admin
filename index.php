<?php
include 'Assets/Components/Navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | The Cricket Nerd</title>
</head>

<body>
    <div class="mt-[100px]">
        <h1 class="text-center mb-5 w-full text-3xl font-bold">Sports Dashboard</h1>
        <main class="container mx-auto px-5 grid gap-5 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-2 mb-2">
            <section class="control bg-white p-5 rounded-lg shadow-md">
                <h2 class="text-2xl mb-2 text-center border-b-2 pb-2 text-gray-800">
                    <i class="fas fa-futbol mr-2"></i> Matches Control
                </h2>
                <div class="control-buttons mb-4 text-center flex flex-col justify-center items-center">
                    <a href="Control Pages/Matches.php" class="btn bg-blue-500 text-white px-4 py-2 mx-2 rounded hover:bg-blue-700 mt-1">
                        View All Matches
                    </a>
                    <a href="Pages/Matches.php" class="btn bg-blue-500 text-white px-4 py-2 mx-2 rounded hover:bg-blue-700 mt-1">
                        Add New Match
                    </a>
                </div>
            </section>
            <section class="control bg-white p-5 rounded-lg shadow-md">
                <h2 class="text-2xl mb-2 text-center border-b-2 pb-2 text-gray-800">
                    <i class="fas fa-futbol mr-2"></i> Videos Control
                </h2>
                <div class="control-buttons mb-4 text-center flex flex-col justify-center items-center">
                    <a href="Control Pages/Videos.php" class="btn bg-blue-500 text-white px-4 py-2 mx-2 rounded hover:bg-blue-700 mt-1">
                        View All Videos
                    </a>
                    <a href="Pages/Videos.php" class="btn bg-blue-500 text-white px-4 py-2 mx-2 rounded hover:bg-blue-700 mt-1">
                        Add New Video
                    </a>
                </div>
            </section>

            <section class="control bg-white p-5 rounded-lg shadow-md">
                <h2 class="text-2xl mb-2 text-center border-b-2 pb-2 text-gray-800">
                    <i class="fas fa-futbol mr-2"></i> Players List
                </h2>
                <div class="control-buttons mb-4 text-center flex flex-col justify-center items-center">
                    <a href="Control Pages/Players.php" class="btn bg-blue-500 text-white px-4 py-2 mx-2 rounded hover:bg-blue-700 mt-1">
                        View All Players
                    </a>
                    <a href="Pages/Statistics.php" class="btn bg-blue-500 text-white px-4 py-2 mx-2 rounded hover:bg-blue-700 mt-1">
                        Add New Players
                    </a>
                </div>
            </section>

            <section class="control bg-white p-5 rounded-lg shadow-md">
                <h2 class="text-2xl mb-2 text-center border-b-2 pb-2 text-gray-800">
                    <i class="fas fa-futbol mr-2"></i> News Control
                </h2>
                <div class="control-buttons mb-4 text-center flex flex-col justify-center items-center">
                    <a href="Control Pages/News.php" class="btn bg-blue-500 text-white px-4 py-2 mx-2 rounded hover:bg-blue-700 mt-1">
                        View All News
                    </a>
                    <a href="Pages/News.php" class="btn bg-blue-500 text-white px-4 py-2 mx-2 rounded hover:bg-blue-700 mt-1">
                        Add Latest News
                    </a>
                </div>
            </section>
        </main>
    </div>
</body>

</html>