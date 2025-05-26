<?php
// includes/extras.php
?>
<div class="p-4 md:p-6">
    <div class="grid grid-cols-1 gap-6">
        <div class="bg-gray-50 rounded-lg p-4 md:p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Update Extras</h3>
            <form id="extras-form" class="space-y-4">
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Inning</label>
                        <input type="number" id="extras-inning" name="Inning" class="extras-input w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue" min="0">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Byes</label>
                        <input type="number" id="extras-byes" name="Byes" class="extras-input w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue" min="0">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Leg Byes</label>
                        <input type="number" id="extras-leg-byes" name="LegByes" class="extras-input w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue" min="0">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Wides</label>
                        <input type="number" id="extras-wides" name="Wides" class="extras-input w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue" min="0">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">No Balls</label>
                        <input type="number" id="extras-no-balls" name="NoBalls" class="extras-input w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue" min="0">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Penalty Runs</label>
                        <input type="number" id="extras-penalty-runs" name="PenaltyRuns" class="extras-input w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue" min="0">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Total Extras</label>
                        <input type="number" id="extras-total" name="TotalExtras" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue" min="0">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-brand-blue text-white py-3 rounded-lg font-medium transition-colors flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Update Extras
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
