<a class="cursor {{ $margin }}"
   wire:click="$emit('setParameterForSorting', '{{ $nameForSorting }}', '{{ $sortingOrder }}')">
    {{ $slot }}
</a>
