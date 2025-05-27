<div class="p-4 md:p-6">
  <div class="grid grid-cols-1 gap-6">
    <div class="bg-gray-50 rounded-lg p-4 md:p-6">
      <h3 class="text-xl font-semibold text-gray-800 mb-4">Update Batting Stats</h3>
      <form id="batting-form" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Player</label>
            <select id="batting-player" name="SquadID" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue">
              <option value="" disabled selected>Select a player</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Runs</label>
            <input type="number" id="batting-runs" name="BattingRuns" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue" min="0">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Balls</label>
            <input type="number" id="batting-balls" name="BattingBalls" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue" min="0">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Strike Rate</label>
            <input type="text" id="batting-sr" name="BattingSR" class="w-full p-3 border border-gray-300 rounded-lg">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Fours</label>
            <input type="number" id="batting-fours" name="BattingFours" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue" min="0">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Sixes</label>
            <input type="number" id="batting-sixes" name="BattingSixes" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue" min="0">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Batter Striker</label>
            <select id="batting-striker" name="BattingStriker" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue">
              <option value="" disabled selected>Select option</option>
              <option value="y">Yes</option>
              <option value="">No</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Batter Action</label>
            <select id="batting-action" name="BattingAction" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue">
              <option value="" disabled selected>Select action type</option>
              <option value="Live">Live</option>
              <option value="">Not Live</option>
            </select>
          </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select id="batting-status" name="BattingStatus" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue">
              <option value="" disabled selected>Select a status</option>
              <option value="Out">Out</option>
              <option value="Not Out">Not Out</option>
            </select>
          </div>
            <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Dismissal</label>
            <input type="text" id="dismissal" name="dismissal" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue" placeholder="Enter dismissal">
          </div>
        </div>

        <div class="pt-4">
          <button type="submit" class="w-full bg-brand-blue text-white py-3 rounded-lg font-medium transition-colors flex items-center justify-center">
            <i class="fas fa-save mr-2"></i>
            Update Batting Stats
          </button>
        </div>
      </form>
    </div>
  </div>
</div>