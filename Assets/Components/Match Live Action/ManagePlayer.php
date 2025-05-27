<style>
  .brand-blue {
    background-color: #3B4A99;
  }

  .player-card {
    transition: all 0.3s ease;
    border: 2px solid transparent;
  }

  .player-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(59, 74, 153, 0.15);
  }

  .player-card.selected {
    border-color: #3B4A99;
    background-color: rgba(59, 74, 153, 0.05);
  }

  .custom-checkbox {
    width: 20px;
    height: 20px;
    border: 2px solid #3B4A99;
    border-radius: 4px;
    position: relative;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .custom-checkbox.checked {
    background-color: #3B4A99;
    border-color: #3B4A99;
  }

  .custom-checkbox.checked::after {
    content: '✓';
    color: white;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 12px;
    font-weight: bold;
  }

  .logo-style {
    font-family: 'Arial Black', sans-serif;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 1px;
  }
</style>
</head>

<body class="bg-gray-50 min-h-screen">
  <!-- Main Content -->
  <div class="container mx-auto px-4 py-8">

    <!-- Players Grid -->
    <div class="bg-white rounded-lg shadow-lg p-6">
      <h3 class="text-xl font-bold text-gray-800 mb-6">
        <i class="fas fa-list-check mr-2 text-blue-600"></i>Available Players
      </h3>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="players-grid">
        <!-- Players will be dynamically generated -->
      </div>
    </div>

    <!-- Selected Playing XI -->
    <div class="bg-white rounded-lg shadow-lg p-6 mt-8" id="selected-team-section" style="display: none;">
      <h3 class="text-xl font-bold text-gray-800 mb-6">
        <i class="fas fa-trophy mr-2 text-yellow-500"></i>Your Playing XI
      </h3>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3" id="selected-players">
        <!-- Selected players will appear here -->
      </div>
    </div>
  </div>