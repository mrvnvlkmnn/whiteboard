<div>
    <nav class="flex items-center text-left flex-wrap bg-eae-dark p-2 shadow-md">
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <a href="projects">
                <img src="{{ asset('images/Logo_Nur Kopf.png') }}" width="80px" alt="Logo">
            </a>
            <!--<span class="font-semibold text-xl tracking-tight">Ears and Eyes</span>-->
        </div>
        <div class="block lg:hidden">
            <button class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <title>Menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                </svg>
            </button>
        </div>
        <div class="w-full block lg:flex lg:items-center lg:w-auto">
            <div class="text-sm lg:flex-grow">
                <a wire:click="$emitTo('add-project', 'showAddProject')" style="color: #D4E6F6;" class="cursor block mt-0 lg:inline-block lg:mt-0 text-eae-light hover:text-white mr-4">
                    Projekt hinzufügen
                </a>
            </div>
        </div>
    </nav>
</div>

