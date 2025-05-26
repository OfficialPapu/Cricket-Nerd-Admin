<div class="p-4 md:p-6">
  <div class="grid grid-cols-1 gap-6">
    <div class="bg-gray-50 rounded-lg p-4 md:p-6">
      <h3 class="text-xl font-semibold text-gray-800 mb-4">Update Bowling Stats</h3>
      <form id="bowling-form" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Bowler</label>
            <select id="bowling-player" name="SquadID" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue">
              <option value="" disabled selected>Select a player</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Overs</label>
            <input type="number" id="bowling-overs" name="BowlingOvers" step="0.1" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue" min="0">
          </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Runs</label>
            <input type="number" id="bowling-runs" name="BowlingRuns" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue" min="0">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Wickets</label>
            <input type="number" id="bowling-wickets" name="BowlingWickets" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue" min="0">
          </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Economy</label>
            <input type="text" id="bowling-economy" name="BowlingEconomy" class="w-full p-3 border border-gray-300 rounded-lg">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Maidens</label>
            <input type="number" id="bowling-maidens" name="BowlingMaidens" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue" min="0">
          </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">No Ball</label>
            <input type="number" id="bowling-noball" name="BowlingNoBall" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue" min="0">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Wide</label>
            <input type="number" id="bowling-wide" name="BowlingWide" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue" min="0">
          </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Bowler Striker</label>
            <select id="bowling-striker" name="BowlingStriker" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue">
              <option value="" disabled selected>Select option</option>
              <option value="y">Yes</option>
              <option value="">No</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Bowler Action</label>
            <select id="bowling-action" name="BowlingAction" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue">
              <option value="" disabled selected>Select action type</option>
              <option value="Live">Live</option>
              <option value="">Not Live</option>
            </select>
          </div>
        </div>
        
        <div class="pt-4">
          <button type="submit" class="w-full bg-brand-blue text-white py-3 rounded-lg font-medium transition-colors flex items-center justify-center">
            <i class="fas fa-save mr-2"></i>
            Update Bowling Stats
          </button>
        </div>
      </form>
    </div>

  </div>
</div>