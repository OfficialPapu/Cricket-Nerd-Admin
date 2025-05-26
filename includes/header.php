<?php
$AllMatchesQuery = $conn->query("SELECT `ID`, `Tournament Name`, `Country A`, `Custom Name A`, `Custom Name B`, `Country B` FROM `matches`");
?>
<div class="bg-brand-blue p-4 text-white">
    <h2 class="text-xl font-bold flex items-center">
        <i class="fas fa-gamepad mr-2"></i>
        Match Control Panel
    </h2>
</div>
<div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Match Selection -->
    <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-brand-blue rounded-full flex items-center justify-center text-white">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800">Select Match</h3>
        </div>
        <div class="relative">
            <?php if ($AllMatchesQuery && $AllMatchesQuery->num_rows > 0): ?>
                <select id="match-selector" class="w-full px-4 py-3 bg-white text-gray-800 rounded-lg appearance-none focus:ring-2 focus:ring-brand-blue focus:border-brand-blue border-2 border-gray-200 shadow-sm">
                    <option value="" disabled selected>Choose a match...</option>
                    <?php while ($row = $AllMatchesQuery->fetch_assoc()):
                        $countryA = !empty($row['Custom Name A']) ? $row['Custom Name A'] : $row['Country A'];
                        $countryB = !empty($row['Custom Name B']) ? $row['Custom Name B'] : $row['Country B'];
                    ?>
                        <option value="<?= htmlspecialchars($row['ID']) ?>"
                            data-country-a="<?= htmlspecialchars($countryA) ?>"
                            data-country-b="<?= htmlspecialchars($countryB) ?>"
                            class="text-black">
                            <?= htmlspecialchars($countryA . " Vs " . $countryB) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                    <i class="fas fa-chevron-down"></i>
                </div>
            <?php else: ?>
                <p class="text-red-500">No matches available</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Country Selection -->
    <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-brand-blue rounded-full flex items-center justify-center text-white">
                <i class="fas fa-flag"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800">Select Country</h3>
        </div>
        <div class="relative">
            <select id="country-selector" class="w-full px-4 py-3 bg-white text-gray-800 rounded-lg appearance-none focus:ring-2 focus:ring-brand-blue focus:border-brand-blue border-2 border-gray-200 shadow-sm" disabled>
                <option value="">Select match first...</option>
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    </div>
</div>

<!-- Match Info Display -->
<div id="match-info" class="hidden">
    <div class="border-t border-gray-200"></div>
    <div class="p-5 bg-blue-50">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex items-center p-3 bg-white rounded-lg shadow-sm">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-brand-blue mr-3">
                    <i class="fas fa-trophy"></i>
                </div>
                <div>
                    <div class="text-sm text-gray-500">Match</div>
                    <div class="text-lg font-bold text-gray-800" id="selected-match">-</div>
                </div>
            </div>
            <div class="flex items-center p-3 bg-white rounded-lg shadow-sm">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-brand-blue mr-3">
                    <i class="fas fa-flag"></i>
                </div>
                <div>
                    <div class="text-sm text-gray-500">Country</div>
                    <div class="text-lg font-bold text-gray-800" id="selected-country">-</div>
                </div>
            </div>
        </div>
    </div>
</div>