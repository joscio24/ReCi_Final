@php

$bgcolors = ['#d6ecff', '#fff'];
$colors = ['transparent', '#0d6efd'];
// Colors for the borders
$bgColor = $bgcolors[$index % count($bgcolors)];
$color = $colors[$index % count($colors)];
@endphp
<div class="list-item d-flex justify-content-between align-item-center" style="border-left-color: {{ $color }}; background-color: {{$bgColor}}; cursor: pointer;">

    <div class="p">
        <a href="/debat/{{ $id }}" class="list-Item-title">{{ $title }}</a>
        <p>{{ $description }}</p>
    </div>

    <div class=" p-4 h-100">
        <span><i class="fa fa-chevron-right text-dark"></i></span>
    </div>

</div>
