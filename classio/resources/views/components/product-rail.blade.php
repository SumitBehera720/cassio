<div class="w-full relative">
    <div class="flex overflow-x-auto snap-x snap-mandatory hide-scrollbar gap-4 md:gap-6 pb-4" style="scrollbar-width: none; -ms-overflow-style: none;">
        {{ $slot }}
    </div>
    <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
</div>
