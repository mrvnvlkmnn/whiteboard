<div x-cloak x-data="{editProject: @entangle('showEditProject')}" @keydown.window.escape="editProject = false" >
    <div>
        <div x-show="editProject" x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute h-full inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <section class="absolute inset-y-0 right-0 pl-10 max-w-full flex">
            <div class="relative w-screen max-w-md" x-description="Slide-over panel, show/hide based on slide-over state." x-show="editProject" x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                <div x-show="editProject" x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute top-0 left-0 -ml-8 pt-4 pr-2 flex sm:-ml-10 sm:pr-4">
                    <button wire:click="closeEditProject" aria-label="Close panel" class="text-gray-300 hover:text-white transition ease-in-out duration-150">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="h-full flex flex-col space-y-6 py-6 bg-white shadow-xl overflow-y-scroll">
                    <header class="px-4 sm:px-6">
                        <h2 class="text-lg leading-7 font-medium text-gray-900">
                            Projekt bearbeiten
                        </h2>
                    </header>
                    <div class="relative flex-1 px-4 sm:px-6">
                        <!-- Replace with your content -->
                        <div class="mt-1
                         md:mt-0 md:col-span-2">
                            <form wire:submit.prevent="$emitTo('search-controller','render')">
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 pb-5 pt-3 bg-white sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-6">
                                                <label for="survey_number" class="block text-sm font-medium leading-5 text-gray-700">Studien-Nummer</label>
                                                <input wire:model.lazy="survey_number" id="survey_number" value="{{ $survey_number }}" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            </div>

                                            <div wire:ignore class="col-span-6 sm:col-span-6">
                                                <label for="programmer" class="block text-sm font-medium leading-5 text-gray-700">Programmierer</label>
                                                <select wire:model.lazy="programmer" class="select2 form-control" multiple id="programmer">
                                                    @foreach(config('employees.programmer') as $key => $value)
                                                        <option value="{{ $key }}" {{ in_array($key, old('programmer') ?? [$programmer] ) ? 'selected' : '' }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div wire:ignore class="col-span-6 sm:col-span-6">
                                                <label for="project_manager" class="block text-sm font-medium leading-5 text-gray-700">Projektleiter</label>
                                                <div class="relative">
                                                    <select wire:model.lazy="project_manager" class="select2 form-control" multiple id="project_manager">
                                                        @foreach(config('employees.project_manager') as $key => $value)
                                                            <option value="{{ $key }}" {{ in_array($key, old('project_manager') ?? [$project_manager] ) ? 'selected' : '' }}>{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-span-6 sm:col-span-6">
                                                <label for="details" class="block text-sm font-medium leading-5 text-gray-700">Details</label>
                                                <div class="rounded-md shadow-sm">
                                                    <textarea wire:model.lazy="detail" id="details" rows="3" class="form-textarea mt-1 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">{{ $detail }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-span-6">
                                                <label for="feldstart" class="block text-sm font-medium leading-5 text-gray-700">Geplanter Feldstart</label>
                                                <input id="feldstart" wire:model="fieldstart" type="date" value="{{ $fieldstart }}" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            </div>

                                            <div class="col-span-6 sm:col-span-6 lg:col-span-6">
                                                <label for="status" class="block text-sm font-medium leading-5 text-gray-700">Status</label>
                                                <select wire:model.defer="status" id="status" class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                                    <option value="Kick-Off"        {{ old('status', $status) == "Kick-Off" ? 'selected' : '' }}>Kick-Off</option>
                                                    <option value="Programmierung"  {{ old('status', $status) == "Programmierung" ? 'selected' : '' }}>Programmierung</option>
                                                    <option value="TL bei PL"       {{ old('status', $status) == "TL bei PL" ? 'selected' : '' }}>Testlink bei Projektleiter</option>
                                                    <option value="Im Feld"         {{ old('status', $status) == "Im Feld"? 'selected' : '' }}>Im Feld</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                        <button wire:click.lazy="updateProject" type="submit" class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out">
                                            Speichern
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <script>
                            window.addEventListener('checkSelect2', event => {
                                $('.select2').select2({
                                    theme: 'bootstrap4',
                                    width: '100%',
                                });
                                $('#programmer').on('change', function (e) {
                                    var data = $('#programmer').val();
                                    @this.programmer = data;
                                })
                                $('#project_manager').on('change', function (e) {
                                    var data = $('#project_manager').val();
                                    @this.project_manager = data;
                                })
                            })
                        </script>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
