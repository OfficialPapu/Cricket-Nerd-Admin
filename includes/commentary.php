<?php
// includes/commentary.php
?>
<div class="p-6">
    <div class="grid grid-cols-1 gap-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Add Commentary</h3>
        <form id="commentary-form" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Commentary</label>
                <textarea id="commentary-text" rows="4" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-brand-blue" placeholder="Enter commentary..."></textarea>
            </div>
            <button type="submit" class="w-full bg-brand-blue hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition-colors">
                Add Commentary
            </button>
        </form>
    </div>

    <div class="lg:col-span-2 bg-gray-50 rounded-lg p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Live Commentary</h3>
        <div id="commentary-feed" class="space-y-3 max-h-96 overflow-y-auto"></div>
    </div>
</div>