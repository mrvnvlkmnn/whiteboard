<div>
    <div class="w-full mb-3">
        <div class="flex items-center px-3 py-2 mt-3 shadow-sm rounded-md bg-white">
            <div class="input_group w-full">
                <div class="input-group">
                    <div class="w-full">
                        <div class="mt-1 mb-1 relative rounded-md shadow-sm">
                            <input id="searchProject" wire:model="search"
                                   class="form-input block w-full pr-12 sm:text-sm sm:leading-5"
                                   placeholder="Suche nach einer Studie"/>
                            <div class="absolute inset-y-0 right-0 flex items-center">
                                <select aria-label="Status" wire:model="filterQuery"
                                        class="form-select h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm sm:leading-5">
                                    <option value="Aktive">Aktive Studien</option>
                                    <option value="Kick-Off">Kick-Off</option>
                                    <option value="Programmierung">Programmierung</option>
                                    <option value="TL bei PL">TL bei PL</option>
                                    <option value="Im Feld">Im Feld</option>
                                    <option value="deleted">gelöschte Befragungen</option>
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
                                    <x-table-div-theader textToDisplay="Studiennummer">
                                        <x-sorting nameForSorting="survey_number" sortingOrder="asc" margin="ml-2">
                                            @include('partials.icons.arrowDown', ['color' => 'black', 'w' => 4, 'h' => 4])
                                        </x-sorting>
                                        <x-sorting nameForSorting="survey_number" sortingOrder="desc">
                                            @include('partials.icons.arrowUp', ['color' => 'black', 'w' => 4, 'h' => 4])
                                        </x-sorting>
                                    </x-table-div-theader>
                                </th>
                                <th width="180px">
                                    <x-table-div-theader textToDisplay="Programmierer">
                                        <x-sorting nameForSorting="programmer" sortingOrder="asc" margin="ml-2">
                                            @include('partials.icons.arrowDown', ['color' => 'black', 'w' => 4, 'h' => 4])
                                        </x-sorting>
                                        <x-sorting nameForSorting="programmer" sortingOrder="desc">
                                            @include('partials.icons.arrowUp', ['color' => 'black', 'w' => 4, 'h' => 4])
                                        </x-sorting>
                                    </x-table-div-theader>
                                </th>
                                <th width="160px">
                                    <x-table-div-theader textToDisplay="Projektleiter">
                                        <x-sorting nameForSorting="project_manager" sortingOrder="asc" margin="ml-2">
                                            @include('partials.icons.arrowDown', ['color' => 'black', 'w' => 4, 'h' => 4])
                                        </x-sorting>
                                        <x-sorting nameForSorting="project_manager" sortingOrder="desc">
                                            @include('partials.icons.arrowUp', ['color' => 'black', 'w' => 4, 'h' => 4])
                                        </x-sorting>
                                    </x-table-div-theader>
                                </th>
                                <th width="250px">
                                    <x-table-div-theader textToDisplay="Details">
                                        <x-sorting nameForSorting="detail" sortingOrder="asc" margin="ml-2">
                                            @include('partials.icons.arrowDown', ['color' => 'black', 'w' => 4, 'h' => 4])
                                        </x-sorting>
                                        <x-sorting nameForSorting="detail" sortingOrder="desc">
                                            @include('partials.icons.arrowUp', ['color' => 'black', 'w' => 4, 'h' => 4])
                                        </x-sorting>
                                    </x-table-div-theader>
                                </th>
                                <th width="250px">
                                    <x-table-div-theader textToDisplay="geplanter Feldstart">
                                        <x-sorting nameForSorting="fieldstart" sortingOrder="asc" margin="ml-2">
                                            @include('partials.icons.arrowDown', ['color' => 'black', 'w' => 4, 'h' => 4])
                                        </x-sorting>
                                        <x-sorting nameForSorting="fieldstart" sortingOrder="desc">
                                            @include('partials.icons.arrowUp', ['color' => 'black', 'w' => 4, 'h' => 4])
                                        </x-sorting>
                                    </x-table-div-theader>
                                </th>
                                <th colspan="2">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($surveys as $survey)
                                <tr class="jsHeader activeRow">
                                    <td>
                                        <x-table-div-tbody>
                                            {{ $survey->survey_number }}
                                        </x-table-div-tbody>
                                    </td>
                                    <td>
                                        <x-table-div-tbody>
                                            {{ implode(', ', $survey->programmer) }}
                                        </x-table-div-tbody>
                                    </td>
                                    <td>
                                        <x-table-div-tbody>
                                            {{ implode(', ', $survey->project_manager) }}
                                        </x-table-div-tbody>
                                    </td>
                                    <td>
                                        <x-table-div-tbody>
                                            {{ $survey->detail }}
                                        </x-table-div-tbody>
                                    </td>
                                    <td>
                                        <x-table-div-tbody>
                                            {{ $survey->fieldstart->format('d. F Y') }}
                                        </x-table-div-tbody>
                                    </td>
                                    @if($survey->deleted_at != null)
                                        <td>
                                            @include('partials.status', ['color' => 'red', 'text' => 'Gelöscht'])
                                        </td>
                                    @elseif($survey->status == 'Im Feld')
                                        <td>
                                            @include('partials.status', ['color' => 'green', 'text' => $survey->status])
                                        </td>
                                    @elseif($survey->status == 'TL bei PL')
                                        <td>
                                            @include('partials.status', ['color' => 'orange', 'text' => $survey->status])
                                        </td>
                                    @elseif($survey->status == 'Programmierung')
                                        <td>
                                            @include('partials.status', ['color' => 'blue', 'text' => $survey->status])
                                        </td>
                                    @elseif($survey->status == 'Kick-Off')
                                        <td>
                                            @include('partials.status', ['color' => 'yellow', 'text' => $survey->status])
                                        </td>
                                    @endif
                                    <td style="display: flex; justify-content: flex-end;">
                                        @if($survey->deleted_at == NULL)
                                        <a class="cursor"
                                           wire:click="$emit('showComponent', 'editProject', {{ $survey->id }}, 'not_needed')">
                                            @include('partials.icons.edit', ['color' => '#2B6CB0', 'h' => 6, 'w' => 6])
                                        </a>

                                        <a class="cursor ml-1"
                                           wire:click="$emit('showComponent', 'Modal', {{ $survey->id }}, {{ json_encode($survey->update_list) }})">
                                            @include('partials.icons.delete', ['color' => '#C53030', 'h' => 6, 'w' => 6])
                                        </a>
                                        @else

                                            <a class="cursor ml-1"
                                               wire:click="$emit('showComponent', 'reactivateProject', {{ $survey->id }}, {{ json_encode($survey->update_list) }})">
                                                @include('partials.icons.reactivate', ['color' => '#09b823', 'w' => 6, 'h' => 6])
                                            </a>
                                        @endif

                                        <a onclick="changeDisplay({{ $survey->id }})" class="cursor ml-1">
                                            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                 viewBox="0 0 24 24" stroke="none">
                                                <path class="origin rotatable" id="icon_{{ $survey->id }}" stroke="#C53030"
                                                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 13l-7 7-7-7m14-8l-7 7-7-7"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <tr id="change_{{ $survey->id }}">
                                    <td colspan="7" class="noPadding">
                                        <div class="flow-root">
                                            <ul class="-mb-8">
                                                @foreach($survey->update_list as $keyUpdate => $valueUpdate)
                                                <li>
                                                    <div class="relative pb-8">
                                                        @if(!$loop->last)
                                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                                        @endif
                                                        <div class="relative flex space-x-3">
                                                            <div>
                                                                @switch($valueUpdate['type'])

                                                                @case('project_added')
                                                                    <x-circle color="green">
                                                                        @include('partials.icons.add', ['w' => 5, 'h' => 5])
                                                                    </x-circle>
                                                                @break

                                                                @case('project_updated')
                                                                    <x-circle color="yellow">
                                                                        @include('partials.icons.edit', ['color' => 'white', 'w' => 5, 'h' => 5])
                                                                    </x-circle>
                                                                @break

                                                                @case('project_deleted')
                                                                <x-circle color="red">
                                                                    @include('partials.icons.delete', ['color' => 'white', 'w' => 5, 'h' => 5])
                                                                </x-circle>
                                                                @break

                                                                @case('project_reactivated')
                                                                <x-circle color="green">
                                                                    @include('partials.icons.reactivate', ['color' => 'white', 'w' => 5, 'h' => 5])
                                                                </x-circle>
                                                                @break

                                                                @case('project_mail_sent')
                                                                <x-circle color="blue">
                                                                    @include('partials.icons.mail', ['color' => 'white', 'w' => 5, 'h' => 5])
                                                                </x-circle>
                                                                @break
                                                                @endswitch
                                                            </div>
                                                            <div class="min-w-0 flex-1 pt-1.5 flex space-x-4">
                                                                <div class="w-500">
                                                                    <p class="text-sm text-gray-500">{{ $this->setUpdateTypeName($valueUpdate['type']) }}</p>
                                                                </div>
                                                                <div class="w-748">
                                                                    @if(!findKey($valueUpdate, 'changes'))
                                                                        @if($valueUpdate['type'] == 'project_added')
                                                                            <p class="text-sm text-gray-500">Projekt mit der Studiennummer {{ $survey->survey_number }} wurde erstellt </p>
                                                                        @elseif($valueUpdate['type'] == 'project_deleted')
                                                                            <p class="text-sm text-gray-500">Projekt mit der Studiennummer {{ $survey->survey_number }} wurde gelöscht </p>
                                                                        @endif
                                                                    @else
                                                                        @foreach($valueUpdate['changes'] as $changes => $details)
                                                                            @if($changes == 'mail_sent')
                                                                                <p class="text-sm text-gray-500">{{ $this->checkForEloquentWordingForDetail($changes) . " wurde am " . date('d.m.Y', $details['new']) . " um " . date('G:i', $details['new']) . " versendet"}}</p>
                                                                            @elseif($changes == 'fieldstart')
                                                                                <p class="text-sm text-gray-500">{{ $this->checkForEloquentWordingForDetail($changes) . " wurde vom: \"" . $this->formatDate($details['old']) . "\" zum: \"" . $this->formatDate($details['new']) . "\" geändert"}}</p>
                                                                            @else
                                                                                <p class="text-sm text-gray-500">{{ $this->checkForEloquentWordingForDetail($changes) . " wurde von: \"" . checkForMultipleEntrys($details['old']) . "\" zu: \"" . checkForMultipleEntrys($details['new']) . "\" geändert"}}</p>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                                    <time datetime="{{ date('Y-m-d', $keyUpdate) }}">{{ date('d.m.Y H:i:s', $keyUpdate) }}</time>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
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
    @livewire('reactivate-project')
    @livewire('edit-project')
    @livewire('add-project')
</div>
<script>
    function changeDisplay(elementID) {
        let row = document.getElementById("change_" + elementID);
        let icon = document.getElementById("icon_" + elementID);

        $(row).toggleClass('activeRow');
        icon.classList.toggle("rotated180");

    }
</script>
