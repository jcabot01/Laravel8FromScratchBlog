@props(['active' => false])  {{--props from parent, now available to child.  active refers to 'state' of component--}}

@php
    $classes = 'block text-left px-3 text-sm leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white';

    if ($active) $classes .= ' bg-blue-500 text-white'; // .=  means push to the $classes string
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }} {{--a placeholder for content found in parent--}}
</a>
