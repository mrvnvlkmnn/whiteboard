<div>
    <div class="w-full mb-3">
        <div class="flex items-center px-3 py-2 mt-3 shadow-sm rounded-md bg-white">
            <div class="input_group w-full">
                <div class="input-group">
                    <div class="w-full">
                        <div class="mt-1 mb-1 relative rounded-md shadow-sm">
                            <input id="searchProject" wire:model="search" class="form-input block w-full pr-12 sm:text-sm sm:leading-5" placeholder="Suche nach einer Studie" />
                            <div class="absolute inset-y-0 right-0 flex items-center">
                                <select aria-label="Status" wire:model="filterQuery"class="form-select h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm sm:leading-5">
                                    <option value="Alle">Alle</option>
                                    <option value="Kick-Off">Kick-Off</option>
                                    <option value="Programmierung">Programmierung</option>
                                    <option value="TL bei PL">TL bei PL</option>
                                    <option value="Im Feld">Im Feld</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div> <!-- begin table layout-->
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="table min-w-full divide-y divide-gray-200">
                            <thead class="bg-eae-light">
                            <tr>
                                <th width="200px">
                                    <div class="flex items-center">
                                        <div>Studien-Nummer</div>
                                        <a class="cursor ml-2" wire:click="$emit('setParameterForSorting', 'survey_number', 'asc')">
                                            <img src="images/arrow_down.png" width="12px" alt="arrow">
                                        </a>
                                        <a class="cursor"  wire:click="$emit('setParameterForSorting', 'survey_number', 'desc')">
                                            <img src="images/arrow_up.png" width="12px" alt="arrow">
                                        </a>
                                    </div>
                                </th>
                                <th width="180px">
                                    <div class="flex items-center">
                                        <div>Programmierer</div>
                                        <a class="cursor ml-2" wire:click="$emit('setParameterForSorting', 'programmer', 'asc')">
                                            <img src="images/arrow_down.png" width="12px" alt="arrow">
                                        </a>
                                        <a class="cursor"  wire:click="$emit('setParameterForSorting', 'programmer', 'desc')">
                                            <img src="images/arrow_up.png" width="12px" alt="arrow">
                                        </a>
                                    </div>
                                </th>
                                <th width="160px">
                                    <div class="flex items-center">
                                        <div>Projektleiter</div>
                                        <a class="cursor ml-2"  wire:click="$emit('setParameterForSorting', 'project_manager', 'asc')">
                                            <img src="images/arrow_down.png" width="12px" alt="arrow">
                                        </a>
                                        <a class="cursor"  wire:click="$emit('setParameterForSorting', 'project_manager', 'desc')">
                                            <img src="images/arrow_up.png" width="12px" alt="arrow">
                                        </a>
                                    </div>
                                </th>
                                <th width="250px">
                                    <div class="flex items-center">
                                        <div>Details</div>
                                        <a class="cursor ml-2"  wire:click="$emit('setParameterForSorting', 'detail', 'asc')">
                                            <img src="images/arrow_down.png" width="12px" alt="arrow">
                                        </a>
                                        <a class="cursor"  wire:click="$emit('setParameterForSorting', 'detail', 'desc')">
                                            <img src="images/arrow_up.png" width="12px" alt="arrow">
                                        </a>
                                    </div>
                                </th>
                                <th width="250px">
                                    <div class="flex items-center">
                                        <div>geplanter Feldstart</div>
                                        <a class="cursor ml-2"  wire:click="$emit('setParameterForSorting', 'feldstart', 'asc')">
                                            <img src="images/arrow_down.png" width="12px" alt="arrow">
                                        </a>
                                        <a class="cursor"  wire:click="$emit('setParameterForSorting', 'feldstart', 'desc')">
                                            <img src="images/arrow_up.png" width="12px" alt="arrow">
                                        </a>
                                    </div>
                                </th>
                                <th colspan="2">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($surveys as $survey)
                            <tr class="tableColored">
                                <td>
                                    <div class="flex items-center h-10">
                                        <div class="ml-4">
                                                {{ $survey->survey_number }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <span class="inline-block relative">
                                                @switch($survey->programmer[0])
                                                    @case("AG")
                                                        <img class="h-9 w-9 rounded-full" src="{{ asset('images/employees/AntjeGroth_256.jpg') }}" alt="">
                                                        @break
                                                    @case("DS")
                                                        <img class="h-9 w-9 rounded-full" src="{{ asset('images/employees/DennisSilberbach.jpg') }}" alt="">
                                                        @break
                                                    @case("MV")
                                                        <img class="h-9 w-9 rounded-full" src="{{ asset('images/employees/MarvinVolkmann.jpg') }}" alt="">
                                                        @break
                                                    @case("MY")
                                                        <img class="h-9 w-9 rounded-full" src="{{ asset('images/employees/MawlidYussuf.jpg') }}" alt="">
                                                        @break
                                                    @case("NS")
                                                        <img class="h-9 w-9 rounded-full" src="{{ asset('images/employees/NicoSorgenfrei.jpg') }}" alt="">
                                                        @break
                                                    @case("unknown")
                                                        <img class="h-9 w-9 rounded-full" src="{{ asset('images/employees/IT.jpg') }}" alt="">
                                                        @break
                                                @endswitch
                                                <span class="absolute top-0 left-0 block h-2 w-2 rounded-full text-white shadow-solid bg-red-600"></span>
                                            </span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm leading-5text-gray-900">
                                                {{ implode(', ', $survey->programmer) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center h-10">
                                        <div class="ml-4">
                                            {{ implode(', ', $survey->project_manager) }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center h-10">
                                        <div class="ml-4">
                                            {{ $survey->detail }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center h-10">
                                        <div class="ml-4">
                                            {{ $survey->feldstart->format('d.m.Y') }}
                                        </div>
                                    </div>
                                </td>
                                @if ($survey->status == 'Im Feld')
                                <td>
                                    <div class="flex items-center h-10">
                                        <div class="ml-4">
                                             <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                <span aria-hidden="" class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                {{ $survey->status }}
                                                <span class="relative"></span>
                                            </span>
                                        </div>
                                    </div>

                                </td>
                                @elseif($survey->status == 'TL bei PL')
                                <td >
                                    <div class="flex items-center h-10">
                                        <div class="ml-4">
                                            <span class="relative inline-block px-3 py-1 font-semibold text-orange-900 leading-tight">
                                                <span aria-hidden="" class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
                                                {{ $survey->status }}
                                                <span class="relative"></span>
                                            </span>
                                        </div>
                                    </div>

                                </td>
                                @elseif($survey->status == 'Programmierung')
                                <td >
                                    <div class="flex items-center h-10">
                                        <div class="ml-4">
                                            <span class="relative inline-block px-3 py-1 font-semibold text-blue-900 leading-tight">
                                                <span aria-hidden="" class="absolute inset-0 bg-blue-200 opacity-50 rounded-full"></span>
                                                {{ $survey->status }}
                                                <span class="relative"></span>
                                            </span>
                                        </div>
                                    </div>

                                </td>
                                @elseif($survey->status == 'Kick-Off')
                                <td >
                                    <div class="flex items-center h-10">
                                        <div class="ml-4">
                                            <span class="relative inline-block px-3 py-1 font-semibold text-yellow-900 leading-tight">
                                                <span aria-hidden="" class="absolute inset-0 bg-yellow-200 opacity-50 rounded-full"></span>
                                                {{ $survey->status }}
                                                <span class="relative"></span>
                                            </span>
                                        </div>
                                    </div>

                                </td>
                                @endif
                                <td style="display: flex; justify-content: flex-end;">
                                    <a class="cursor" wire:click="$emit('showComponent', 'editProject', {{ $survey->id }})">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 5H6C4.89543 5 4 5.89543 4 7V18C4 19.1046 4.89543 20 6 20H17C18.1046 20 19 19.1046 19 18V13M17.5858 3.58579C18.3668 2.80474 19.6332 2.80474 20.4142 3.58579C21.1953 4.36683 21.1953 5.63316 20.4142 6.41421L11.8284 15H9L9 12.1716L17.5858 3.58579Z" stroke="#2B6CB0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                    <a class="cursor marginL" wire:click="$emit('showComponent', 'Modal', {{ $survey->id }})">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19 7L18.1327 19.1425C18.0579 20.1891 17.187 21 16.1378 21H7.86224C6.81296 21 5.94208 20.1891 5.86732 19.1425L5 7M10 11V17M14 11V17M15 7V4C15 3.44772 14.5523 3 14 3H10C9.44772 3 9 3.44772 9 4V7M4 7H20" stroke="#C53030" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end table layout-->
    @livewire('modal')
    @livewire('edit-project')
    @livewire('add-project')
</div>
