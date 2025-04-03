@php

$bgcolors = ['#F7D7E6', '#DBD5E9', '#BFE3E0'];
$colors = ['#80224D', '#3D2375', '#10403C'];
// Colors for the borders
$bgColor = $bgcolors[$index % count($bgcolors)];
$color = $colors[$index % count($colors)];
@endphp
<div class="link-item col- d-flex justify-content-between align-item-center" style="border-left-color: {{ $color }}; background-color: {{$bgColor}}; cursor: pointer;">

    <div class="p-4 fs-20 link-item-icon">
        <span> <i class="{{ $icon }}"></i></span>
    </div>
    <div class="p  ">
        <a href="#" style="color: {{ $color }}; text-decoration: underline 2px solid {{ $color }};" class="link-Item-title">{{ $title }}</a>
        <p class="mt-3">{{ $description }}</p>
    </div>


</div>
