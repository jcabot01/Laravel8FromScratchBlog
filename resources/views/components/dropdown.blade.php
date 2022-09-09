@props(['$trigger']) {{--passed down from parent to here--}}

<div x-data="{ show: false }" @click.away="show = false"> {{--x-data is Alpine.js reference--}}
    {{-- Trigger --}}
    <div @click="show = ! show"> {{--Alpine code--}}
        {{ $trigger }} {{--x-slot name='trigger'--}}
    </div>

    {{-- Links --}}
    <div x-show="show" class="py-2 absolute bg-gray-100 w-full mt-2 rounded-xl w-full z-50 overflow-auto max-h-52" style="display: none">
        {{ $slot }} {{--$slot refers to default, data is already in the parent--}}
    </div>

</div>
