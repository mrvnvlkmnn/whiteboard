<div @keydown.window.escape="addProject = false" >
    <div>
        <div x-show="addProject" x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute h-full inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <section @click.away="addProject = false" class="absolute inset-y-0 right-0 pl-10 max-w-full flex">
            <div class="relative w-screen max-w-md" x-description="Slide-over panel, show/hide based on slide-over state." x-show="addProject" x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                <div x-show="addProject" x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute top-0 left-0 -ml-8 pt-4 pr-2 flex sm:-ml-10 sm:pr-4">
                    <button @click="addProject = false" aria-label="Close panel" class="text-gray-300 hover:text-white transition ease-in-out duration-150">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="h-full flex flex-col space-y-6 py-6 bg-white shadow-xl overflow-y-scroll">
                    <header class="px-4 sm:px-6">
                        <h2 class="text-lg leading-7 font-medium text-gray-900">
                            Panel title
                        </h2>
                    </header>
                    <div class="relative flex-1 px-4 sm:px-6">
                        <!-- Replace with your content -->
                        <div class="absolute inset-0 px-4 sm:px-6">
                            <div class="h-full border-2 border-dashed border-gray-200"></div>
                        </div>
                        <!-- /End replace -->
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div style="clear: both; display: block; height: 0px;">
</div>
