<!-- Improved modal -->
<div id="modal" class="fixed inset-0 z-50 overflow-auto bg-black/60 flex items-center justify-center hidden">
    <!-- Modal content -->
    <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
        <!-- Modal header with close button -->
        <div class="flex justify-between mb-4">
            <h2 id="modalTitle" class="text-2xl font-bold text-gray-800">Naslov Modala</h2>
            <button class="text-gray-500 hover:text-gray-700 focus:outline-none" onclick="closeModal()">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Modal body -->
        <div id="modalBody" class="text-gray-700">
            <!-- Content will be loaded here -->
            <p class="mt-3">Učitavanje...</p>
        </div>

        <!-- Modal footer (optional) -->
        <div class="mt-6 flex justify-end">
            <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none" onclick="closeModal()">Zatvori</button>
        </div>
        <div class="mt-3" id="modalBody">
          <!-- Sadržaj modala -->
        </div>
      </div>
    </div>
</div>
