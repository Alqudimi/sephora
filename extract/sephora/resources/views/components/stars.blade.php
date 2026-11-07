@php
    $full = (int) floor($rating);
    $half = ($rating - $full) >= 0.5;
    $empty = 5 - $full - ($half ? 1 : 0);
@endphp
@if($full)@foreach(range(1, min($full, 5)) as $i)★@endforeach @endif
@if($half && $full < 5)☆@endif
