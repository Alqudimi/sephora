@php
    $full = (int) floor($rating);
    $half = ($rating - $full) >= 0.5;
    $empty = 5 - $full - ($half ? 1 : 0);
@endphp
<div class="flex text-primary text-[14px]">
    @foreach(range(1, min($full, 5)) as $i)
        <span class="material-symbols-outlined fill-icon text-[14px]" data-icon="star">star</span>
    @endforeach
    @if($half && $full < 5)
        <span class="material-symbols-outlined fill-icon text-[14px]" data-icon="star_half">star_half</span>
    @endif
    @foreach(range(1, max($empty, 0)) as $i)
        <span class="material-symbols-outlined text-[14px]" data-icon="star">star</span>
    @endforeach
</div>
