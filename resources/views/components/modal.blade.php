<!-- Osnovni modal -->
<div id="magnificPopupModal" class="white-popup mfp-hide">
    <div class="bg-white rounded-lg overflow-hidden shadow-xl max-w-lg mx-auto"> <!-- Promijenjeno u max-w-sm za manju širinu -->
      <div class="px-4 py-3"> <!-- Smanjeni padding za manju veličinu -->
        <div class="flex justify-between items-center">
          <h4 class="text-lg font-bold" id="modalTitle">Naslov Modala</h4>
          <button class="text-black close-modal" onclick="$.magnificPopup.close();">&times;</button> <!-- Dodan onclick event za zatvaranje modala -->
        </div>
        <div class="mt-3" id="modalBody">
          <!-- Sadržaj modala -->
        </div>
      </div>
    </div>
  </div>