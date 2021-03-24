<a class="cursor {{ $margin ?? "ml-0" }}"
   wire:click="$emit('setParameterForSorting', '{{ $nameForSorting }}', '{{ $sortingOrder }}')">
    {{ $slot }}
</a>
