<!-- static -->
<div id="modal" class="mb-5">
    <!-- modal -->
    <div class="fixed inset-0 bg-black/60 z-999 hidden overflow-y-auto" x-bind:class="{ '!block': open }">
        <div class="flex items-start justify-center min-h-screen px-4">
            <div class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8" x-show="open" x-transition.duration.300ms>
                <div class="flex bg-fbfbfb dark:bg-121c2c items-center justify-between px-5 py-3">
                    <div id="modalTitle" class="font-bold text-lg">Naslov Modala</div>
                
                </div>
                <div class="p-5">
                    <div id="modalBody" class="dark:text-white-dark/70 text-base font-medium text-1f2937">
                        <!-- Sadržaj modala -->
                    </div>           
                </div>
            </div>
        </div>
    </div>
</div>
