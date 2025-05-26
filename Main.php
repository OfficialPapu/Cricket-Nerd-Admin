<?php
session_start();
ob_start();
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/Admin/";
include $base_url . 'Assets/Components/Navbar.php';
include $base_url . 'Assets/PHP/API/Config/Config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cricket Nerd | Live Match Manager</title>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="Assets/CSS/butterup.min.css">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'brand-blue': '#2e3192',
            'cricket-green': '#059669',
            'cricket-light': '#f8fafc'
          }
        }
      }
    }
  </script>
  <link rel="stylesheet" href="includes/Style.css">
</head>

<body>
  <!-- Main Container -->
  <div class="container mx-auto px-4 py-6 max-w-7xl">

    <!-- Match & Country Selection -->
    <div class="bg-white rounded-2xl shadow-xl mb-8 overflow-hidden fade-in-up">
      <?php include 'includes/header.php'; ?>
    </div>

    <!-- Tab Navigation and Content -->
    <div class="glass-effect rounded-2xl shadow-xl mb-6 fade-in-up" style="animation-delay: 0.4s">
      <!-- Tab Navigation -->
      <div class="border-b border-gray-200">
        <nav class="flex flex-wrap justify-center space-x-1 p-6">
          <button id="tab-batting" class="tab-btn tab-active px-6 md:px-8 py-4 rounded-xl font-semibold transition-all duration-300 border-2 mb-2 md:mb-0 shadow-sm">
            <i class="fas fa-baseball-ball mr-2"></i>
            <span>Batting</span>
          </button>
          <button id="tab-bowling" class="tab-btn px-6 md:px-8 py-4 rounded-xl font-semibold transition-all duration-300 border-2 border-gray-200 text-gray-600 hover:bg-gray-50 hover:border-gray-300 mb-2 md:mb-0 shadow-sm">
            <i class="fas fa-bowling-ball mr-2"></i>
            <span>Bowling</span>
          </button>
          <button id="tab-extras" class="tab-btn px-6 md:px-8 py-4 rounded-xl font-semibold transition-all duration-300 border-2 border-gray-200 text-gray-600 hover:bg-gray-50 hover:border-gray-300 mb-2 md:mb-0 shadow-sm">
            <i class="fas fa-plus mr-2"></i>
            <span>Extras</span>
          </button>
          <button id="tab-commentary" class="tab-btn px-6 md:px-8 py-4 rounded-xl font-semibold transition-all duration-300 border-2 border-gray-200 text-gray-600 hover:bg-gray-50 hover:border-gray-300 mb-2 md:mb-0 shadow-sm">
            <i class="fas fa-microphone mr-2"></i>
            <span>Commentary</span>
          </button>
        </nav>
      </div>

      <!-- Batting Tab -->
      <div id="content-batting" class="tab-content active">
        <?php include 'includes/batting.php'; ?>
      </div>

      <!-- Bowling Tab -->
      <div id="content-bowling" class="tab-content">
        <?php include 'includes/bowling.php'; ?>
      </div>

      <!-- Extras Tab -->
      <div id="content-extras" class="tab-content">
        <?php include 'includes/extras.php'; ?>
      </div>

      <!-- Commentary Tab -->
      <div id="content-commentary" class="tab-content">
        <?php include 'includes/commentary.php'; ?>
      </div>
    </div>
  </div>

  <script src="includes/Script.js"></script>
  <script src="Assets/JS/butterup.min.js"></script>
</body>

</html>